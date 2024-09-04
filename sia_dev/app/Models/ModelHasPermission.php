<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelHasPermission extends Model
{
    use HasFactory;

    protected $primaryKey = null;
    public $incrementing = false;

    protected $fillable = [
        'model_id',
        'model_type',
        'permission_id',
    ];

    public function permission()
    {
        return $this->belongsTo(Permission::class, 'permission_id', 'id_permissions');
    }
}
