<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class HabilitacaoModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $primaryKey = 'id_habilitacao';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'habilitacao';

    protected $fillable = [
        'id_habilitacao',
        'habilitacao',
        'area_especialidade',
        'universidade_origem'
        
    ];
}
