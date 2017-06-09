@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">微信海报活动</div>

                <div class="panel-body">
                    <a class="btn btn-md btn-success" href="{{ asset('backed/poster/create') }}">
                        <i class="glyphicon glyphicon-plus mr-2"></i>创建
                    </a>
                </div>
            </div>
        </div>
    </div>
    @foreach($posters as $poster)
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ $poster->name }}
                    </div>
                    <div class="panel-body">
                        <p>添加完海报不要忘记上传海报图片，每次上传新的海报都会将之前缓存的数据清楚</p>
                        <p>不要手动清除数据库的缓存和微信的缓存，如果必须要手动清除，请保证两边对应的数据全部清除</p>
                    </div>
                    <ul class="list-group">
                        <li class="list-group-item">
                            Key ： <code>activity____push____poster____{{ $poster->id }}</code>
                        </li>
                        <li class="list-group-item">
                            @if(empty($poster->img_url))
                                <span class="label label-danger">未上传海报</span>
                            @else
                                <a class="btn btn-info btn-sm" href="{{ asset("backed/poster/{$poster->id}/preview") }}" target="_blank">
                                    <i class="glyphicon glyphicon-picture"></i> 海报图片预览
                                </a>
                            @endif
                        </li>
                        <li class="list-group-item">
                            <a class="btn btn-success btn-sm" href="{{ asset("backed/poster/{$poster->id}/upload") }}">
                                <i class="glyphicon glyphicon-upload"></i> 上传海报
                            </a>
                            <a class="btn btn-primary btn-sm" href="{{ asset("backed/poster/{$poster->id}") }}">
                                <i class="glyphicon glyphicon-fullscreen"></i> 详细
                            </a>
                            {{-- <a class="btn btn-danger btn-sm" onclick="alert('这个逻辑不好处理，没确定好，暂时还没有做');">
                                <i class="glyphicon glyphicon-trash"></i> 删除
                            </a> --}}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
