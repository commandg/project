<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'group_id',
        'body',
        'sent_date',
    ];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}