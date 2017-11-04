<nav class="dh">
    <h3>
        <span class="sx"><span class="zy"><a style="text-decoration: none;" href="/">Zyan</a></span></span>
        <span class="ht">@yield('title1', '智眼首页')</span>
		@if (Auth::user()->check())
        <div class="drop dropdown pull-right" style="margin-right: 74px">
            <a id="dLabel" data-target="#" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="cursor:pointer;font-size:18px;text-decoration: none;color:#666">
            {{ Auth::user()->get()->username }}
            <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" aria-labelledby="dLabel">
                <li><a href="{{ route('users.show', Auth::user()->get()->id) }}">个人中心</a></li>
                <li class="divider"></li>
                <li>
                <a id="logout" href="#">
                    <form action="{{ route('logout') }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button class="btn btn-block btn-danger" type="submit" name="button">退出</button>
                    </form>
                </a>
                </li>
            </ul>
        </div>
    	@elseif (Auth::manager()->check())
        <div class="drop dropdown pull-right" style="margin-right: 74px">
            <a id="dLabel" data-target="#" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="cursor:pointer;font-size:18px;text-decoration: none;color:#666">
            {{ Auth::manager()->get()->mana_name }}
            <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" aria-labelledby="dLabel">
                <li><a href="{{ route('manager.show', Auth::manager()->get()->id) }}">管理中心</a></li>
                <li class="divider"></li>
                <li>
                <a id="logout" href="#">
                    <form action="{{ route('logout') }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button class="btn btn-block btn-danger" type="submit" name="button">退出</button>
                    </form>
                </a>
                </li>
            </ul>
        </div>
    	@elseif (Auth::company()->check())
        <div class="drop dropdown pull-right" style="margin-right: 74px">
            <a id="dLabel" data-target="#" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="cursor:pointer;font-size:18px;text-decoration: none;color:#666">
            {{ Auth::company()->get()->company_name }}
            <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" aria-labelledby="dLabel">
                <li><a href="{{ route('company.show', Auth::company()->get()->id) }}">管理中心</a></li>
                <li class="divider"></li>
                <li>
                <a id="logout" href="#">
                    <form action="{{ route('logout') }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button class="btn btn-block btn-danger" type="submit" name="button">退出</button>
                    </form>
                </a>
                </li>
            </ul>
        </div>
    	@else
            <div class="drop pull-right" style="margin-right: 74px; */">
            <a href="{{ route('login') }}" style="cursor:pointer;font-size:18px;text-decoration: none;color:#666">登录</a>
    		</div>
        @endif
    </h3>
</nav>