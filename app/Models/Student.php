<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'student';

    protected $fillable = [
        'nama',
        'sekolah',
        'tanggal_lahir',
        'tanggal_mulai',
        'jadwal_kelas',
        'level',
        'no_hp',
    ];
}
