<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentSession extends Model
{
    use HasFactory;

    protected $table = 'student_sessions';

    // The attributes that are mass assignable.
    protected $fillable = [
        'year',
        'month',
        'week',
        'day_of_week',
        'attendance_status',
        'attendance_date',
    ];
}
