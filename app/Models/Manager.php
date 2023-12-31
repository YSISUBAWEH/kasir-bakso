<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Manager extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guard = 'manager';
    public $table = "manager";
    protected $fillable = [
        'name', 'username', 'password',
    ];
    protected $hidden = [
      'password', 'remember_token',
    ];
}
