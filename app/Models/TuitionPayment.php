<?php
// app/Models/TuitionPayment.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TuitionPayment extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'amount', 'payment_date', 'month', 'status', 'receipt'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
