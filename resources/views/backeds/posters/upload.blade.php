@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">上传 《{{ $poster->name }}》 活动的海报</div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <br>
                            @if(session()->has('error'))
                                <div class="alert alert-danger" role="alert">{!! session('error') !!}</div>
                            @endif
                            <form method="POST" action="{{ asset("backed/poster/{$poster->id}/upload") }}" enctype="multipart/form-data">
                                
                                {{ csrf_field() }}

                                <div class="form-group {{ $errors->has('img_url') ? ' has-error' : '' }}">
                                    <input class="form-control" id="datetimepicker" type="file" name="img_url" 
                                        value="{{ old('img_url') }}" >
                                    @if ($errors->has('img_url'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('img_url') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-success btn-block">确定上传</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>帮助</h3>
            </div>
            <div class="panel-body">
                
                <h4>首次上传</h4>
                <ul>
                    <li>海报图片上传后可以在首页的列表中预览图片</li>
                    <li>可以在首页的列表进行图片合成参数的设置</li>
                    <li>通过参数的设置，可以对头像、昵称、二维码进行定位</li>
                </ul>

                <h4>再次上传</h4>
                <ul>
                    <li>因为合成图片处理的步骤较多，消耗的时间很长，并且微信也会限制素材的数量，用户首次获取海报后会将用户的海报缓存</li>
                    <li>再次上传海报的时候会将缓存清楚，包括：</li>
                        <ul>
                            <li>本地数据库的缓存</li>
                            <li>已经上传到微信的素材</li>
                        </ul>
                    <li>如果是启用过一段时间的活动，时间会很长，耐心等待（因为微信只允许一条一条删除）</li>
                </ul>
                
            </div>
        </div>
    </div>
</div>
</div>
@endsection
