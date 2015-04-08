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
        <li class="am-active"><a href="{{ route('admin.rbac.user.edit',['id'=>$user->id]) }}">编辑用户</a></li>
    </ul>

    <div class="am-tabs-bd">
        <div class="am-tab-panel am-fade am-in am-active" id="tab1">

            @include('admin.alert')

            <form class="am-form" action="{{ route('admin.rbac.user.update',['id'=>$user->id]) }}" method="POST">
                @if($roles)
                <div class="am-g am-margin-top">
                    <div class="am-u-sm-4 am-u-md-2 am-text-right">
                        角色组
                    </div>
                    <div class="am-u-sm-8 am-u-md-4">
                        <ul >
                            @foreach($roles as $role)
                            <li>
                                <label class="am-checkbox-inline">
                                    @if($user->hasRole($role->name))
                                    <input name="roles[]" type="checkbox" value="{{ $role->id }}" checked> {{ $role->display_name }}
                                    @else
                                    <input name="roles[]" type="checkbox" value="{{ $role->id }}"> {{ $role->display_name }}
                                    @endif
                                </label>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="am-hide-sm-only am-u-md-6"></div>
                </div>
                @endif
                <div class="am-g am-margin-top">
                    <div class="am-u-sm-4 am-u-md-2 am-text-right">
                        用户名
                    </div>
                    <div class="am-u-sm-8 am-u-md-4">
                        <input type="text" class="am-input-sm" name="name" value="{{ $user->name }}">
                    </div>
                    <div class="am-hide-sm-only am-u-md-6">*必填，不可重复</div>
                </div>

                <div class="am-g am-margin-top">
                    <div class="am-u-sm-4 am-u-md-2 am-text-right">
                        邮箱
                    </div>
                    <div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
                        <input type="text" class="am-input-sm" name="email" value="{{ $user->email }}">
                    </div>
                    <div class="am-hide-sm-only am-u-md-6">*必填，不可重复</div>
                </div>

                <div class="am-g am-margin-top">
                    <div class="am-u-sm-4 am-u-md-2 am-text-right">
                        密码
                    </div>
                    <div class="am-u-sm-8 am-u-md-4">
                        <input type="password" class="am-input-sm" name="password" value="">
                    </div>
                    <div class="am-hide-sm-only am-u-md-6">只修改密码时填写</div>
                </div>

                <div class="am-g am-margin-top">
                    <div class="am-u-sm-8 am-u-md-4 am-u-sm-centered">
                        <input name="_method" type="hidden" value="PUT">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="am-btn am-btn-primary am-btn-xs">提交保存</button>
                    </div>
                </div>

            </form>
        </div>

    </div>
</div>

@stop

