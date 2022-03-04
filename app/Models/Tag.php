<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'color', 'isPublic', 'account_id'];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function chatMultiples()
    {
        return $this->belongsToMany(ChatMultiple::class);
    }

    public function lineUsers()
    {
        return $this->belongsToMany(LineUser::class);
    }
}