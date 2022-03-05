<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RichmenuSetting extends Model
{
    use HasFactory;

    protected $fillable = ['multiBtn1', 'multiBtn2', 'multiBtn3', 'showRichmenu', 'account_id',];

    protected $casts = [
        'multiBtn1' => 'array',
        'multiBtn2' => 'array',
        'multiBtn3' => 'array'
    ];
}