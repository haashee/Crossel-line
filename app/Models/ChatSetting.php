<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatSetting extends Model
{
    use HasFactory;

    protected $fillable = ['account_id', 'welcome_text_active', 'welcome_text', 'default_text_active', 'default_text', 'notify_email',];
}