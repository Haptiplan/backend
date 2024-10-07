<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Game;
use App\Models\Gamemaster;
use App\Models\Player;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = User::where('id', '!=', Auth::id())->where('role', User::ROLE_ADMIN)->get();
        $gamemasters = User::where('role', User::ROLE_GAMEMASTER)->get();
        $players = User::where('role', User::ROLE_USER)->get();
        return view('users.index', [
            'admins' => $admins,
            'gamemasters' => $gamemasters,
            'players' => $players,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'role' => 'required',
            'password' => 'required',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'password' => bcrypt($validated['password']),
        ]);

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $player = Player::find($user->id);
        $gamemasters = Gamemaster::where('id', $user->id)->get();
        $game_ids = $gamemasters->pluck('game_id')->toArray();

        $games_used = Game::whereIn('id', $game_ids)->get();
        $games_free = Game::whereNotIn('id', $game_ids)->get();
        return view('users.edit', [
            'user' => $user,
            'player' => $player,
            'gamemasters' => $gamemasters,
            'games_free' => $games_free,
            'games_used' => $games_used,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $user->id,
            'role' => 'required',
            'game' => ''
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->role = $validated['role'];

        if ($validated['role'] == User::ROLE_GAMEMASTER && !empty($validated['game'])) {
            if (!(DB::table('gamemasters')->where('id', $user->id)->where('game_id', $validated['game'])->exists())) {
                DB::table('gamemasters')->insert([
                    'id' => $user->id,
                    'game_id' => $validated['game'],
                ]);
            }        }
        $user->save();

        return redirect()->route('users.edit', $user->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        User::where('id', $id)->firstOrFail()->delete();

        return redirect()->route('users.index');
    }

    /**
     * Show the form for impersonating a user  in a specified game.
     */
    public function impersonate(Request $request)
    {
        $user = User::findOrFail(Auth::id());
        $games = Game::all();
        $companies = Company::all();
        if ($user->role == User::ROLE_GAMEMASTER) {
            $game_ids = Gamemaster::where('id', $user->id)->get()->pluck('game_id')->toArray();
            $companies = Company::where('game_id', $game_ids)->get();
        }

        return view('users.impersonate', [
            'games' => $games,
            'companies' => $companies,
        ]);
    }

    /**
     * Change the role of a specific user temporarily.
     */
    public function startImpersonate(Request $request)
    {
        $active_user = User::findOrFail(Auth::id());
        $validated = $request->validate([
            'role' => 'required',
            'company' => 'required_if:role,' . User::ROLE_USER . '|exists:companies,id',
            'game' => 'required_if:role,' . User::ROLE_GAMEMASTER . '|exists:games,id',
        ]);

        if ($validated['role'] == User::ROLE_USER && ($active_user->role == User::ROLE_ADMIN || $active_user->role == User::ROLE_GAMEMASTER)) {
            $player = Player::where('company_id', $validated['company'])->firstOrFail();
            $user = User::where('id', $player->id)->firstOrFail();
            $active_user->setImpersonating($user->id);
            return redirect()->route('dashboard');
        } elseif ($validated['role'] == User::ROLE_GAMEMASTER && $active_user->role == User::ROLE_ADMIN) {
            $gamemaster = Gamemaster::where('game_id', $validated['game'])->firstOrFail();
            $user = User::where('id', $gamemaster->id)->firstOrFail();
            $active_user->setImpersonating($user->id);
            return redirect()->route('dashboard');
        }

        return redirect()->route('impersonate.view');
    }

    /**
     * Change role of a specific user back to the original role.
     */
    public function stopImpersonate(Request $request)
    {
        $active_user = $request->user();
        $active_user->stopImpersonating();

        return redirect()->route('dashboard');
    }
}
