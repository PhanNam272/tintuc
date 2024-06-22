<header class="header fixed-top clearfix">
    <!--logo start-->
    <div class="brand">
        <a href="index.html" class="logo">
            LOGO
        </a>
        <div class="sidebar-toggle-box">
            <div class="fa fa-bars"></div>
        </div>
    </div>
    <!--logo end-->
    
    <div class="top-nav clearfix">
        <!--search & user info start-->
        <ul class="nav pull-right top-menu">
            <!-- user login dropdown start-->
            <li class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" style="padding: 4px;">
                    <img alt="" src="{{Auth::user()->user_image_url??''}}">
                    <span class="username" style="margin-left: 10px;">
                        @if (Auth::check())
                        {{ Auth::user()->name }}
                        @endif
                    </span>

                    </span>
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu extended logout">
                    <li><a href="#"><i class=" fa fa-suitcase"></i>Hồ sơ</a></li>
                    <li><a href="#"><i class="fa fa-cog"></i> Cài đặt</a></li>
                    <li><a href="{{route('admin.logout')}}"><i class="fa fa-key"></i>Đăng xuất</a></li>
                </ul>
            </li>
            <!-- user login dropdown end -->

        </ul>
        <!--search & user info end-->
    </div>
</header>