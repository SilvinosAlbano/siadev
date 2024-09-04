<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Module extends Model
{
    protected $table = 'modules'; // Specify the table name
    protected $primaryKey = 'module_id'; // Specify the primary key column
    public $incrementing = false; // UUIDs are not incrementing integers
    protected $keyType = 'string'; // UUIDs are strings

    protected $fillable = ['name']; // Specify which columns are mass assignable

    protected static function booted()
    {
        static::creating(function ($module) {
            $module->module_id = (string) Str::uuid(); // Generate UUID on creation
        });
    }
    public function permissions()
    {
        return $this->hasMany(ModulePermission::class, 'module_name', 'module_id');
    }
}
