<?php

namespace Modules\Students\src\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Modules\Courses\src\Models\Course;
use Modules\Orders\src\Models\Order;

class Student extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'students';

    protected $fillable = [
        'name',
        'email',
        'is_active',
        'phone',
        'address',
        'password',
    ];


    public function courses()
    {
        return $this->belongsToMany(Course::class, 'students_courses');
    }


    public function orders()
    {
        return $this->hasMany(Order::class, 'student_id','id');
    }


}
