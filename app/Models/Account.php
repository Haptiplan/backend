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
        $accounts = Account::where('type', 'Ertrag')
            ->orWhere('type', 'Aufwand')
            ->get();
        $guv = [
            'aufwendungen' => [],
            'aufwendungen_sum' => 0,
            'ertraege' => [],
            'ertraege_sum' => 0,
            'ergebnis' => 0,
        ];
        // Calculte each account's balance
        Account::groupAccountsGuV($accounts, $companyId, $period, $guv);
        // Ertragskonten: type = 'Ertrag', Aufwandskonten: type = 'Aufwand'
        $aufwendungen = AccountEntry::where('company_id', $companyId)
            ->where('period', $period)
            ->whereHas('accountDebit', function ($q) {
                $q->where('type', 'Aufwand');
            })
            ->sum('amount');
        $guv['aufwendungen_sum'] = $aufwendungen;
        $ertraege = AccountEntry::where('company_id', $companyId)
            ->where('period', $period)
            ->whereHas('accountCredit', function ($q) {
                $q->where('type', 'Ertrag');
            })
            ->sum('amount');
        $guv['ertraege_sum'] = $ertraege;

        $guv['ergebnis'] = $ertraege - $aufwendungen;
        return $guv;
    }
    public static function bilanzMitGuV($companyId, $period)
    {
        // Add GuV result to equity
        $guvErgebnis = Account::calculateGuV($companyId, $period);
        if ($guvErgebnis['ergebnis'] < 0) {
            AccountEntry::create([
                'company_id' => $companyId,
                'period' => $period,
                'debit' => Account::find(3300)->id,
                'credit' => Account::find(8020)->id,
                'amount' => abs($guvErgebnis['ergebnis']),
            ]);
        } elseif ($guvErgebnis['ergebnis'] > 0) {
            AccountEntry::create([
                'company_id' => $companyId,
                'period' => $period,
                'debit' => Account::find(8020)->id,
                'credit' => Account::find(3300)->id,
                'amount' => abs($guvErgebnis['ergebnis']),
            ]);
        }

        // All accounts for the end report
        $accounts = Account::where('type', 'Aktiv')
            ->orWhere('type', 'Passiv')
            ->get();
        $bilanz = [
            'aktiva' => [
                'av' => [],
                'av_sum' => 0,
                'uv' => [],
                'uv_sum' => 0,
            ],
            'activa_sum' => 0,
            'passiva' => [
                'ek' => [],
                'ek_sum' => 0,
                'fk' => [],
                'fk_sum' => 0,
            ],
            'passiva_sum' => 0,
        ];

        // Calculate balances for each account
        $bilanz = Account::groupAccountsBilanz($companyId, $period, $accounts);

        $bilanz['aktiva']['av_sum'] = array_sum(array_column($bilanz['aktiva']['av'], 'saldo'));
        $bilanz['aktiva']['uv_sum'] = array_sum(array_column($bilanz['aktiva']['uv'], 'saldo'));
        $bilanz['activa_sum'] = $bilanz['aktiva']['av_sum'] + $bilanz['aktiva']['uv_sum'];

        $bilanz['passiva']['ek_sum'] = array_sum(array_column($bilanz['passiva']['ek'], 'saldo'));
        $bilanz['passiva']['fk_sum'] = array_sum(array_column($bilanz['passiva']['fk'], 'saldo'));
        $bilanz['passiva_sum'] = $bilanz['passiva']['ek_sum'] + $bilanz['passiva']['fk_sum'];

        return $bilanz;
    }
    private static function groupAccountsGuV($accounts, $companyId, $period, &$guv)
    {
        foreach ($accounts as $account) {
            $soll = AccountEntry::where('company_id', $companyId)
                ->where('period', $period)
                ->where('debit', $account->id)
                ->sum('amount');
            $haben = AccountEntry::where('company_id', $companyId)
                ->where('period', $period)
                ->where('credit', $account->id)
                ->sum('amount');
            $saldo = $soll - $haben;
            if ($account->type === 'Aufwand') {
                $guv['aufwendungen'][] = [
                    'konto' => $account->name,
                    'saldo' => abs($saldo),
                ];
            } elseif ($account->type === 'Ertrag') {
                $guv['ertraege'][] = [
                    'konto' => $account->name,
                    'saldo' => abs($saldo),
                ];
            }
        }


        return $guv;
    }
    private static function groupAccountsBilanz($companyId, $period, $accounts)
    {
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

            // Account 2800 (Bank) cannot be negative, book overdraft
            if ($account->id === 2800 && $saldo < 0) {
                // Book overdraft if necessary
                $temp = Account::bookOverdraft($companyId, $period, $saldo);
                $saldo = $saldo + $temp;
            }

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
                if ($account->level === 'EK') {
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
        return $bilanz;
    }
    private static function bookOverdraft($companyId, $period, $saldo)
    {
        $account = Account::find(2800);
        // Book overdraft
        AccountEntry::create([
            'company_id' => $companyId,
            'period' => $period,
            'debit' => $account->id,
            'credit' => Account::find(4205)->id, // Overdraft account
            'amount' => abs($saldo),
        ]);
        return abs($saldo);
    }
}
