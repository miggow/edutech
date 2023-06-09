<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Course;
use App\Auth;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
        'phone',
        'role',
        'status',
        'image',
        'address',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function course()
    {
        return $this->hasMany(course::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function commentPosts()
    {
        return $this->hasMany(CommentPost::class);
    }
    public function classrooms()
    {
        return $this->belongsToMany(ClassRoom::class);
    }
    public function checkCourse()
    {
        $user_id = auth()->id();

        $courses = Course::where('instructor_id', $user_id)->get();

        if ($courses->count() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
