<?php
/**
 * Created by PhpStorm.
 * User: hassan
 * Date: 12/7/19
 * Time: 11:19 AM
 */

namespace App\Traits;


use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Trait HasRole
 * @package App\Traits
 */
trait HasRole
{
    /**
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(
            Role::class, 'user_roles', 'user_id', 'role_id'
        )->withTimestamps();
    }

    /**
     * @param string $role
     * @return void
     */
    public function actAs(string $role): void
    {
        $role = Role::whereName($role)->firstOrFail();

        if (!$this->roles->contains('id', $role->id)) {
            $this->roles()->sync($role);
        }
    }

    /**
     * @param $role
     * @return bool
     */
    public function hasRole($role): bool
    {
        if (is_string($role)) {
            return $this->roles->contains('name', $role);
        }

        return !!$role->intersect($this->roles)->count();
    }

    /**
     * @param string $model
     * @return bool
     */
    public function hasRoleOnModel(string $model): bool
    {
        $roles = $this->roles()->with('permissions')->get();

        foreach ($roles as $role) {
            return $role->permissions->contains('model', strtolower($model));
        }

        return false;
    }
}
