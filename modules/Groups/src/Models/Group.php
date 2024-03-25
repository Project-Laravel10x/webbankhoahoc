<?php

namespace Modules\Groups\src\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Modules\User\src\Models\User;

class Group extends Model
{

    protected $fillable = [
        'name',
        'permissions',
        'user_id',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'group_id', 'id');
    }

    public function usersId()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
