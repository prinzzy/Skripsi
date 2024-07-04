<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\StudentSession;
use App\Models\TuitionPayment;

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
        'user_id',
        'nama_orangtua',
        'alamat',
    ];

    public function sessions()
    {
        return $this->hasMany(StudentSession::class);
    }
    public function tuitionPayments()
    {
        return $this->hasMany(TuitionPayment::class);
    }
}
