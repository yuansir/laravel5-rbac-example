<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\AdminUserRoleRepository;
use App\Models\AdminUserRole;

/**
 * Class AdminUserRoleRepositoryEloquent
 * @package namespace App\Repositories;
 */
class AdminUserRoleRepositoryEloquent extends BaseRepository implements AdminUserRoleRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return AdminUserRole::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
