<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceivedMedia extends Model
{
    use HasFactory;

    protected $fillable = ['account_id', 'type', 'senderName', 'media', 'delete_at'];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}