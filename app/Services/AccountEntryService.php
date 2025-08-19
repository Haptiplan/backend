<?php


namespace App\Services;

use App\Models\AccountEntry;
use Illuminate\Support\Collection;

class AccountEntryService
{
    /**
     * Holt alle Buchungen einer Periode für eine Firma.
     */
    public function getEntriesForPeriod($companyId, $period): Collection
    {
        return AccountEntry::where('company_id', $companyId)
            ->where('period', $period)
            ->get();
    }
    
}
