<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Student extends Model
{
    use HasFactory;
    protected $primaryKey = 'student_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'student_id',
        'complete_name',
        'gender',
        'place_of_birth',
        'date_of_birth',
        'nre',
        'department_id',
        'semester_id',
        'start_year',
        'student_image',
        'observation',
    ];

    protected static function boot()
    {
        parent::boot();

        // Generate a UUID for the 'id' field
        static::creating(function ($model) {
            if (empty($model->student_id)) {
                $model->student_id = (string) Str::uuid();
            }
        });
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class, 'semester_id');
    }

     // Relationship with User
     public function user()
     {
         return $this->hasOne(User::class, 'student_id', 'student_id');
     }
}
