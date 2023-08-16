<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\MultiTenantModelTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory;
    use SoftDeletes, MultiTenantModelTrait;
    public $fillable=[
        'student_id',
        'name',
        'email',
        'phone',
        'address',
        'education',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function programs()
    {
        return $this->belongsToMany(Program::class,'registrations');
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }
}
