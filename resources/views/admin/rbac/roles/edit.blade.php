@extends('layouts.admin-app')

@section('content')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        {!! Breadcrumbs::render('admin-role-edit') !!}
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
                        <h4 class="panel-title">编辑角色</h4>
                    </div>

                    <form class="form-horizontal form-bordered"
                          action="{{ route('admin.role.update',['id'=>$role->id]) }}" method="POST">

                        <div class="panel-body panel-body-nopadding">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">角色标识 <span class="asterisk">*</span></label>

                                <div class="col-sm-6">
                                    <input type="text" data-toggle="tooltip" name="name"
                                           data-trigger="hover" class="form-control tooltips"
                                           data-original-title="不可重复" value="{{ $role->name }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">显示名称</label>

                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="display_name"
                                           value="{{ $role->display_name }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">说明</label>

                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="description"
                                           value="{{ $role->description }}">
                                </div>
                            </div>

                            <input type="hidden" name="_method" value="PUT">
                            {{ csrf_field() }}
                        </div><!-- panel-body -->

                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-sm-6 col-sm-offset-3">
                                    <button class="btn btn-primary">保存</button>
                                    &nbsp;
                                    <button class="btn btn-default">取消</button>
                                </div>
                            </div>
                        </div><!-- panel-footer -->

                    </form>
                </div>

            </div><!-- col-sm-9 -->

        </div><!-- row -->

    </div>
@endsection
