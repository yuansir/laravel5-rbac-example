@extends('layouts.admin-app')

@section('content')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        {!! Breadcrumbs::render('admin-permission-create') !!}
    </div>

    <div class="contentpanel">

        <div class="row">

            @include('admin._partials.rbac-left-menu')

            <div class="col-sm-9 col-lg-10">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-btns">
                            <a href="" class="panel-close">×</a>
                            <a href="" class="minimize">−</a>
                        </div>
                        <h4 class="panel-title">添加权限</h4>
                    </div>

                    <form class="form-horizontal form-bordered" action="{{ route('admin.permission.store') }}" method="POST">

                    <div class="panel-body panel-body-nopadding">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">所属权限组</label>

                            <div class="col-sm-6">
                                @inject('permissionPresenter','App\Presenters\PermissionPresenter')

                                {!! $permissionPresenter->topPermissionSelect() !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">权限路由 <span class="asterisk">*</span></label>

                            <div class="col-sm-6">
                                <input type="text"  data-toggle="tooltip" name="name"
                                       data-trigger="hover" class="form-control tooltips"
                                       data-original-title="不可重复,不可点击路由输入`#`" value="{{ old('name') }}" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">显示名称</label>

                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="display_name" value="{{ old('display_name') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">说明</label>

                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="description" value="{{ old('description') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">图标<a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank"><i class="fa fa-info-circle"></i></a></label>

                            <div class="col-sm-6">
                                <input type="text"  data-toggle="tooltip" name="icon"
                                       data-trigger="hover" class="form-control tooltips"
                                       data-original-title="图标名称,去fa-前缀" value="{{ old('icon') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">是否菜单</label>

                            <div class="col-sm-1">
                                <select class="form-control input-sm" name="is_menu">
                                    <option value="1" {{ old('is_menu') ? 'selected':'' }}>是</option>
                                    <option value="0" {{ old('is_menu') ? '':'selected' }}>否</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">排序</label>

                            <div class="col-sm-1">
                                <input type="text" class="form-control" name="sort"
                                       value="{{ old('sort') }}">
                            </div>
                        </div>

                        {{ csrf_field() }}
                    </div><!-- panel-body -->

                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-sm-6 col-sm-offset-3">
                                <button class="btn btn-primary">保存</button>
                            </div>
                        </div>
                    </div><!-- panel-footer -->

                    </form>
                </div>

            </div><!-- col-sm-9 -->

        </div><!-- row -->

    </div>
@endsection
