<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Program extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $fillable=[
        'name',
        'academic_year'
    ];
    public function students(){
        return $this->belongsToMany(Student::class,'registrations');
    }
    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }
}
