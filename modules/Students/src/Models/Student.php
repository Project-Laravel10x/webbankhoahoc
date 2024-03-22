<?php

namespace Modules\Students\src\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Modules\Courses\src\Models\Course;

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


}
