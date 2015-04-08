<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Login Page | Amaze UI Example</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="alternate icon" type="image/png" href="{{ asset('i/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/amazeui.min.css') }}"/>
    <style>
        .header {
            text-align: center;
        }
        .header h1 {
            font-size: 200%;
            color: #333;
            margin-top: 30px;
        }
        .header p {
            font-size: 14px;
        }
    </style>
</head>
<body>
<div class="header">
    <div class="am-g">
        <h1>系统后台</h1>
        <p>Integrated Development Environment<br/>代码编辑，代码生成，界面设计，调试，编译</p>
    </div>
    <hr />
</div>
<div class="am-g">

    @if (count($errors) > 0)
    <div class="am-alert am-alert-warning am-u-lg-6 am-u-md-8 am-u-sm-centered am-u-lg-centered" data-am-alert >
        @foreach ($errors->all() as $error)
        <p>{{ $error }}</p>
        @endforeach
    </div>
    @endif

    <div class="am-u-lg-6 am-u-md-8 am-u-sm-centered">
        <form method="POST" class="am-form" action="{{ url('/admin/auth/login') }}">
            <label for="email">邮箱:</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}">
            <br>
            <label for="password">密码:</label>
            <input type="password" name="password" id="password" value="">
            <br>
            <label for="remember-me">
                <input id="remember-me" type="checkbox" name="remember">
                记住密码
            </label>
            <br />
            <div class="am-cf">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="submit" name="" value="登 录" class="am-btn am-btn-primary am-btn-sm am-fl">
<!--                <a class="am-btn am-btn-default am-btn-sm am-fr" href="{{ url('/password/email') }}">忘记密码 ^_^?</a>-->
            </div>
        </form>
        <hr>
        <p>© 2014 AllMobilize, Inc. Licensed under MIT license.</p>
    </div>
</div>
</body>
</html>