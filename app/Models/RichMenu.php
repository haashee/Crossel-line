<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RichMenu extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'width', 'height', 'image', 'display_text', 'richmenu_id', 'account_id',
        'text_a', 'text_b', 'text_c', 'text_d', 'text_e', 'text_f',
        'url_a', 'url_b', 'url_c', 'url_d', 'url_e', 'url_f',
        'multi_a', 'multi_b', 'multi_c', 'multi_d', 'multi_e', 'multi_f',
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}