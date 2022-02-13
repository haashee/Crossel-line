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

    public function getProfilepictureFilenameAttribute()
    {
        if (!$this->attributes['image']) {
            return '/images/default_profilepicture.png';
        }

        return $this->attributes['image'];
    }
}