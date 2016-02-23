@extends('layouts.admin-app')

@section('content')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        {!! Breadcrumbs::render('admin-permission-index') !!}
    </div>

    <div class="contentpanel panel-email">

        <div class="row">

            @include('admin._partials.rbac-left-menu')

            <div class="col-sm-9 col-lg-10">

                <div class="panel panel-default">
                    <div class="panel-body">

                        <div class="pull-right">
                            <div class="btn-group mr10">
                                <a href="{{ route('admin.permission.create') }}" class="btn btn-white tooltips"
                                   data-toggle="tooltip" data-original-title="新增"><i
                                            class="glyphicon glyphicon-plus"></i></a>
                                <a class="btn btn-white tooltips deleteall" data-toggle="tooltip"
                                   data-original-title="删除" data-href="{{ route('admin.permission.destory.all') }}"><i
                                            class="glyphicon glyphicon-trash"></i></a>
                            </div>
                        </div><!-- pull-right -->

                        <h5 class="subtitle mb5">权限列表</h5>

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
                                    <th>显示名称</th>
                                    <th>路由</th>
                                    <th>图标</th>
                                    <th>说明</th>
                                    <th>是否菜单</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($permissions as $permission)
                                    <tr>
                                        <td>
                                            <div class="ckbox ckbox-default">
                                                <input type="checkbox" name="id" id="id-{{ $permission->id }}"
                                                       value="{{ $permission->id }}" class="selectall-item"/>
                                                <label for="id-{{ $permission->id }}"></label>
                                                <a href="javascript:;" class="show-sub-permissions"
                                                   data-id="{{ $permission['id'] }}"><span
                                                            class="glyphicon glyphicon-chevron-right"></span></a>
                                            </div>
                                        </td>
                                        <td><p class="text-info">{{ $permission->display_name }}</p></td>
                                        <td>{{ $permission->name }}</td>
                                        <td>{!! $permission->icon_html !!}</td>
                                        <td>{{ $permission->description }}</td>
                                        <td>{!! $permission->is_menu ? '<span class="label label-danger">是</span>':'<span class="label label-default">否</span>' !!}</td>
                                        <td>
                                            <a href="{{ route('admin.permission.edit',['id'=>$permission->id]) }}"
                                               class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> 编辑</a>
                                            <a class="btn btn-danger btn-sm permission-delete"
                                               data-href="{{ route('admin.permission.destroy',['id'=>$permission->id]) }}"><i
                                                        class="fa fa-trash-o"></i> 删除</a>
                                        </td>
                                    </tr>

                                    @if($permission->sub_permission->count())
                                        @foreach($permission->sub_permission as $sub)
                                            <tr class="hide parent-permission-{{ $permission->id }}">
                                                <td>
                                                    <div class="ckbox ckbox-default">
                                                        <input type="checkbox" name="id" id="id-{{ $sub->id }}"
                                                               value="{{ $sub->id }}" class="selectall-item"/>
                                                        <label for="id-{{ $sub->id }}"></label>
                                                    </div>
                                                </td>
                                                <td>|-- {{ $sub->display_name }}</td>
                                                <td>{{ $sub->name }}</td>
                                                <td>{!! $sub->icon_html !!}</td>
                                                <td>{{ $sub->description }}</td>
                                                <td>{!! $sub->is_menu ? '<span class="label label-danger">是</span>':'<span class="label label-default">否</span>' !!}</td>
                                                <td>
                                                    <a href="{{ route('admin.permission.edit',['id'=>$sub->id]) }}"
                                                       class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> 编辑</a>
                                                    <a class="btn btn-danger btn-sm permission-delete"
                                                       data-href="{{ route('admin.permission.destroy',['id'=>$sub->id]) }}"><i
                                                                class="fa fa-trash-o"></i> 删除</a>

                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div><!-- panel-body -->
                </div><!-- panel -->

            </div><!-- col-sm-9 -->

        </div><!-- row -->

    </div>
@endsection

@section('javascript')
    @parent
    <script src="{{ asset('js/ajax.js') }}"></script>
    <script>
        $(".show-sub-permissions").toggle(function () {
            var id = $(this).data('id'), subSelector = $('.parent-permission-' + id);
            $(this).children('.glyphicon').removeClass('glyphicon-chevron-right').addClass('glyphicon-chevron-down');
            subSelector.removeClass('hide');
        }, function () {
            var id = $(this).data('id'), subSelector = $('.parent-permission-' + id);
            $(this).children('.glyphicon').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-right');
            subSelector.addClass('hide');
        });

        $(".permission-delete").click(function () {
            Rbac.ajax.delete({
                confirmTitle: '确定删除该权限吗？如果该权限有下属权限将被一起删除！',
                href: $(this).data('href'),
                successTitle: '权限删除成功'
            });
        });

        $(".deleteall").click(function () {
            Rbac.ajax.deleteAll({
                confirmTitle: '确定删除选中的权限吗？如果该权限有下属权限将被一起删除！',
                href: $(this).data('href'),
                successTitle: '权限删除成功'
            });
        });
    </script>

@endsection
