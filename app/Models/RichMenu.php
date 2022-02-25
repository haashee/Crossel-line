<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RichMenu extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'width', 'height', 'image', 'display_text', 'richmenu_id', 'account_id'];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}