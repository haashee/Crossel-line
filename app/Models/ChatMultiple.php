<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMultiple extends Model
{
    use HasFactory;

    protected $table = 'chat_multiples';

    protected $fillable = ['account_id', 'message', 'user_identifier',];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}