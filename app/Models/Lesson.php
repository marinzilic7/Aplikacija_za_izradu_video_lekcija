<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = [
        'naslov', 'opis', 'video', 'user_id','course_id'
    ];
    public $timestamps = true;
    use HasFactory;
}
