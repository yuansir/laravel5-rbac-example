@extends('admin/app')

@section('content')
<div class="am-cf am-padding">
    <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">首页</strong> / <small>博客</small></div>
</div>

<div class="am-tabs am-margin" data-am-tabs>
    <ul class="am-nav am-nav-tabs">
        <li class="am-active"><a href="{{ route('admin.blog.index') }}">博客列表</a></li>
    </ul>

    <div class="am-tabs-bd">
        <div class="am-tab-panel am-fade am-in am-active" id="tab1">
            <div class="am-g">
                <div class="am-u-sm-12 am-u-md-6">
                    <div class="am-btn-toolbar">
                        <div class="am-btn-group am-btn-group-xs">
                            <a type="button" href="{{route('admin.blog.create')}}" class="am-btn am-btn-default"><span class="am-icon-plus"></span> 新增</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="am-g">
                <div class="am-u-sm-12">
                   这是博客页面
                </div>

            </div>

        </div>

    </div>
</div>

@stop


