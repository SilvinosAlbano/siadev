<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Semester extends Model
{
    use HasFactory;
    protected $primaryKey = 'semester_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'semester_id',
        'semester_name',
        'description',
    ];

    protected static function boot()
    {
        parent::boot();

        // Generate a UUID for the 'id' field
        static::creating(function ($model) {
            if (empty($model->semester_id)) {
                $model->semester_id = (string) Str::uuid();
            }
        });
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
