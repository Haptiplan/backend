<?php

namespace App\Http\Controllers\Player;

use App\Models\Decision\Decision;
use App\Http\Controllers\Controller;
use App\Models\Game\Company;
use App\Models\Game\Game;
use App\Models\Decision\Machine;
use App\Models\Decision\MachineDecision;
use App\Models\User\Player;
use App\Models\User\User;
use App\Services\DecisionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DecisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = Auth::user()->id;
        if (Session::has('impersonate')) {
            $id = Session::get('impersonate');
        }

        $player = Player::find($id);
        $company = Company::where('id', $player->company_id)->first();

        $game = Game::where('id', $company->game_id)->first();

        $player_ids = Player::where('company_id', $company->id)->pluck('id')->toArray();
        $decisions = Decision::whereIn('player_id', $player_ids)->get();

        if (($decisions->max('period') < $game->current_period_number) || $decisions->isEmpty()) {
            return redirect()->route('decisions.create');
        }

        return view('user.decisions.index', [
            'decisions' => $decisions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $id = Auth::user()->id;
        if (Session::has('impersonate')) {
            $id = Session::get('impersonate');
        }

        $player = Player::find($id);
        $company = Company::where('id', $player->company_id)->first();
        $game = Game::where('id', $company->game_id)->first();
        $machinetypes = $game->machinetypes()->get();
        $machines = $company->machines()->where('status', '1')->get();

        $player_ids = Player::where('company_id', $company->id)->pluck('id')->toArray();
        $decisions = Decision::whereIn('player_id', $player_ids)->orderByDesc('id')->get();

        if ($decisions->isNotEmpty() && ($decisions->max('period') >= $game->current_period_number)) {
            return redirect()->route('decisions.index');
        }

        return view('user.decisions.create', [
            'decisions' => $decisions,
            'period' => $game->current_period_number,
            'player' => $player,
            'machinetypes' => $machinetypes,
            'machines' => $machines
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, DecisionService $decisionService)
    {
        $validated = $request->validate([
            'approve' => 'required',
            'player_id' => 'required | exists:players,id',
            'period' => 'digits_between:1,8',
            'buy' => 'array|nullable',
            'buy.*' => 'integer|min:0',
            'sell' => 'array|nullable',
            'sell.*' => 'integer|exists:machines,id'
        ]);

        $company = Player::find($validated['player_id'])->company;
        if ($request->user()->cannot('store', [Decision::class, $company])) {
            abort(403);
        }
        
        $decisionService->createDecision($validated);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $decision = Decision::findOrFail($id);
        $decision_maker = User::where('id', $decision->player_id)->first();

        $machine_decisions = MachineDecision::where('decision_id', $decision->id)->get();
        $machines_bought = Machine::where('company_id', $decision_maker->player->company->id)->where('period', $decision->period)->get();
        $machines_sold = Machine::whereIn('id', $machine_decisions->pluck('sell')->toArray())->get();

        return view('user.decisions.show', [
            'decision' => $decision,
            'decision_maker' => $decision_maker,
            'machines_bought' => $machines_bought,
            'machines_sold' => $machines_sold,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
