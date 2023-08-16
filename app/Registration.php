<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;
    public $fillable=[
        'student_id',
        'program_id',
        'registered_at',
        'year',
        'created_at',
        'updated_at'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function program()
    {
        return $this->belongsTo(Program::class);
    }
    
    
}
