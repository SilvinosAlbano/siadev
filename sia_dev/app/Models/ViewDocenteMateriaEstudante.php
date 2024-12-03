<?php
// app/Models/ViewPostoSuco.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ViewDocenteMateriaEstudante extends Model
{
    protected $table = 'view_docente_materia_estudante'; // Lowercase and no quotes
    public $incrementing = false; // If the view has no primary key
    public $timestamps = false; // Disable timestamps for views
}
