<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    private $accounts = [
        1 => [
            'id' => 2800,
            'type' => 'active',
            'level' => 'UV',
            'name' => 'Bank ',
        ],
        2 => [
            'id' => 0720,
            'type' => 'active',
            'level' => 'AV',
            'name' => 'Anlagen und Maschinen',
        ],
        3 => [
            'id' => 4400,
            'type' => 'passive',
            'level' => 'FK',
            'name' => 'Verbindlichkeiten aus Lieferungen und Leistungen',
        ],
    ];
    private $accountEntries = [
        1 => [
            'company_id' => 1,
            'period' => 1,
            'id' => 1,
            'debit' => 0720,
            'credit' => 4400,
            'amount' => 100000,
        ],
        2 => [
            'company_id' => 1,
            'period' => 2,
            'id' => 2,
            'debit' => 4400,
            'credit' => 2800,
            'amount' => 100000,
        ],
    ];
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
        //
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
    public function show(Account $account)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Account $account)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Account $account)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Account $account)
    {
        //
    }
}
