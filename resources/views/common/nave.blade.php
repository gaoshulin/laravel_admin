<header class="layui-bg-cyan">
    <nav class="layui-container">
        <div class="layui-row">
            <div class="layui-col-md2 logo">
                <a href="{{ url('index/index') }}">
                    <img src="{{ asset('static/images/logo.png') }}">
                </a>
            </div>
            <div class="layui-col-md8 layui-hide-xs">
                <ul class="layui-nav layui-bg-cyan">
                    <li class="layui-nav-item @yield('layui-1')">
                        <a href="{{ url('index/index') }}">首页</a>
                    </li>
                    <li class="layui-nav-item @yield('layui-2')">
                        <a href="{{ url('php/index') }}">PHP</a>
                    </li>
                    <li class="layui-nav-item @yield('layui-3')">
                        <a href="{{ url('web/index') }}">WEB</a>
                    </li>
                    <li class="layui-nav-item @yield('layui-4')">
                        <a href="{{ url('mysql/index') }}">MySQL</a>
                    </li>
                    <li class="layui-nav-item @yield('layui-5')">
                        <a href="{{ url('linux/index') }}">Linux</a>
                    </li>
                    <li class="layui-nav-item @yield('layui-6')">
                        <a href="{{url('information/index')}}">杂项</a>
                    </li>
                </ul>
            </div>
            <div class="layui-col-md2 layui-hide-xs userinfoBox">
                <ul class="layui-nav layui-bg-cyan">
                    {{--<li class="layui-nav-item">--}}
                    {{--<a href="javascript:;"><i class="layui-icon layui-icon-search search"></i></a>--}}
                    {{--</li>--}}
                    {{--<li class="layui-nav-item" lay-unselect="">--}}
                    {{--<a href="javascript:;">--}}
                    {{--<img src="{{asset('static/images/later.jpg')}}" class="layui-nav-img">--}}
                    {{--Later--}}
                    {{--</a>--}}
                    {{--<dl class="layui-nav-child">--}}
                    {{--<dd><a href="javascript:;">修改信息</a></dd>--}}
                    {{--<dd><a href="javascript:;">安全管理</a></dd>--}}
                    {{--<dd><a href="javascript:;">退了</a></dd>--}}
                    {{--</dl>--}}
                    {{--</li>--}}
                </ul>
            </div>
        </div>
    </nav>
</header>