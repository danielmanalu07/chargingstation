<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChargingSession extends Model
{
    use HasFactory;

    public $table = 'charging_sessions';

    protected $fillable = [
        'id_user',
        'car_id',
        'input_harga',
        'input_baterai',
        'plug_id',
        'voltage_id',
        'capacity_id',
        'amount_price',
        'charging_time',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class, 'car_id');
    }

    public function plug()
    {
        return $this->belongsTo(Plug::class, 'plug_id');
    }

    public function voltage()
    {
        return $this->belongsTo(Voltage::class, 'voltage_id');
    }

    public function capacity()
    {
        return $this->belongsTo(Voltage::class, 'capacity_id');
    }
}
