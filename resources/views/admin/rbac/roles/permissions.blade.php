@extends('layouts.admin-app')

@section('content')
    <style>
        .sub-permissions-ul li {
            float: left;

        }
    </style>
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        {!! Breadcrumbs::render('admin-role-permission') !!}
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
                        <h4 class="panel-title">编辑[{{ $role->display_name }}]权限</h4>
                    </div>

                    <form action="{{ route('admin.role.permissions',['id'=>$role->id]) }}" method="post"
                          id="role-permissions-form">
                        <div class="panel-body panel-body-nopadding">
                            @foreach($permissions as $permission)
                                <div class="top-permission col-md-12">
                                    <a href="javascript:;" class="display-sub-permission-toggle">
                                        <span class="glyphicon glyphicon-minus"></span>
                                    </a>
                                    @if(in_array($permission['id'],array_keys($rolePermissions)))
                                        <input type="checkbox" name="permissions[]" value="{{ $permission['id'] }}"
                                               class="top-permission-checkbox" checked/>
                                    @else
                                        <input type="checkbox" name="permissions[]" value="{{ $permission['id'] }}"
                                               class="top-permission-checkbox"/>
                                    @endif
                                    <label><h5>&nbsp;&nbsp;{{ $permission['display_name'] }}</h5></label>
                                </div>
                                @if(count($permission['subPermission']))
                                    <div class="sub-permissions col-md-11 col-md-offset-1">
                                        @foreach($permission['subPermission'] as $sub)
                                            <div class="col-sm-3">
                                                @if($sub['is_menu'])
                                                    <label><input type="checkbox" name="permissions[]"
                                                                  value="{{ $sub['id'] }}"
                                                                  class="sub-permission-checkbox" {{ in_array($sub['id'],array_keys($rolePermissions)) ? 'checked':'' }}/>&nbsp;&nbsp;<span
                                                                class="fa fa-bars"></span>{{ $sub['display_name'] }}
                                                    </label>
                                                @else
                                                    <label><input type="checkbox" name="permissions[]"
                                                                  value="{{ $sub['id'] }}"
                                                                  class="sub-permission-checkbox" {{ in_array($sub['id'],array_keys($rolePermissions)) ? 'checked':'' }}/>&nbsp;&nbsp;{{ $sub['display_name'] }}
                                                    </label>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            @endforeach
                            {{ csrf_field() }}
                        </div>
                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-sm-6 col-sm-offset-3">
                                    <button class="btn btn-primary" id="save-role-permissions">保存</button>
                                </div>
                            </div>
                        </div><!-- panel-footer -->

                    </form>

                </div>

            </div><!-- col-sm-9 -->

        </div><!-- row -->

    </div>

@endsection

@section('javascript')
    @parent
    <script src="{{ asset('js/ajax.js') }}"></script>
    <script>
        $(".display-sub-permission-toggle").toggle(function () {
            $(this).children('span').removeClass('glyphicon-minus').addClass('glyphicon-plus')
                    .parents('.top-permission').next('.sub-permissions').hide();
        }, function () {
            $(this).children('span').removeClass('glyphicon-plus').addClass('glyphicon-minus')
                    .parents('.top-permission').next('.sub-permissions').show();
        });

        $(".top-permission-checkbox").change(function () {
            $(this).parents('.top-permission').next('.sub-permissions').find('input').prop('checked', $(this).prop('checked'));
        });

        $(".sub-permission-checkbox").change(function () {
            if ($(this).prop('checked')) {
                $(this).parents('.sub-permissions').prev('.top-permission').find('.top-permission-checkbox').prop('checked', true);
            }
        });
    </script>
    <script type="text/javascript">
        $("#save-role-permissions").click(function (e) {
            e.preventDefault();
            Rbac.ajax.request({
                href: $("#role-permissions-form").attr('action'),
                data: $("#role-permissions-form").serialize(),
                successTitle: '角色权限保存成功'
            });
        });
    </script>
@endsection