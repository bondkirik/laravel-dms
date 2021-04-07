<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

/**
 * @property int $id
 * @property string $name
 * @property string|null $email
 * @property string $username
 * @property string $address
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string $status
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUsername($value)
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @property-read mixed $is_super_admin
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User role($roles, $guard = null)
 * @property \App\Models\Relation $relation
 * @property string $organization
 */
class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public $table = 'users';

    public $fillable = [
        'name',
        'email',
        'username',
        'address',
        'description',
        'password',
        'status',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'email' => 'string',
        'username' => 'string',
        'address' => 'string',
        'description' => 'string',
        'status' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'email' => 'email|nullable|unique:users,email',
        'username' => 'required|unique:users,username',
        'address' => 'nullable',
        'description' => 'nullable',
        'password' => 'required|min:6',
        'status' => 'required',
    ];

    public function getIsSuperAdminAttribute()
    {
        return ($this->id == 1) ? true : false;
    }

    public function relation(): HasOne
    {
        return $this->hasOne(Relation::class);
    }

    public function getOrganizationAttribute()
    {
        return $this->relation->corporation->title . ' -> ' .
            $this->relation->company->title . ' -> ' .
            $this->relation->department->title;
    }

    //    public function scopePermission($query, $permissions)
    //    {
    //        if ($permissions instanceof Collection) {
    //            $permissions = $permissions->toArray();
    //        }
    //
    //        if (! is_array($permissions)) {
    //            $permissions = [$permissions];
    //        }
    //
    //        $permissions = array_map(function ($permission) {
    //            if ($permission instanceof Permission) {
    //                return $permission;
    //            }
    //
    //            return app(Permission::class)->findByName($permission);
    //        }, $permissions);
    //
    //        return $query->whereHas('permissions', function ($query) use ($permissions) {
    //            $query->where(function ($query) use ($permissions) {
    //                foreach ($permissions as $permission) {
    //                    $query->orWhere(config('laravel-permission.table_names.permission').'.id', $permission->id);
    //                }
    //            });
    //        });
    //    }
}
