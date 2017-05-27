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
</div>
@endsection
