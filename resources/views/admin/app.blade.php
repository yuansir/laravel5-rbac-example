<!doctype html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>系统管理后台</title>
    <meta name="description" content="这是一个 index 页面">
    <meta name="keywords" content="index">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <meta name="apple-mobile-web-app-title" content="Amaze UI" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    @section('stylesheets')
    <link rel="icon" type="image/png" href="{{ asset('i/favicon.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('i/app-icon72x72@2x.png') }}">
    <link rel="stylesheet" href="{{ asset('css/amazeui.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    @show
</head>
<body>
<!--[if lte IE 9]>
<p class="browsehappy">你正在使用<strong>过时</strong>的浏览器，Amaze UI 暂不支持。 请 <a href="http://browsehappy.com/" target="_blank">升级浏览器</a>
    以获得更好的体验！</p>
<![endif]-->

<header class="am-topbar admin-header">
    <div class="am-topbar-brand">
        <strong>系统管理后台</strong> <small></small>
    </div>

    <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only" data-am-collapse="{target: '#topbar-collapse'}"><span class="am-sr-only">导航切换</span> <span class="am-icon-bars"></span></button>

    <div class="am-collapse am-topbar-collapse" id="topbar-collapse">

        <ul class="am-nav am-nav-pills am-topbar-nav am-topbar-right admin-header-list">
            <li><a href="javascript:;"><span class="am-icon-envelope-o"></span> 收件箱 <span class="am-badge am-badge-warning">5</span></a></li>
            <li class="am-dropdown" data-am-dropdown>
                <a class="am-dropdown-toggle" data-am-dropdown-toggle href="javascript:;">
                    <span class="am-icon-users"></span> 管理员 <span class="am-icon-caret-down"></span>
                </a>
                <ul class="am-dropdown-content">
                    <li><a href="#"><span class="am-icon-user"></span> 资料</a></li>
                    <li><a href="#"><span class="am-icon-cog"></span> 设置</a></li>
                    <li><a href="{{ url('admin/auth/logout') }}"><span class="am-icon-power-off"></span> 退出</a></li>
                </ul>
            </li>
            <li class="am-hide-sm-only"><a href="javascript:;" id="admin-fullscreen"><span class="am-icon-arrows-alt"></span> <span class="admin-fullText">开启全屏</span></a></li>
        </ul>
    </div>
</header>

<div class="am-cf admin-main">
    <!-- sidebar start -->
    <div class="admin-sidebar am-offcanvas" id="admin-offcanvas">
        <div class="am-offcanvas-bar admin-offcanvas-bar">
            <ul class="am-list admin-sidebar-list">
                <li><a href="{{ url('admin') }}"><span class="am-icon-home"></span> 首页</a></li>
                <li class="admin-parent">
                    <a class="am-cf" data-am-collapse="{target: '#collapse-nav'}"><span class="am-icon-file"></span> 系统管理 <span class="am-icon-angle-right am-fr am-margin-right"></span></a>
                    <ul class="am-list am-collapse admin-sidebar-sub am-in" id="collapse-nav">
                        <li><a href="{{ route('admin.rbac.role.index') }}" class="am-cf"><span class="am-icon-check"></span> 权限设置<span class="am-icon-star am-fr am-margin-right admin-icon-yellow"></span></a></li>
                    </ul>
                </li>
                <li><a href="{{ route('admin.blog.index') }}"><span class="am-icon-table"></span> 博客</a></li>
                <li><a href="{{ url('admin/auth/logout') }}"><span class="am-icon-sign-out"></span> 注销</a></li>
            </ul>

            <div class="am-panel am-panel-default admin-sidebar-panel">
                <div class="am-panel-bd">
                    <p><span class="am-icon-bookmark"></span> Hello</p>
                    <p>Laravel5 RBAC Example</p>
                </div>
            </div>

        </div>
    </div>
    <!-- sidebar end -->

    <!-- content start -->
    <div class="admin-content">

        @yield('content')

    </div>
    <!-- content end -->

</div>

<a class="am-icon-btn am-icon-th-list am-show-sm-only admin-menu" data-am-offcanvas="{target: '#admin-offcanvas'}"></a>

<footer>
    <hr>
    <p class="am-padding-left">© 2014 AllMobilize, Inc. Licensed under MIT license.</p>
</footer>

@section('javascripts')
<!--[if lt IE 9]>
<script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
<script src="{{ asset('js/polyfill/rem.min.js') }}"></script>
<script src="{{ asset('/js/polyfill/respond.min.js') }}"></script>
<script src="{{ asset('js/amazeui.legacy.js') }}"></script>
<![endif]-->

<!--[if (gte IE 9)|!(IE)]><!-->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/amazeui.min.js') }}"></script>
<!--<![endif]-->
<script src="{{ asset('js/app.js') }}"></script>
@show
</body>
</html>
