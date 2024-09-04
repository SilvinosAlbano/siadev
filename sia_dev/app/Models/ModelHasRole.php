<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelHasRole extends Model
{
    use HasFactory;

    protected $primaryKey = null;
    public $incrementing = false;

    protected $fillable = [
        'model_id',
        'model_type',
        'role_id',
        'expires_at',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id_roles');
    }
}
