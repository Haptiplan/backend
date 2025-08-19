<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'number',
        'type',
        'level',
        'name',
    ];
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function AccountEntries()
    {
        return $this->hasMany(AccountEntry::class);
    }
    public static function calculateGuV($companyId, $period)
    {
        // Ertragskonten: type = 'Ertrag', Aufwandskonten: type = 'Aufwand'
        $ertraege = AccountEntry::where('company_id', $companyId)
            ->where('period', $period)
            ->whereHas('accountCredit', function ($q) {
                $q->where('type', 'Ertrag');
            })
            ->sum('amount');

        $aufwendungen = AccountEntry::where('company_id', $companyId)
            ->where('period', $period)
            ->whereHas('accountDebit', function ($q) {
                $q->where('type', 'Aufwand');
            })
            ->sum('amount');

        $ergebnis = $ertraege - $aufwendungen;

        return [
            'ertraege' => $ertraege,
            'aufwendungen' => $aufwendungen,
            'ergebnis' => $ergebnis,
        ];
    }
    public static function bilanzMitGuV($companyId, $period)
    {
        // All accounts for the end report
        $accounts = Account::all();
        $bilanz = [
            'aktiva' => [
                'av' => [],
                'uv' => [],
            ],
            'passiva' => [
                'ek' => [],
                'fk' => [],
            ],
        ];

        // Calculate balances for each account
        foreach ($accounts as $account) {
            $soll = AccountEntry::where('company_id', $companyId)
                ->where('period', '<=', $period)
                ->where('debit', $account->id)
                ->sum('amount');
            $haben = AccountEntry::where('company_id', $companyId)
                ->where('period', '<=', $period)
                ->where('credit', $account->id)
                ->sum('amount');
            $saldo = $soll - $haben;

            // Assign to account type and level
            if ($account->type === 'Aktiv') {
                if ($account->level === 'AV') {
                    $bilanz['aktiva']['av'][] = [
                        'konto' => $account->name,
                        'saldo' => abs($saldo),
                    ];
                } elseif ($account->level === 'UV') {
                    $bilanz['aktiva']['uv'][] = [
                        'konto' => $account->name,
                        'saldo' => abs($saldo),
                    ];
                }
            } elseif ($account->type === 'Passiv') {
                if($account->level === 'EK') {
                    $bilanz['passiva']['ek'][] = [
                        'konto' => $account->name,
                        'saldo' => abs($saldo),
                    ];
                } elseif ($account->level === 'FK') {
                    $bilanz['passiva']['fk'][] = [
                        'konto' => $account->name,
                        'saldo' => abs($saldo),
                    ];
                }
            }
        }

        // Add GuV result to equity
        $guvErgebnis = Account::calculateGuV($companyId, $period);
        if ($guvErgebnis < 0) {
            AccountEntry::create([
                'company_id' => $companyId,
                'period' => $period,
                'debit' => Account::find( 3300)->id,
                'credit' => Account::find(8020)->id,
                'amount' => abs($guvErgebnis['ergebnis']),
            ]);
        } elseif ($guvErgebnis > 0) {
            AccountEntry::create([
                'company_id' => $companyId,
                'period' => $period,
                'debit' => Account::find(8020)->id,
                'credit' => Account::find(3300)->id,
                'amount' => abs($guvErgebnis['ergebnis']),
            ]);
        }

        return $bilanz;
    }
    
}
