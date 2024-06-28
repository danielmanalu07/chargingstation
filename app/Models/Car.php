<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    public $table = 'cars';

    protected $fillable = [
        'nama', 'id_voltages', 'id_capacities', 'id_plug', 'image', 'deskripsi', 'id_category_cars',
    ];

    public function voltages()
    {
        return $this->belongsTo(Voltage::class, 'id_voltages');
    }

    public function capacities()
    {
        return $this->belongsTo(Capacity::class, 'id_capacities');
    }

    public function plug()
    {
        return $this->belongsTo(Plug::class, 'id_plug');
    }

    public function categoryCar()
    {
        return $this->belongsTo(CategoryCar::class, 'id_category_cars');
    }

    public function getVoltagesAttribute()
    {
        $voltageIds = json_decode($this->attributes['id_voltages'], true);
        return Voltage::whereIn('id', $voltageIds)->get();
    }

    public function getCapacitiesAttribute()
    {
        $capacityIds = json_decode($this->attributes['id_capacities'], true);
        return Capacity::whereIn('id', $capacityIds)->get();
    }

}
