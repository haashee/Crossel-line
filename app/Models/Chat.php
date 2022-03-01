<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'user_identifier', 'message', 'lineuser_id', 'senderName', 'receiverName'];

    public function scopeGetData($query)
    {
        return $this->created_at . ' @' . $this->user_name . ' ' . $this->message;
    }

    public function lineUser()
    {
        return $this->belongsTo(
            LineUser::class,
            "id",
        );
    }
}