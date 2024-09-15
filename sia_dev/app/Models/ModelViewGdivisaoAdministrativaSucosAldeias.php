<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelViewGdivisaoAdministrativaSucosAldeias extends Model
{
    use HasFactory;
    protected $table = 'gdivisao_administrativa_sucos_aldeias_view';
    public $timestamps = false; // Set to false as views generally don't have timestamps
}
