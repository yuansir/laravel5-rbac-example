<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\PermissionRepositoryEloquent;
use App\Http\Requests\Admin\Permission\CreateRequest;
use App\Http\Requests\Admin\Permission\UpdateRequest;
use Breadcrumbs, Toastr;

class PermissionController extends BaseController
{
    protected $permission;

    protected $permissionRole;

    public function __construct(PermissionRepositoryEloquent $permission)
    {
        parent::__construct();
        $this->permission = $permission;

        Breadcrumbs::setView('admin._partials.breadcrumbs');

        Breadcrumbs::register('admin-permission', function ($breadcrumbs) {
            $breadcrumbs->parent('dashboard');
            $breadcrumbs->push('权限管理', route('admin.permission.index'));
        });

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Breadcrumbs::register('admin-permission-index', function ($breadcrumbs) {
            $breadcrumbs->parent('admin-permission');
            $breadcrumbs->push('权限列表', route('admin.permission.index'));
        });

        $permissions = $this->permission->topPermissions();
        return view('admin.rbac.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Breadcrumbs::register('admin-permission-create', function ($breadcrumbs) {
            $breadcrumbs->parent('admin-permission');
            $breadcrumbs->push('添加权限', route('admin.permission.create'));
        });
        return view('admin.rbac.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $result = $this->permission->create($request->all());

        if(!$result) {
            Toastr::error('新权限添加失败!');
            return redirect('admin/permission/create');
        } else {
            Toastr::success('新权限添加成功!');
            return redirect('admin/permission');
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
        Breadcrumbs::register('admin-permission-edit', function ($breadcrumbs) use ($id) {
            $breadcrumbs->parent('admin-permission');
            $breadcrumbs->push('编辑权限', route('admin.permission.edit', ['id' => $id]));
        });

        $permission = $this->permission->find($id);
        return view('admin.rbac.permissions.edit', compact('permission'));
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
        $result = $this->permission->update($request->all(), $id);
        if(!$result['status']) {
            Toastr::error($result['msg']);
        } else {
            Toastr::success('权限更新成功');
        }
        return redirect(route('admin.permission.edit', ['id' => $id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->permission->delete($id);
        return response()->json($result ? ['status' => 1] : ['status' => 0]);
    }

    /**
     * Delete multi permissions
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroyAll(Request $request)
    {
        if(!($ids = $request->get('ids', []))) {
            return response()->json(['status' => 0, 'msg' => '请求参数错误']);
        }

        foreach ($ids as $id) {
            $result = $this->permission->delete($id);
        }
        return response()->json($result ? ['status' => 1] : ['status' => 0]);
    }
}
