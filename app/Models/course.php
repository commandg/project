<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'teacher_id',
        'course_name',
        'course_type',
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function studentCourses()
    {
        return $this->hasMany(StudentCourse::class);
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }

    public function groups()
    {
        return $this->hasMany(Group::class);
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }
}