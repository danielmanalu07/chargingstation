<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Password_Reset extends Model
{
    use HasFactory;

    public $table = 'password_resets';

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'token',
        'verification_code',
        'verification_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
