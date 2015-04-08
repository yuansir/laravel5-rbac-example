<?php namespace App\Repositories\Admin;

use App\Models\Admin\Permission;
use App\Repositories\BaseRepository;
class PermissionRepository extends BaseRepository {
    protected $model;

    public function __construct(Permission $model)
    {
        $this->model = $model;
    }

    /**
     * Get permission list
     * @param $perPage
     * @return mixed
     */
    public function permissionList($perPage)
    {
        return $this->model->orderBy('id','desc')->paginate($perPage);
    }

    /**
     * Store a permission
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
     * Destroy permission by id
     * @param int $id
     * @return bool|null
     */
    public function destroy($id)
    {
        $permission = $this->model->find($id);
        if(!$permission){
            return false;
        }
        $permission->roles()->detach();
        return $permission->delete();
    }

    /**
     * Update permission
     * @param $id
     * @param $inputs
     * @return array
     */
    public function update($id, $inputs)
    {
        $isAble = $this->model->where('id', '<>', $id)->where('name', $inputs['name'])->count();
        if ($isAble) {
            return [
                'status' => false,
                'error' => '权限名已被使用'
            ];
        }

        $data = [];
        $data['name'] = $inputs['name'];
        $data['display_name'] = $inputs['display_name'];
        $data['description'] = $inputs['description'];
        $result = $this->model->where('id', $id)->update($data);
        if (!$result) {
            return [
                'status' => false,
                'error' => '权限更新失败'
            ];
        }

        return ['status' => true];
    }
}