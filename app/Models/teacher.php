<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'user_id',
        'photo_license',
        'is_teacher',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }



    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function groups()
    {
        return $this->hasMany(Group::class);
    }
}