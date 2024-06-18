<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
        'course_id',
        'teacher_id',
        'group_name',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function groupStudents()
    {
        return $this->hasMany(GroupStudent::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}