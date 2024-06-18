<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class StudentCourse extends Model
{
    protected $fillable = [
        'course_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}