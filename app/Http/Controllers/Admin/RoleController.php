<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\PermissionRepositoryEloquent;
use App\Repositories\RoleRepositoryEloquent;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\Admin\Role\CreateRequest;
use App\Http\Requests\Admin\Role\UpdateRequest;
use Toastr, Breadcrumbs;

class RoleController extends BaseController
{
    protected $role;
    protected $permission;

    public function __construct(RoleRepositoryEloquent $role, PermissionRepositoryEloquent $permission)
    {
        parent::__construct();
        $this->role = $role;
        $this->permission = $permission;

        Breadcrumbs::setView('admin._partials.breadcrumbs');

        Breadcrumbs::register('admin-role', function ($breadcrumbs) {
            $breadcrumbs->parent('dashboard');
            $breadcrumbs->push('角色管理', route('admin.role.index'));
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Breadcrumbs::register('admin-role-index', function ($breadcrumbs) {
            $breadcrumbs->parent('admin-role');
            $breadcrumbs->push('角色列表', route('admin.role.index'));
        });

        $roles = $this->role->paginate(10);
        return view('admin.rbac.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Breadcrumbs::register('admin-role-create', function ($breadcrumbs) {
            $breadcrumbs->parent('admin-role');
            $breadcrumbs->push('添加角色', route('admin.role.create'));
        });

        return view('admin.rbac.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $result = $this->role->create($request->all());

        if(!$result) {
            Toastr::error('新角色添加失败!');
            return redirect('admin/role/create');
        } else {
            Toastr::success('新角色添加成功!');
            return redirect('admin/role');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Breadcrumbs::register('admin-role-edit', function ($breadcrumbs) use ($id) {
            $breadcrumbs->parent('admin-role');
            $breadcrumbs->push('编辑角色', route('admin.role.edit', ['id' => $id]));
        });

        $role = $this->role->find($id);
        return view('admin.rbac.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $result = $this->role->update($request->all(), $id);
        if(!$result['status']) {
            Toastr::error($result['msg']);
        } else {
            Toastr::success('角色更新成功');
        }
        return redirect(route('admin.role.edit', ['id' => $id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->role->delete($id);
        return response()->json($result ? ['status' => 1] : ['status' => 0]);
    }

    /**
     * Delete multi roles
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroyAll(Request $request)
    {
        if(!($ids = $request->get('ids', []))) {
            return response()->json(['status' => 0, 'msg' => '请求参数错误']);
        }

        foreach ($ids as $id) {
            $result = $this->role->delete($id);
        }
        return response()->json($result ? ['status' => 1] : ['status' => 0]);
    }

    /**
     * Display a role's permissions
     * @param $id
     * @return \Illuminate\View\View
     */
    public function permissions($id)
    {
        Breadcrumbs::register('admin-role-permission', function ($breadcrumbs) use ($id) {
            $breadcrumbs->parent('admin-role');
            $breadcrumbs->push('编辑角色权限', route('admin.role.permissions', ['id' => $id]));
        });

        $role = $this->role->find($id);
        $permissions = $this->permission->topPermissions();
        $rolePermissions = $this->role->rolePermissions($id);
        return view('admin.rbac.roles.permissions', compact('role', 'permissions', 'rolePermissions'));
    }

    /**
     * Set role's permissions
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storePermissions($id, Request $request)
    {
        $result = $this->role->savePermissions($id, $request->input('permissions', []));
        return response()->json($result ? ['status' => 1] : ['status' => 0]);
    }
}
