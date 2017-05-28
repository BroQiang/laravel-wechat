@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>{{ $poster->name }} 详细信息</h3> 
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    海报内容
                    <a class="btn btn-xs btn-primary pull-right" href="{{ asset("backed/poster/{$poster->id}/edit") }}">
                        <i class="glyphicon glyphicon-edit"></i> 修改
                    </a>
                </div>
                <div class="panel-body">
                    此处是海报的内容描述，主要是一些消息提示，限制条件等
                </div>
                <ul class="list-group">
                    <li class="list-group-item">
                        活动名称： <code>{{ $poster->name }}</code>
                    </li>
                    <li class="list-group-item">
                        获取海报发送消息： 
                        <hr>
                        <p>
                            {!! nl2br($poster->get_message) !!}
                        </p>
                    </li>
                    <li class="list-group-item">
                        发送二维码被扫描的消息： 
                        <hr>
                        <p>
                            {!! nl2br($poster->subscribe_message) !!}
                        </p>
                    </li>
                    <li class="list-group-item">
                        达成次数的消息： 
                        <hr>
                        <p>
                            {!! nl2br($poster->success_message) !!}
                        </p>
                    </li>
                    <li class="list-group-item">
                        活动结束的消息： 
                        <hr>
                        <p>
                            {!! nl2br($poster->end_message) !!}
                        </p>
                    </li>
                    <li class="list-group-item">
                        需要完成的数量： <code>{{ $poster->number }}
                    </li>
                    <li class="list-group-item">
                        完成后是否继续发送达成次数的消息： <code>{{ $poster->get_message ? '是' : '否' }}</code>
                    </li>
                    <li class="list-group-item">
                        海报图片url地址： <code>{{ $poster->img_url }}</code>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    海报图片属性
                    <a class="btn btn-xs btn-primary pull-right" href="{{ asset("backed/poster/{$poster->id}/setting") }}">
                        <i class="glyphicon glyphicon-edit"></i> 修改
                    </a>
                </div>
                <div class="panel-body">
                    此处是海报图片的属性，如宽高等，此处的参数用于海报生成
                </div>
                <ul class="list-group">
                    <li class="list-group-item">
                        头像的宽和高： <code>{{ $poster->avatar_size }}</code>
                        <p><small>因为微信头像是正方形的，所以宽和高用一个长度</small></p>
                    </li>
                    <li class="list-group-item">
                        头像距离左上角的宽度： <code>{{ $poster->avatar_width }}</code>
                    </li>
                    <li class="list-group-item">
                        头像距离左上角的高度： <code>{{ $poster->avatar_height }}</code>
                    </li>
                    <li class="list-group-item">
                        昵称长度： <code>{{ $poster->nickname_font_width }}</code>
                    </li>
                    <li class="list-group-item">
                        昵称高度： <code>{{ $poster->nickname_font_height }}</code>
                        <p><small>昵称的长度和高度生成昵称背景框的大小</small></p>
                    </li>
                    <li class="list-group-item">
                        昵称字体大小： <code>{{ $poster->nickname_font_size }}</code>
                        <p><small>因为微信头像是正方形的，所以宽和高用一个长度</small></p>
                    </li>
                    <li class="list-group-item">
                        昵称文字距离上边框的高度： <code>{{ $poster->nickname_font_top }}</code>
                        <p><small>因为微信头像是正方形的，所以宽和高用一个长度</small></p>
                    </li>
                    <li class="list-group-item">
                        昵称字体颜色： <code>{{ $poster->nickname_color }}</code>
                        <p><small>因为微信头像是正方形的，所以宽和高用一个长度</small></p>
                    </li>
                    <li class="list-group-item">
                        昵称背景颜色： <code>{{ $poster->nickname_backgroup_color }}</code>
                        <p><small>因为微信头像是正方形的，所以宽和高用一个长度</small></p>
                    </li>
                    <li class="list-group-item">
                        昵称距离左上角的宽度： <code>{{ $poster->nickname_width }}</code>
                        <p><small>因为微信头像是正方形的，所以宽和高用一个长度</small></p>
                    </li>
                    <li class="list-group-item">
                        昵称距离左上角的高度： <code>{{ $poster->nickname_height }}</code>
                        <p><small>因为微信头像是正方形的，所以宽和高用一个长度</small></p>
                    </li>
                    <li class="list-group-item">
                        二维码的宽和高： <code>{{ $poster->qrcode_size }}</code>
                        <p><small>因为微信头像是正方形的，所以宽和高用一个长度</small></p>
                    </li>
                    <li class="list-group-item">
                        二维码距离左上角的宽度： <code>{{ $poster->qrcode_width }}</code>
                        <p><small>因为微信头像是正方形的，所以宽和高用一个长度</small></p>
                    </li>
                    <li class="list-group-item">
                        二维码距离左上角的高度： <code>{{ $poster->qrcode_height }}</code>
                        <p><small>因为微信头像是正方形的，所以宽和高用一个长度</small></p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
