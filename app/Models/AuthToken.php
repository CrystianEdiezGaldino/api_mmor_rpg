<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuthToken extends Model
{
    protected $fillable = [
        'account_name',
        'token',
        'expires_at',
        'is_revoked'
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'is_revoked' => 'boolean'
    ];

    public function account()
    {
        return $this->belongsTo(Account::class, 'account_name', 'login');
    }

    public function isValid()
    {
        return !$this->is_revoked && $this->expires_at->isFuture();
    }
} 