@extends('admin/app')

@section('content')
<div class="am-cf am-padding">
    <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">首页</strong> / <small>权限控制</small></div>
</div>

<div class="am-tabs am-margin" data-am-tabs>
    <ul class="am-nav am-nav-tabs">
        <li><a href="{{ route('admin.rbac.role.index') }}">角色组</a></li>
        <li class="am-active"><a href="{{ route('admin.rbac.user.index') }}">用户</a></li>
        <li><a href="{{ route('admin.rbac.permission.index') }}">权限</a></li>
    </ul>

    <div class="am-tabs-bd">
        <div class="am-tab-panel am-fade am-in am-active" id="tab1">
            <div class="am-g">
                <div class="am-u-sm-12 am-u-md-6">
                    <div class="am-btn-toolbar">
                        <div class="am-btn-group am-btn-group-xs">
                            <a type="button" href="{{ route('admin.rbac.user.create') }}" class="am-btn am-btn-default"><span class="am-icon-plus"></span> 新增</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="am-g">
                <div class="am-u-sm-12">
                    <form class="am-form">
                        <table class="am-table am-table-striped am-table-hover table-main">
                            <thead>
                            <tr>
                                <th class="table-check">
                                    <input type="checkbox" />
                                </th>
                                <th class="table-id">ID</th>
                                <th class="table-title">用户名</th>
                                <th class="table-type">邮箱</th>
                                <th class="table-date am-hide-sm-only">创建时间</th>
                                <th class="table-set">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td><input type="checkbox" /></td>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td>
                                    <div class="am-btn-toolbar">
                                        <div class="am-btn-group am-btn-group-xs">
                                            <a class="am-btn am-btn-default am-btn-xs am-text-secondary" href="{{ route('admin.rbac.user.edit',['id'=>$user->id]) }}"><span class="am-icon-pencil-square-o"></span> 编辑</a>
                                            <button type="button" class="am-btn am-btn-default am-btn-xs am-text-danger am-user-delete" data-href="{{ route('admin.rbac.user.destroy',['id'=>$user->id]) }}"><span class="am-icon-trash-o"></span> 删除</button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <div class="am-cf">
                                {!! with(new \App\Foundation\Pagination\Paginator($users))->render() !!}
                        </div>
                    </form>
                </div>

            </div>

        </div>

    </div>
</div>

@stop

@section('javascripts')
@parent
<script type="text/javascript">
        $(".am-user-delete").click(function () {
            var href = $(this).data('href');
            if(!confirm('确定删除该用户吗？')){
                return false;
            }
            $.ajax({
                url: href, type:'DELETE',
                success: function (data) {
                    if(data.type == 1){
                        location.reload();
                    }
                    alert(data.message);
                }
            })
        })

</script>
@stop
