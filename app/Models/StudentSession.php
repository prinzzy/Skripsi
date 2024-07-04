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
        'nama',
        'month',
        'week',
        'day_of_week',
        'attendance_status1',
        'attendance_status2',
        'attendance_date1',
        'attendance_status3',
        'attendance_date2',
        'attendance_status4',
        'attendance_date3',
        'attendance_date4',
        'student_id',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }
}
