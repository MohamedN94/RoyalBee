<?php

namespace App\Models;

use App\Helper\RolesHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'roles';

    /**
     * @var array
     */
    protected $fillable = ['name','name_ar', 'label',
        'counter'];


    /**
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class, 'user_roles', 'role_id', 'user_id'
        )->withTimestamps();
    }

    /**
     * @return BelongsToMany
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(
            Permission::class, 'role_permissions', 'role_id', 'permission_id'
        )->withTimestamps();
    }

    /**
     * @param $permissions
     */
    public function givePermissionTo($permissions)
    {
        // if single permission assign it directly.
        if (!is_countable($permissions)) {
            $this->assignPermission($permissions);
        } else {
            // else if permissions is countable we have to iterate and assign each permission.
            collect($permissions)->each(function ($permission) {
                $this->assignPermission($permission);
            });
        }
    }

    /**
     * @param Permission $permission
     */
    private function assignPermission(Permission $permission): void
    {
        if (!$this->permissions->contains('id', $permission->id)) {
            $this->permissions()->save($permission);
        }
    }

    /**
     * @return bool
     */
    public function isBasic(): bool
    {
        return in_array($this->name, RolesHelper::BASIC_ROLES);
    }
}
