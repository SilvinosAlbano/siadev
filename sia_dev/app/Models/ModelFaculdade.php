<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelFaculdade extends Model
{
    use HasFactory;
    protected $table = 'faculdade';
    protected $primaryKey = 'id_faculdade';
    public $incrementing = false;
    protected $keyType = 'uuid';
    protected $fillable = ['nome_faculdade'];

    // Relationships
    public function departamentos()
    {
        return $this->hasMany(ModelDepartamento::class, 'id_faculdade', 'id_faculdade');
    }
}
