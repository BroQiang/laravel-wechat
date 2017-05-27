@extends('layouts.app')

@section('content')
<div class="container">
    <h3>自定义菜单</h3>
    @if(session()->has('error'))
        <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
    @endif
    @if(session()->has('success'))
        <div class="alert alert-success" role="alert">{{ session('success') }}</div>
    @endif
    <hr>
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    主菜单
                    <a class="btn btn-xs btn-success pull-right mr-5" href="{{ asset('backed/wxmenu/create') }}">
                        <i class="glyphicon glyphicon-plus  mr-2"></i>添加
                    </a>
                    <a class="btn btn-xs btn-primary pull-right mr-5" href="{{ asset('backed/wxmenu/publish') }}">
                        <i class="glyphicon glyphicon-globe mr-2"></i>发布到微信
                    </a>
                </div>
                <div class="panel-body">
                    <div class="list-group">
                        @foreach($wxMenus as $menu)
                            <a href="{{ asset('backed/wxmenu') }}?wxMenu={{ $menu->id }}" class="list-group-item {{ $menu->id == $wxMenu->id ? 'active' : '' }}">
                                <p>{{ $menu->name }} <span class="label label-default">{{ $menu->type == 'click' ? '点击事件' : '跳转链接' }}</span></p>
                                <p>
                                    @if($menu->type == 'click')
                                        Key : <code>{{ $menu->action }}</code>
                                    @else
                                        Url : <code>{{ $menu->action }}</code>
                                    @endif
                                </p>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @if(!empty($wxMenu))
            @include('backeds.wx_menus.subMenu')
        @endif

    </div>
    @include('backeds.wx_menus.helps')
</div>
@endsection
