<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendanc extends Model
{
    //
    protected $fillable = [
        'student_id',
        'grade_id',
        'date',
        'status',
        'reason',
    ];

    public function stundet() 
    {
        return $this->belongsTo(Student::class);
    }
    public function grade() 
    {
        return $this->belongsTo(Grade::class);
     }
}
