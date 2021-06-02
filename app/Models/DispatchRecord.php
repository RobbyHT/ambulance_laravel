<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class DispatchRecord extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'start',
        'start_lat',
        'start_lng',
        'end',
        'end_lat',
        'end_lng',
        'd_date',
        'd_time',
        'o2',
        'elevator',
        'special',
        'weight',
        'phone',
        'remark',
        'driver_id',
        'state',
        'user_id',
    ];
}
