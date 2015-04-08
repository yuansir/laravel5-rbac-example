<?php namespace App\Http\Controllers\Admin\Rbac;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests;
use App\Http\Requests\Admin\Rbac\User\CreateRequest;
use App\Http\Requests\Admin\Rbac\User\UpdateRequest;
use App\Repositories\Admin\RoleRepository;
use App\Repositories\Admin\UserRepository;

class UserController extends BaseController {
    protected $userRepository;
    protected $roleRepository;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepository, RoleRepository $roleRepository)
    {
        parent::__construct();
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = $this->userRepository->userList(static::PER_PAGE_NUM);
        return view('admin.rbac.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $roles = $this->roleRepository->getAll();
        return view('admin.rbac.user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateRequest $createRequest)
    {
        $userId = $this->userRepository->store($createRequest->all());
        if ($userId && ($roles = $createRequest->input('roles', []))) {
            $this->userRepository->attachRole($userId, $roles);
        }
        $alert = [
            'type' => $userId ? 'success' : 'warning',
            'data' => $userId ? ['新用户创建成功'] : ['用户创建失败'],
        ];
        return redirect('admin/rbac/user/create')->with('am-alert', $alert);
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
        $user = $this->userRepository->getById($id);
        $roles = $this->roleRepository->getAll();
        return view('admin.rbac.user.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id, UpdateRequest $updateRequest)
    {
        $result = $this->userRepository->update($id, $updateRequest->all());
        if (!$result['status']) {
            $alert = [
                'type' => 'warning',
                'data' => [$result['error']],
            ];
        }
        else {
            $alert = [
                'type' => 'success',
                'data' => ['用户更新成功'],
            ];
        }
        return redirect(route('admin.rbac.user.edit', ['id' => $id]))->with('am-alert', $alert);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $result = $this->userRepository->destroy($id);
        $alert = [
            'type' => $result ? 1 : 0,
            'message' => $result ? '用户已删除' : '用户删除失败',
        ];
        return response()->json($alert);
    }

}
