<?php namespace App\Http\Controllers\Admin\Rbac;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests;
use App\Http\Requests\Admin\Rbac\Role\CreateRequest;
use App\Http\Requests\Admin\Rbac\Role\UpdateRequest;
use App\Repositories\Admin\PermissionRepository;
use App\Repositories\Admin\RoleRepository;
use Illuminate\Http\Request;

class RoleController extends BaseController {
    protected $roleRepository;
    protected $permissionRepository;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(RoleRepository $roleRepository, PermissionRepository $permissionRepository)
    {
        parent::__construct();
        $this->roleRepository = $roleRepository;
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $roles = $this->roleRepository->roleList(static::PER_PAGE_NUM);
        return view('admin.rbac.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.rbac.role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateRequest $createRequest)
    {
        $result = $this->roleRepository->store($createRequest->all());
        $alert = [
            'type' => $result ? 'success' : 'warning',
            'data' => $result ? ['新角色创建成功'] : ['角色创建失败'],
        ];
        return redirect('admin/rbac/role/create')->with('am-alert', $alert);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $role = $this->roleRepository->getById($id);
        return view('admin.rbac.role.edit', compact('user', 'role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id, UpdateRequest $updateRequest)
    {
        $result = $this->roleRepository->update($id, $updateRequest->all());
        if (!$result['status']) {
            $alert = [
                'type' => 'warning',
                'data' => [$result['error']],
            ];
        }
        else {
            $alert = [
                'type' => 'success',
                'data' => ['角色更新成功'],
            ];
        }
        return redirect(route('admin.rbac.role.edit', ['id' => $id]))->with('am-alert', $alert);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $result = $this->roleRepository->destroy($id);
        $alert = [
            'type' => $result ? 1 : 0,
            'message' => $result ? '角色已删除' : '角色删除失败',
        ];
        return response()->json($alert);
    }

    /**
     * Display a role's perms
     * @param $id
     * @return \Illuminate\View\View
     */
    public function getPerms($id)
    {
        $role = $this->roleRepository->getById($id);
        $permissions = $this->permissionRepository->getAll();
        $rolePerms = $this->roleRepository->rolePerms($id);
        return view('admin.rbac.role.permissions', compact('role', 'permissions', 'rolePerms'));
    }

    public function postPerms($id, Request $request)
    {
        $result = $this->roleRepository->savePerms($id, $request->input('permissions', []));
        $alert = [
            'type' => $result ? 'success' : 'warning',
            'data' => $result ? ['角色权限保存成功'] : ['角色权限保存失败'],
        ];
        return redirect(route('admin.rbac.role.permissions', ['id' => $id]))->with('am-alert', $alert);
    }

}
