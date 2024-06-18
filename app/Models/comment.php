<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'student_course_id',
        'value',
    ];

    public function studentCourse()
    {
        return $this->belongsTo(StudentCourse::class);
    }
}