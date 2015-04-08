<?php namespace App\Http\Controllers\Admin\Rbac;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests;
use App\Http\Requests\Admin\Rbac\Permission\CreateRequest;
use App\Http\Requests\Admin\Rbac\Permission\UpdateRequest;
use App\Repositories\Admin\PermissionRepository;

class PermissionController extends BaseController {
    protected $permissionRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PermissionRepository $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $permissions = $this->permissionRepository->permissionList(static::PER_PAGE_NUM);
        return view('admin.rbac.permission.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.rbac.permission.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateRequest $createRequest)
    {
        $result = $this->permissionRepository->store($createRequest->all());
        $alert = [
            'type' => $result ? 'success' : 'warning',
            'data' => $result ? ['新权限创建成功'] : ['权限创建失败'],
        ];
        return redirect('admin/rbac/permission/create')->with('am-alert', $alert);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $permission = $this->permissionRepository->getById($id);
        return view('admin.rbac.permission.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id, UpdateRequest $updateRequest)
    {
        $result = $this->permissionRepository->update($id, $updateRequest->all());
        if (!$result['status']) {
            $alert = [
                'type' => 'warning',
                'data' => [$result['error']],
            ];
        }
        else {
            $alert = [
                'type' => 'success',
                'data' => ['权限更新成功'],
            ];
        }

        return redirect(route('admin.rbac.permission.edit', ['id' => $id]))->with('am-alert', $alert);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $result = $this->permissionRepository->destroy($id);
        $alert = [
            'type' => $result ? 1 : 0,
            'message' => $result ? '权限已删除' : '权限删除失败',
        ];
        return response()->json($alert);
    }

}
