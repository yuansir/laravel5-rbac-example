@extends('admin/app')

@section('content')
<div class="am-cf am-padding">
    <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">首页</strong> / <small>博客</small></div>
</div>

<div class="am-tabs am-margin" data-am-tabs>
    <ul class="am-nav am-nav-tabs">
        <li><a href="{{ route('admin.blog.index') }}">列表</a></li>
        <li class="am-active"><a href="{{ route('admin.blog.create') }}">创建</a></li>
    </ul>

    <div class="am-tabs-bd">
        <div class="am-tab-panel am-fade am-in am-active" id="tab1">

            @include('admin.alert')

            <form class="am-form" action="{{ route('admin.blog.store') }}" method="POST">
                <div class="am-g am-margin-top">
                    <div class="am-u-sm-4 am-u-md-2 am-text-right">
                        标题
                    </div>
                    <div class="am-u-sm-8 am-u-md-4">
                        <input type="text" class="am-input-sm" name="title" value="{{ old('title') }}">
                    </div>
                    <div class="am-hide-sm-only am-u-md-6">*必填</div>
                </div>

                <div class="am-g am-margin-top">
                    <div class="am-u-sm-8 am-u-md-4 am-u-sm-centered">
                        <button type="button" class="am-btn am-btn-primary am-btn-xs am-blog-save">提交保存</button>
                    </div>
                </div>

            </form>
        </div>

    </div>
</div>

@stop



@section('javascripts')
@parent
<script type="text/javascript">
    $(".am-blog-save").click(function () {
        var href = $("form").attr("action");
        $.ajax({
            url: href, type:'POST',
            success: function (data) {
                if(data.status == 1){
                    alert('OK');
                }else{
                    alert(data.message);
                }
            }
        })
    })

</script>
@stop