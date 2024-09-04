<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModulePermission extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_module_permissions';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'module_name',
        'role_id',
        'permission_id',
        'expires_at',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id_roles');
    }

    public function permission()
    {
        return $this->belongsTo(Permission::class, 'permission_id', 'id_permissions');
    }
}
