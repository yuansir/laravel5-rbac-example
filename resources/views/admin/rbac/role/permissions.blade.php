@extends('admin/app')


@section('content')
<div class="am-cf am-padding">
    <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">首页</strong> / <small>权限控制</small>
    </div>
</div>

<div class="am-tabs am-margin" data-am-tabs>
    <ul class="am-nav am-nav-tabs">
        <li><a href="{{ route('admin.rbac.role.index') }}">角色组</a></li>
        <li><a href="{{ route('admin.rbac.user.index') }}">用户</a></li>
        <li><a href="{{ route('admin.rbac.permission.index') }}">权限</a></li>
        <li class="am-active"><a href="{{ route('admin.rbac.role.create') }}">编辑权限</a></li>
    </ul>

    <div class="am-tabs-bd">
        <div class="am-tab-panel am-fade am-in am-active" id="tab1">

            @include('admin.alert')

            <form class="am-form" action="" method="POST">
                <div class="am-g am-margin-top">
                    <h1>h1 标题1</h1>
                </div>

                <div class="am-g am-margin-top">
                    <ul class="am-avg-sm-4">
                        @foreach($permissions as $permission)
                        <li class="am-fl">
                            <label class="am-checkbox-inline">
                                @if(in_array($permission->name,$rolePerms))
                                <input name="permissions[]" type="checkbox" value="{{ $permission->id }}"  checked > <strong  data-am-popover="{content: '{{ $permission->description }}', trigger: 'hover'}">{{ $permission->display_name }}</strong>
                                @else
                                <input name="permissions[]" type="checkbox" value="{{ $permission->id }}"> <strong  data-am-popover="{content: '{content: '{{ $permission->description }}', trigger: 'hover'}', trigger: 'hover focus'}">{{ $permission->display_name }}</strong>
                                @endif
                            </label>
                        </li>
                        @endforeach
                    </ul>

                </div>

                <div class="am-g am-margin-top am-cf">
                    <div class="am-u-sm-8 am-u-md-4 am-u-sm-centered">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="am-btn am-btn-primary am-btn-xs">提交保存</button>
                    </div>
                </div>

            </form>
        </div>

    </div>
</div>

@stop

