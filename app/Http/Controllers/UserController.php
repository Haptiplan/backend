<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Game;
use App\Models\Gamemaster;
use App\Models\Player;
use App\Models\Role;
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
        // Fetch all users and exclude the current authenticated user
        $users = User::where('id', '!=', Auth::id())->get();

        // Group the users by their role using collection methods
        $admins = $users->where('role_id', User::ROLE_ADMIN);
        $gamemasters = $users->where('role_id', User::ROLE_GAMEMASTER);
        $players = $users->where('role_id', User::ROLE_USER);

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

        $roles = Role::all();
        return view('users.create',['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'role' => 'required',
            'password' => 'required',
        ]);

        // Create the user
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role_id' => $validated['role'],
            'password' => bcrypt($validated['password']),
        ]);

        // Redirect with success message
        return redirect()->back()->with('success', 'User created successfully!');
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
        // Retrieve the user with the given ID
        $user = User::findOrFail($id);

        // Find the associated player (if exists)
        $player = Player::find($user->id);

        // Retrieve all gamemasters associated with this user (based on user_id, not id)
        $gamemasters = Gamemaster::where('id', $user->id)->get();

        // Collect the game IDs that the gamemaster is associated with
        $game_ids = $gamemasters->pluck('game_id')->toArray();

        // Retrieve the games that the user is already involved with (used games)
        $games_used = Game::whereIn('id', $game_ids)->get();

        // Retrieve the games that the user is not involved with (free games)
        $games_free = Game::whereNotIn('id', $game_ids)->get();

        // Return the view with the necessary data
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
        // Find the user with the given ID or fail
        $user = User::findOrFail($id);

        // Validate incoming data
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $user->id,
            'role' => 'required',
            'game' => 'nullable|exists:games,id'
        ]);

        // Update the user fields
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->role_id = $validated['role'];

        // If the user is a Gamemaster and a game is selected, add the relationship if it doesn't exist
        if ($validated['role'] == User::ROLE_GAMEMASTER && !empty($validated['game'])) {
            $gameId = $validated['game'];

            // Check if the gamemaster relationship already exists
            $existingGamemaster = Gamemaster::where('user_id', $user->id)->where('game_id', $gameId)->first();

            // If the relationship doesn't exist, create a new one
            if (!$existingGamemaster) {
                Gamemaster::create([
                    'user_id' => $user->id,
                    'game_id' => $gameId,
                ]);
            }
        }
        // Save the updated user
        $user->save();

        // Redirect back to the previous page
        return redirect()->back();
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
    public function impersonate(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $user = User::findOrFail(Auth::id());
        $games = Game::all();
        $companies = Company::all();
        if ($user->role_id == User::ROLE_GAMEMASTER) {
            $game_ids = Gamemaster::where('user_id', $user->id)->get()->pluck('game_id')->toArray();
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
            'role_id' => 'required',
            'company' => 'required_if:role_id,' . User::ROLE_USER . '|exists:companies,id',
            'game' => 'required_if:role_id,' . User::ROLE_GAMEMASTER . '|exists:games,id',
        ]);

        if ($validated['role_id'] == User::ROLE_USER && ($active_user->role == User::ROLE_ADMIN || $active_user->role == User::ROLE_GAMEMASTER)) {
            $player = Player::where('company_id', $validated['company'])->firstOrFail();
            $user = User::where('id', $player->id)->firstOrFail();
            $active_user->setImpersonating($user->id);
            return redirect()->route('dashboard');
        } elseif ($validated['role_id'] == User::ROLE_GAMEMASTER && $active_user->role == User::ROLE_ADMIN) {
            $gamemaster = Gamemaster::where('game_id', $validated['game'])->firstOrFail();
            $user = User::where('id', $gamemaster->user_id)->firstOrFail();
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
