<?php

namespace App\Models\User;

use App\Models\Decision\Decision;
use App\Models\Game\Company;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Player extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'company_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function decisions()
    {
        return $this->hasMany(Decision::class);
    }
}
