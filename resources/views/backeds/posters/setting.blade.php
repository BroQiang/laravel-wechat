@extends('layouts.app')

@section('stylesheet')
<link rel="stylesheet" href="{{ mix('css/jquery.datetimepicker.css') }}">
@endsection

@section('content')
<div class="container">
    
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>{{ $poster->name }} 图片设置</h4>
                </div>
                <div class="panel-body">
                    <form action="{{ asset("backed/poster/{$poster->id}/setting") }}" method="POST">
                        {{ csrf_field() }}

                        <div class="form-group {{ $errors->has('avatar_size') ? ' has-error' : '' }}">
                            <label class="control-label">头像的宽和高：</label>
                            <input class="form-control" type="number" name="avatar_size" value="{{ $poster->avatar_size or old('avatar_size') }}">
                            @if ($errors->has('avatar_size'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('avatar_size') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('avatar_width') ? ' has-error' : '' }}">
                            <label class="control-label">头像距离左上角的宽度：</label>
                            <input class="form-control" type="number" name="avatar_width" value="{{ $poster->avatar_width or old('avatar_width') }}">
                            @if ($errors->has('avatar_width'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('avatar_width') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('avatar_height') ? ' has-error' : '' }}">
                            <label class="control-label">头像距离左上角的高度： </label>
                            <input class="form-control" type="number" name="avatar_height" value="{{ $poster->avatar_height or old('avatar_height') }}">
                            @if ($errors->has('avatar_height'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('avatar_height') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('nickname_font_width') ? ' has-error' : '' }}">
                            <label class="control-label">昵称长度： </label>
                            <input class="form-control" type="number" name="nickname_font_width" value="{{ $poster->nickname_font_width or old('nickname_font_width') }}">
                            @if ($errors->has('nickname_font_width'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('nickname_font_width') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('nickname_font_height') ? ' has-error' : '' }}">
                            <label class="control-label">昵称高度： </label>
                            <input class="form-control" type="number" name="nickname_font_height" value="{{ $poster->nickname_font_height or old('nickname_font_height') }}">
                            @if ($errors->has('nickname_font_height'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('nickname_font_height') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('nickname_font_size') ? ' has-error' : '' }}">
                            <label class="control-label">昵称字体大小： </label>
                            <input class="form-control" type="number" name="nickname_font_size" value="{{ $poster->nickname_font_size or old('nickname_font_size') }}">
                            @if ($errors->has('nickname_font_size'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('nickname_font_size') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('nickname_font_top') ? ' has-error' : '' }}">
                            <label class="control-label">昵称文字距离上边框的高度： </label>
                            <input class="form-control" type="number" name="nickname_font_top" value="{{ $poster->nickname_font_top or old('nickname_font_top') }}">
                            @if ($errors->has('nickname_font_top'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('nickname_font_top') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('nickname_color') ? ' has-error' : '' }}">
                            <label class="control-label">昵称字体颜色： </label>
                            <input class="form-control" type="text" name="nickname_color" value="{{ $poster->nickname_color or old('nickname_color') }}">
                            @if ($errors->has('nickname_color'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('nickname_color') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('nickname_backgroup_color') ? ' has-error' : '' }}">
                            <label class="control-label">昵称背景颜色： </label>
                            <input class="form-control" type="text" name="nickname_backgroup_color" value="{{ $poster->nickname_backgroup_color or old('nickname_backgroup_color') }}">
                            @if ($errors->has('nickname_backgroup_color'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('nickname_backgroup_color') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('nickname_width') ? ' has-error' : '' }}">
                            <label class="control-label">昵称距离左上角的宽度： </label>
                            <input class="form-control" type="number" name="nickname_width" value="{{ $poster->nickname_width or old('nickname_width') }}">
                            @if ($errors->has('nickname_width'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('nickname_width') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('nickname_height') ? ' has-error' : '' }}">
                            <label class="control-label">昵称距离左上角的高度： </label>
                            <input class="form-control" type="number" name="nickname_height" value="{{ $poster->nickname_height or old('nickname_height') }}">
                            @if ($errors->has('nickname_height'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('nickname_height') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('qrcode_size') ? ' has-error' : '' }}">
                            <label class="control-label">二维码的宽和高： </label>
                            <input class="form-control" type="number" name="qrcode_size" value="{{ $poster->qrcode_size or old('qrcode_size') }}">
                            @if ($errors->has('qrcode_size'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('qrcode_size') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('qrcode_width') ? ' has-error' : '' }}">
                            <label class="control-label">二维码距离左上角的宽度： </label>
                            <input class="form-control" type="number" name="qrcode_width" value="{{ $poster->qrcode_width or old('qrcode_width') }}">
                            @if ($errors->has('qrcode_width'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('qrcode_width') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('qrcode_height') ? ' has-error' : '' }}">
                            <label class="control-label">二维码距离左上角的高度： </label>
                            <input class="form-control" type="number" name="qrcode_height" value="{{ $poster->qrcode_height or old('qrcode_height') }}">
                            @if ($errors->has('qrcode_height'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('qrcode_height') }}</strong>
                                </span>
                            @endif
                        </div>
                        
                        <div class="form-group">
                            <button class="btn btn-primary btn-lg btn-block">
                                <i class="glyphicon glyphicon-saved mr-2"></i>保存
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
