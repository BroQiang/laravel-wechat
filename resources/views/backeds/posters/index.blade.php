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
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>活动名称</th>
                                    <th>Key</th>
                                    <th>是否上传图片</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($posters as $poster)
                                    <tr>
                                        <td>{{ $poster->id }}</td>
                                        <td>{{ $poster->name }}</td>
                                        <td><code>activity_push_poster_{{ $poster->id }}</code></td>
                                        <td>
                                            @if(empty($poster->img_url))
                                                <span class="label label-danger">未上传海报</span>
                                            @else
                                                <a class="btn btn-info btn-sm" href="{{ asset("backed/poster/{$poster->id}/preview") }}" target="_blank">
                                                    <i class="glyphicon glyphicon-picture"></i> 海报图片预览
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            <a class="btn btn-success btn-sm" href="{{ asset("backed/poster/{$poster->id}/upload") }}">
                                                <i class="glyphicon glyphicon-upload"></i> 上传海报
                                            </a>
                                            <a class="btn btn-primary btn-sm">
                                                <i class="glyphicon glyphicon-edit"></i> 修改
                                            </a>
                                            <a class="btn btn-danger btn-sm">
                                                <i class="glyphicon glyphicon-trash"></i> 删除
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
