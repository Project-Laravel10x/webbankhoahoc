<?php

namespace Modules\Groups\src\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Module extends Model
{

    protected $fillable = [
        'name',
        'title',
        'role',
    ];

}
