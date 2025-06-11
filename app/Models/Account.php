<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $table = 'accounts';
    protected $primaryKey = 'login';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'login',
        'password',
        'lastactive',
        'access_level',
        'lastServer'
    ];

    protected $casts = [
        'lastactive' => 'decimal:0',
        'access_level' => 'integer',
        'lastServer' => 'integer'
    ];
}
