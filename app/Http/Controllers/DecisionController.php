<?php

namespace App\Http\Controllers;

use App\Models\Decision;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Player;
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
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $id = Auth::user()->id;
        if(Session::has('impersonate')) $id = Session::get('impersonate');

        $player = Player::find($id);
        $company = Company::whereHas('players', function($query) use ($id) {
            $query->where('id', $id);
        })->get();

        $player_ids = $company->players->pluck('id')->toArray();
        $decisions = Decision::whereIn('player_id', $player_ids)->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Decision $decision)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Decision $decision)
    {
        //
    }
}
