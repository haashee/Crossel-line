<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineUser extends Model
{
    use HasFactory;

    protected $table = 'line_users';

    protected $fillable = ['name', 'line_id', 'provider', 'mode', 'account_id'];

    protected $primaryKey = 'id';

    public function account()
    {
        return $this->belongsTo(
            Account::class,
            "user_id",
        );
    }
}