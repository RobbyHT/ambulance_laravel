<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class consumablesRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'dispatch_id',
        'consumables_id',
    ];
}
