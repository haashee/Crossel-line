<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RichmenuSetting extends Model
{
    use HasFactory;

    protected $fillable = ['multiBtnA', 'multiBtnB', 'multiBtnC', 'showRichmenu', 'account_id', 'nameA', 'nameB', 'nameC', 'displayTextA', 'displayTextB', 'displayTextC'];

    protected $casts = [
        'multiBtn1' => 'array',
        'multiBtn2' => 'array',
        'multiBtn3' => 'array'
    ];
}