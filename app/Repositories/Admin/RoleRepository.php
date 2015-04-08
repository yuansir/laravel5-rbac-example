<?php namespace App\Repositories\Admin;

use App\Models\Admin\Role;
use App\Repositories\BaseRepository;

class RoleRepository extends BaseRepository {
    protected $model;

    public function __construct(Role $model)
    {
        $this->model = $model;
    }

    /**
     * Get role list
     * @param $perPage
     * @return mixed
     */
    public function roleList($perPage)
    {
        return $this->model->orderBy('id', 'desc')->paginate($perPage);
    }

    /**
     * Store role
     * @param $inputs
     * @return mixed
     */
    public function store($inputs)
    {
        $model = new $this->model;
        $model->name = $inputs['name'];
        $model->display_name = $inputs['display_name'];
        $model->description = $inputs['description'];
        return $model->save();
    }

    /**
     * Save role's permissions
     * @param $id
     * @param array $perms
     * @return mixed
     */
    public function savePerms($id, $perms = [])
    {
        $role = $this->getById($id);
        return $role->perms()->sync($perms);
    }

    /**
     * Get role's permissions
     * @param $id
     * @return array
     */
    public function rolePerms($id)
    {
        $perms = [];
        $permissions = $this->getById($id)->perms()->get();

        foreach ($permissions as $item) {
            $perms[$item->id] = $item->name;
        }

        return $perms;
    }

    /**
     * Update Role
     * @param $id
     * @param $inputs
     */
    public function update($id, $inputs)
    {
        $data = [];
        $data['display_name'] = $inputs['display_name'];
        $data['description'] = $inputs['description'];
        $result = $this->model->where('id', $id)->update($data);
        if (!$result) {
            return [
                'status' => false,
                'error' => '角色更新失败'
            ];
        }

        return ['status' => true];
    }

    /**
     * Destroy role by id
     * @param int $id
     * @return bool|null
     */
    public function destroy($id)
    {
        $role = $this->model->find($id);
        if(!$role){
            return false;
        }
        $role->users()->detach();
        return $role->delete();
    }

}