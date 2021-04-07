<?php

namespace App\Repositories;

use App\Models\Tag;
use App\Models\User;
use Spatie\Permission\Models\Permission;

class TagRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'color',
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Tag::class;
    }

    public function deleteWithPermissions($tag)
    {
        $this->delete($tag->id);
        //delete tag permissions
        $permissions = [];
        foreach (config('constants.TAG_LEVEL_PERMISSIONS') as $perm_key => $perm) {
            $permissions[] = $perm_key . $tag->id;
        }

        /** @var User $user */
        $users = User::permission($permissions)->get();
        foreach ($users as $user) {
            $user->revokePermissionTo($permissions);
        }
        Permission::whereIn('name', $permissions)->delete();
    }
}
