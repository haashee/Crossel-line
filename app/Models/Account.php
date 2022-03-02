<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = ['channel_secret', 'access_token', 'user_id', 'image', 'name', 'liff_full', 'liff_tall', 'liff_compact',];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lineUsers()
    {
        return $this->hasMany(LineUser::class);
    }

    public function tags()
    {
        return $this->hasMany(Tag::class);
    }

    public function accotauntSetting()
    {
        return $this->hasOne(AccountSetting::class, 'account_id', 'id');
    }

    public function chatSetting()
    {
        return $this->hasOne(ChatSetting::class, 'account_id', 'id');
    }

    public function chats()
    {
        return $this->hasManyThrough(
            Chat::class,
            LineUser::class,
            'account_id',
            'lineuser_id'
        );
    }
}