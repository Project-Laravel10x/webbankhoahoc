<?php

namespace Modules\User\src\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Modules\Groups\src\Models\Group;
use Modules\Students\src\Models\Student;
use Tymon\JWTAuth\Contracts\JWTSubject;

class OnlineUser extends Model
{

    protected $table = "online_students";

    protected $fillable = [
        'student_id',
        'last_activity',
    ];

    public function students(){
        return $this->belongsTo(Student::class,'student_id','id');
    }

}
