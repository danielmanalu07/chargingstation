<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Capacity extends Model
{
    use HasFactory;
    public $table = 'capacities';

    protected $fillable =
    [
        'amount_capacity', 'type'
    ];
}
