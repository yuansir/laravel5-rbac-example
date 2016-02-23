@extends('layouts.admin-app')

@section('content')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        {!! Breadcrumbs::render('admin-user-create') !!}
    </div>

    <div class="contentpanel panel-email">

        <div class="row">

            @include('admin._partials.rbac-left-menu')

            <div class="col-sm-9 col-lg-10">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-btns">
                            <a href="" class="panel-close">×</a>
                            <a href="" class="minimize">−</a>
                        </div>
                        <h4 class="panel-title">添加用户</h4>
                    </div>

                    <form class="form-horizontal form-bordered" action="{{ route('admin.admin_user.store') }}" method="POST">

                        <div class="panel-body panel-body-nopadding">
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="checkbox">所属角色组</label>
                                <div class="col-sm-6">
                                    @inject('rolePresenter','App\Presenters\RolePresenter')

                                    {!! $rolePresenter->rolesCheckbox() !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">用户名 <span class="asterisk">*</span></label>

                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="name"
                                           data-trigger="hover" class="form-control tooltips"
                                           data-original-title="不可重复" value="{{ old('name') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">邮箱 <span class="asterisk">*</span></label>

                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="email"
                                           data-trigger="hover" class="form-control tooltips"
                                           data-original-title="不可重复" value="{{ old('email') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">密码 <span class="asterisk">*</span></label>

                                <div class="col-sm-6">
                                    <input type="password"  data-toggle="tooltip" name="password"
                                           data-trigger="hover" class="form-control tooltips"
                                           data-original-title="请输入密码" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">超级管理员 <span class="asterisk"></span></label>

                                <div class="col-sm-2">
                                    <select class="form-control input-sm" name="is_super">
                                        <option value="1" {{ old('is_super') == 1 ? 'selected':'' }}>是</option>
                                        <option value="0" {{ old('is_super') == 0 ? 'selected':'' }}>否</option>
                                    </select>
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
