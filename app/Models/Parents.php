<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parents extends Model
{
    use HasFactory;

    protected $table = 'parent';

    protected $fillable = [
        'id', 
        'nama_orangtua', 
        'alamat', 
        'no_telp', 
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
