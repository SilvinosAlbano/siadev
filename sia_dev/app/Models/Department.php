<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Department extends Model
{
    use HasFactory;

    protected $primaryKey = 'department_id'; // Specify the primary key

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'department_id',
        'department_name',
        'faculty',
    ];

    protected static function boot()
    {
        parent::boot();

        // Generate a UUID for the 'department_id' field
        static::creating(function ($model) {
            if (empty($model->department_id)) {
                $model->department_id = (string) Str::uuid();
            }

            // Set default value for faculty
            if (empty($model->faculty)) {
                $model->faculty = 'Ciência da Saúde';
            }
        });
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'department_id');
    }
}
