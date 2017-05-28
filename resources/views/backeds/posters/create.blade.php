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
                    <h4>{{ isset($poster) ? '修改' . $poster->name : '创建新的'}}</h4>
                </div>
                <div class="panel-body">
                    <form action="{{ asset('backed/poster') }}{{ isset($poster) ? '/' . $poster->id : '' }}" method="POST">
                        {{ csrf_field() }}

                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="control-label">活动名称：</label>
                            <input class="form-control" type="text" name="name" value="{{ $poster->name or old('name') }}" placeholder="用来友好显示的名称">
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('get_message') ? ' has-error' : '' }}">
                            <label class="control-label">获取海报发送消息：</label>
                            <textarea class="form-control" rows="3" name="get_message" placeholder="用户获取到海报时候发送的消息">{{ $poster->get_message or old('get_message') }}</textarea>
                            @if ($errors->has('get_message'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('get_message') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('subscribe_message') ? ' has-error' : '' }}">
                            <label class="control-label">发送二维码被扫描的消息：</label>
                            <textarea class="form-control" rows="3" name="subscribe_message" placeholder="如：您的好友{!-nickname!}已经为你助力一票"
                                >{{ $poster->subscribe_message or old('subscribe_message') }}</textarea>
                            @if ($errors->has('subscribe_message'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('subscribe_message') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('success_message') ? ' has-error' : '' }}">
                            <label class="control-label">达成次数的消息：</label>
                            <textarea class="form-control" rows="3" name="success_message" placeholder="如：恭喜您完成XXX，网盘地址是：http://xxx.com"
                                >{{ $poster->success_message or old('success_message') }}</textarea>
                            @if ($errors->has('success_message'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('success_message') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('number') ? ' has-error' : '' }}">
                            <label class="control-label">需要完成的数量：</label>
                            <input class="form-control" type="text" name="number" value="{{ $poster->number or old('number') }}" 
                                placeholder="需要被扫码几次达成目标,填写纯数字，如：3">
                            @if ($errors->has('number'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('number') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('is_send') ? ' has-error' : '' }}">
                            <label class="control-label">完成后是否继续发送达成次数的消息：</label>
                            <div>
                                <div class="checkbox-inline">
                                    <label>
                                        <input type="radio" name="is_send" value="1" {{ (isset($poster) ? $poster->is_send :  old('is_send')) == 1 ? 'checked' : '' }}>
                                        是
                                    </label>
                                </div>
                                <div class="checkbox-inline">
                                    <label>
                                        <input type="radio" name="is_send" value="0" {{ (isset($poster) ? $poster->is_send :  old('is_send')) == 0 ? 'checked' : '' }}> 
                                        否
                                    </label>
                                </div>
                            </div>
                            @if ($errors->has('is_send'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('is_send') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('end_message') ? ' has-error' : '' }}">
                            <label class="control-label">活动结束的消息：</label>
                            <textarea class="form-control" rows="3" name="end_message" placeholder="如：恭喜您完成XXX，网盘地址是：http://xxx.com"
                                >{{ $poster->end_message or old('end_message') }}</textarea>
                            @if ($errors->has('end_message'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('end_message') }}</strong>
                                </span>
                            @endif
                        </div>
                        
                        <div class="form-group {{ $errors->has('end_time') ? ' has-error' : '' }}">
                            <label class="control-label">活动结束时间：</label>
                            <input class="form-control datetimepicker" id="datetimepicker" type="text" name="end_time" 
                                value="{{ $poster->end_time or old('end_time') }}" >
                            @if ($errors->has('end_time'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('end_time') }}</strong>
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
