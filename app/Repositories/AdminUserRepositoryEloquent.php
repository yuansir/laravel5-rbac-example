<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\AdminUserRepository;
use App\Models\AdminUser;

/**
 * Class AdminUserRepositoryEloquent
 * @package namespace App\Repositories;
 */
class AdminUserRepositoryEloquent extends BaseRepository implements AdminUserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return AdminUser::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Store user
     * @param array $payload
     * @return bool
     */
    public function store($payload = [])
    {
        $id = $this->model->insertGetId([
            'name' => $payload['name'],
            'email' => $payload['email'],
            'password' => bcrypt($payload['password']),
            'is_super' => $payload['is_super']
        ]);

        if(!$id) {
            return false;
        }

        if($id && ($roles = array_get($payload, 'roles'))) {
            $this->attachRoles($id, $roles);
        }
        return true;
    }

    /**
     * update admin user
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
                'msg' => '用户名已被使用'
            ];
        }

        $isAble = $this->model->where('id', '<>', $id)->where('email', $attributes['email'])->count();
        if($isAble) {
            return [
                'status' => false,
                'msg' => '邮箱已被使用'
            ];
        }

        $data = [];
        if($attributes['password']) {
            $data['password'] = bcrypt($attributes['password']);
        }
        $data['name'] = $attributes['name'];
        $data['email'] = $attributes['email'];
        $data['is_super'] = $attributes['is_super'];
        $result = parent::update($data, $id);
        if(!$result) {
            return [
                'status' => false,
                'msg' => '用户更新失败'
            ];
        }
        $this->model->find($id)->roles()->detach();

        if(isset($attributes['roles'])) {
            $this->attachRoles($id, $attributes['roles']);
        }
        return ['status' => true];
    }

    /**
     * delete admin user
     * @param $id
     * @return bool|int
     */
    public function delete($id)
    {
        $user = $this->model->find($id);
        if(!$user) {
            return false;
        }
        $user->roles()->detach();
        return parent::delete($id);
    }

    /**
     * Attach user roles by user id
     * @param $userId
     * @param $roles
     */
    public function attachRoles($userId, $roles)
    {
        $user = $this->model->find($userId);
        $user->attachRoles($roles);
    }
}
