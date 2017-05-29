@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>
                        欢迎使用 {{ config('app.name') }} 后台
                    </h3>
                </div>

                <div class="panel-body">
                    <h4>系统说明</h4>
                    <ul>
                        <li>现在的功能比较简单，会根据需求再完善</li>
                        <li>使用前修改smtp邮箱，否则一些需要发送邮件的地方会出现问题</li>
                        <li>可以修改配置文件中的NAME，系统的名字会对应改变</li>
                        <li>可以修改默认的管理员用户邮箱及名字，密码默认<code>123@123</code>，请自行修改</li>
                    </ul>   
                    
                    <hr>

                    <h4>系统已实现功能</h4>
                    <ul>
                        <li>自定义菜单，只包括点击事件和跳转链接</li>
                        <li>海报推广活动</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
