<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\RoleRepository;
use App\Models\Role;

/**
 * Class RoleRepositoryEloquent
 * @package namespace App\Repositories;
 */
class RoleRepositoryEloquent extends BaseRepository implements RoleRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Role::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * delete role
     * @param $id
     * @return bool|int
     */
    public function delete($id)
    {
        $role = $this->model->find($id);
        if(!$role) {
            return false;
        }
        $role->users()->detach();
        return parent::delete($id);
    }

    /**
     * update role
     * @param array $attributes
     * @param $id
     * @return array
     */
    public function update(array $attributes, $id)
    {
        $isAble = $this->model->where('id', '<>', $id)->where('name', $attributes['name'])->count();
        if($isAble) {
            return [
                'status' => false,
                'msg' => '角色名已被使用'
            ];
        }


        $data = [];
        $data['name'] = $attributes['name'];
        $data['display_name'] = $attributes['display_name'];
        $data['description'] = $attributes['description'];
        $result = parent::update($data, $id);
        if(!$result) {
            return [
                'status' => false,
                'msg' => '角色更新失败'
            ];
        }

        return ['status' => true];
    }

    /**
     * save role permissions
     * @param $id
     * @param array $perms
     * @return bool
     */
    public function savePermissions($id, $perms = [])
    {
        $role = $this->model->find($id);
        $role->perms()->sync($perms);

        return true;
    }

    /**
     * get role's permissions
     * @param $id
     * @return array
     */
    public function rolePermissions($id)
    {
        $perms = [];
        $permissions = $this->model->find($id)->perms()->get();

        foreach ($permissions as $item) {
            $perms[$item->id] = $item->name;
        }

        return $perms;
    }
}
