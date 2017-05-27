@extends('layouts.app') 

@section('content')
<div class="container">
    
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>添加{{ isset($wxMenu) ?  $wxMenu->name . '子' : '一级'}}菜单</h4>
                </div>
                <div class="panel-body">
                    <form action="{{ isset($wxMenu) ? asset("backed/wxmenu/create/{$wxMenu->id}") : asset('backed/wxmenu/create') }}" method="POST">
                        {{ csrf_field() }}

                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="control-label">菜单名称：</label>
                            <input class="form-control" type="text" name="name" value="{{ old('name') }}">
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('type') ? ' has-error' : '' }}">
                            <label class="control-label">菜单类型：</label>
                            <div>
                                <div class="checkbox-inline">
                                    <label>
                                        <input type="radio" name="type" value="click" {{ old('type') == 'click' ? 'checked' : '' }}>
                                        点击事件
                                    </label>
                                </div>
                                <div class="checkbox-inline">
                                    <label>
                                        <input type="radio" name="type" value="view" {{ old('type') == 'view' ? 'checked' : '' }}> 
                                        跳转链接
                                    </label>
                                </div>
                            </div>
                            @if ($errors->has('type'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('type') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('action') ? ' has-error' : '' }}">
                            <label class="control-label">菜单动作：</label>
                            <input class="form-control" type="text" name="action" value="{{ old('action') }}" placeholder="点击事件填写key，跳转链接填写url">
                            @if($errors->has('action'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('action') }}</strong>
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
