<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelDatas extends Model
{
  
    use HasFactory;
    protected $table = 'datas';
    protected $primaryKey = 'id_datas';
    public $incrementing = false;
    protected $keyType = 'uuid';

    protected $fillable = [
        'id_datas',
        'data',
        'observacao'
        
    ];
}
