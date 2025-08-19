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
            'aktiva' => [],
            'passiva' => [],
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

            // Assign to account type
            if ($account->type === 'Aktiv') {
                $bilanz['aktiva'][] = [
                    'konto' => $account->name,
                    'saldo' => abs($saldo),
                ];
            } elseif ($account->type === 'Passiv') {
                $bilanz['passiva'][] = [
                    'konto' => $account->name,
                    'saldo' => abs($saldo),
                ];
            }
        }

        // Add GuV result to equity
        $guvErgebnis = Account::calculateGuV($companyId, $period);
        $bilanz['passiva'][] = [
            'konto' => 'Periodenerfolg (GuV)',
            'saldo' => $guvErgebnis,
        ];

        return $bilanz;
    }
    
}
