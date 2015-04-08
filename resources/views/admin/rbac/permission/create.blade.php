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
        <li class="am-active"><a href="{{ route('admin.rbac.permission.create') }}">添加权限</a></li>
    </ul>

    <div class="am-tabs-bd">
        <div class="am-tab-panel am-fade am-in am-active" id="tab1">

            @include('admin.alert')

            <form class="am-form" action="{{ route('admin.rbac.permission.store') }}" method="POST">
                <div class="am-g am-margin-top">
                    <div class="am-u-sm-4 am-u-md-2 am-text-right">
                        权限名称
                    </div>
                    <div class="am-u-sm-8 am-u-md-4">
                        <input type="text" class="am-input-sm" name="name" value="{{ old('name') }}">
                    </div>
                    <div class="am-hide-sm-only am-u-md-6">*必填，不可重复</div>
                </div>

                <div class="am-g am-margin-top">
                    <div class="am-u-sm-4 am-u-md-2 am-text-right">
                        显示名称
                    </div>
                    <div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
                        <input type="text" class="am-input-sm" name="display_name" value="{{ old('display_name') }}">
                    </div>
                    <div class="am-hide-sm-only am-u-md-6">选填</div>
                </div>

                <div class="am-g am-margin-top">
                    <div class="am-u-sm-4 am-u-md-2 am-text-right">
                        说明
                    </div>
                    <div class="am-u-sm-8 am-u-md-4">
                        <input type="text" class="am-input-sm" name="description" value="{{ old('description') }}">
                    </div>
                    <div class="am-hide-sm-only am-u-md-6">选填</div>
                </div>


                <div class="am-g am-margin-top">
                    <div class="am-u-sm-8 am-u-md-4 am-u-sm-centered">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}">
                        <button type="submit" class="am-btn am-btn-primary am-btn-xs">提交保存</button>
                    </div>
                </div>

            </form>
        </div>

    </div>
</div>

@stop

