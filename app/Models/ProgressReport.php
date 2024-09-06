<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;

class ProgressReport extends Model
{
    protected $fillable = ['student_id', 'module_name', 'certificate_path', 'note'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
