<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelViewGdivisaoAdministrativaPostoAdministrativo extends Model
{
    use HasFactory;
    protected $table = 'gdivisao_administrativa_posto_administrativo_view';
    public $timestamps = false; // Set to false as views generally don't have timestamps
}
