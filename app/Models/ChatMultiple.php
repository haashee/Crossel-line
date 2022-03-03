<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMultiple extends Model
{
    use HasFactory;

    protected $fillable = ['account_id', 'tag_id', 'message', 'user_identifier',];
}