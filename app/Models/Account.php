<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = ['channel_secret', 'access_token', 'user_id', 'image', 'name'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lineUsers()
    {
        return $this->hasMany(LineUser::class);
    }
}