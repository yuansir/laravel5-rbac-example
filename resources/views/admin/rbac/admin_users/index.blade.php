@extends('layouts.admin-app')

@section('content')

    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        {!! Breadcrumbs::render('admin-user-index') !!}
    </div>

    <div class="contentpanel panel-email">

        <div class="row">

            @include('admin._partials.rbac-left-menu')

            <div class="col-sm-9 col-lg-10">

                <div class="panel panel-default">
                    <div class="panel-body">

                        <div class="pull-right">
                            <div class="btn-group mr10">
                                <a href="{{ route('admin.admin_user.create') }}" class="btn btn-white tooltips"
                                   data-toggle="tooltip" data-original-title="新增"><i
                                            class="glyphicon glyphicon-plus"></i></a>
                                <a class="btn btn-white tooltips deleteall" data-toggle="tooltip"
                                   data-original-title="删除" data-href="{{ route('admin.admin_user.destroy.all') }}"><i
                                            class="glyphicon glyphicon-trash"></i></a>
                            </div>
                        </div><!-- pull-right -->

                        <h5 class="subtitle mb5">用户列表</h5>

                        @include('admin._partials.show-page-status',['result'=>$users])

                        <div class="table-responsive col-md-12">
                            <table class="table mb30">
                                <thead>
                                <tr>
                                    <th>
                                        <span class="ckbox ckbox-primary">
                                            <input type="checkbox" id="selectall"/>
                                            <label for="selectall"></label>
                                        </span>
                                    </th>
                                    <th>用户名</th>
                                    <th>邮箱</th>
                                    <th>超级管理员</th>
                                    <th>所属角色</th>
                                    <th>创建时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>
                                            <div class="ckbox ckbox-default">
                                                <input type="checkbox" name="id" id="id-{{ $user->id }}"
                                                       value="{{ $user->id }}" class="selectall-item"/>
                                                <label for="id-{{ $user->id }}"></label>
                                            </div>
                                        </td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{!! $user->is_super ? '<span class="label label-danger">是</span>':'<span class="label label-default">否</span>' !!}</td>
                                        <td>
                                            @if($user->roles()->count())
                                                @foreach($user->roles()->get() as $role)
                                                    <span class="badge badge-info">{{ $role->display_name }}</span>
                                                @endforeach
                                            @else
                                                <span class="badge">无</span>
                                            @endif
                                        </td>
                                        <td>{{ $user->created_at }}</td>
                                        <td>
                                            <a href="{{ route('admin.admin_user.edit',['id'=>$user->id]) }}"
                                               class="btn btn-white btn-xs"><i class="fa fa-pencil"></i> 编辑</a>
                                            <a class="btn btn-danger btn-xs user-delete"
                                               data-href="{{ route('admin.admin_user.destroy',['id'=>$user->id]) }}">
                                                <i class="fa fa-trash-o"></i> 删除</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        {!! $users->render() !!}

                    </div><!-- panel-body -->
                </div><!-- panel -->

            </div><!-- col-sm-9 -->

        </div><!-- row -->

    </div>
@endsection

@section('javascript')
    @parent
    <script src="{{ asset('js/ajax.js') }}"></script>
    <script type="text/javascript">
        $(".user-delete").click(function () {
            Rbac.ajax.delete({
                confirmTitle: '确定删除用户?',
                href: $(this).data('href'),
                successTitle: '用户删除成功'
            });
        });

        $(".deleteall").click(function () {
            Rbac.ajax.deleteAll({
                confirmTitle: '确定删除选中的用户?',
                href: $(this).data('href'),
                successTitle: '用户删除成功'
            });
        });
    </script>

@endsection
