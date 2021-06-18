<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class carEquipment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'car_id',
        'equipment_id',
        'amount',
        'expiry_date',
    ];
}
