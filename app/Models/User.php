<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\company;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'account',
        'name',
        'gender',
        'birther',
        'perid',
        'license_VP',
        'c_id',
        'permission',
        'login_attempt',
        'email',
        'password',
        'telphone',
        'license_path',
    ];

    public function company()
    {
        return $this->hasOne(company::class, 'id', 'c_id');
    }
}
