<div class="col-md-6">
    <div class="panel panel-default">
        <div class="panel-heading">
            {{ $wxMenu->name }}
            <a class="btn btn-xs btn-success pull-right mr-5" href="{{ asset("backed/wxmenu/create/{$wxMenu->id}") }}">
                <i class="glyphicon glyphicon-plus mr-2"></i>
                子菜单
            </a>
            <a class="btn btn-xs btn-danger pull-right mr-5" href="{{ asset("backed/wxmenu/delete/{$wxMenu->id}") }}">
                <i class="glyphicon glyphicon-trash"></i> 删除
            </a>
            <a class="btn btn-xs btn-primary pull-right mr-5" href="{{ asset("backed/wxmenu/edit/{$wxMenu->id}") }}">
                <i class="glyphicon glyphicon-edit mr-2"></i> 修改
            </a>
        </div>
        <div class="panel-body">

            @if(count($wxMenu->wxSubMenu) > 0)
                @foreach($wxMenu->wxSubMenu as $subMenu)
                    <div>
                        <p>
                            {{ $subMenu->name }}
                            <span class="label label-default">{{ $subMenu->type == 'click' ? '点击事件' : '跳转链接' }} </span>
                            <a class="btn btn-xs btn-danger pull-right mr-5" href="{{ asset("backed/wxmenu/delete/{$wxMenu->id}/{$subMenu->id}") }}">
                                <i class="glyphicon glyphicon-trash"></i>
                                删除
                            </a>
                            <a class="btn btn-xs btn-primary pull-right mr-5" href="{{ asset("backed/wxmenu/edit/{$wxMenu->id}/{$subMenu->id}") }}">
                                <i class="glyphicon glyphicon-edit mr-2"></i>
                                修改
                            </a>
                        </p>
                        <p> 
                            @if($subMenu->type == 'click')
                                Key : <code>{{ $subMenu->action }}</code>
                            @else
                                Url : <code>{{ $subMenu->action }}</code>
                            @endif
                        </p>
                    </div>
                    <hr>
                @endforeach
            @endif
        </div>
    </div>
</div>
