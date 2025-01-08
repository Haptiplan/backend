<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Session;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    const ROLE_ADMIN = 'admin';
    const ROLE_GAMEMASTER = 'gamemaster';
    const ROLE_USER = 'user';

    const ROLES = [
        self::ROLE_ADMIN,
        self::ROLE_USER,
        self::ROLE_GAMEMASTER,
    ];

    public function player(): HasOne
    {
        return $this->hasOne(Player::class, 'id');
    }
    public function gamemasters(): HasMany
    {
        return $this->hasMany(Gamemaster::class, 'user_id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function setImpersonating($id): void
    {
        Session::put('impersonate', $id);
    }

    public function stopImpersonating(): void
    {
        Session::forget('impersonate');
    }

    public function isImpersonating(): bool
    {
        return Session::has('impersonate');
    }

    public function role(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
}
