<nav class="site-navbar navbar navbar-default navbar-fixed-top navbar-mega" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggler hamburger hamburger-close navbar-toggler-left hided"
            data-toggle="menubar">
            <span class="sr-only">Toggle navigation</span>
            <span class="hamburger-bar"></span>
        </button>
        <button type="button" class="navbar-toggler collapsed" data-target="#site-navbar-collapse"
            data-toggle="collapse">
            <i class="icon md-more" aria-hidden="true"></i>
        </button>
<!--         <div class="navbar-brand navbar-brand-center site-gridmenu-toggle" data-toggle="gridmenu">
            <span class="navbar-brand-text hidden-xs-down"> {{ config('app.name') }}</span>
        </div>
 -->
        <div class="navbar-brand navbar-brand-center d-block">
            <img class="navbar-brand-logo" src="{{asset('template')}}/base/assets/images/logo-blue.png">
            <span class="navbar-brand-text"> {{ config('app.name') }}</span>
            <!-- <span class="navbar-brand-text hidden-xs-down"> GENESA</span> -->
        </div>
    </div>
    <div class="navbar-container container-fluid">
        <!-- Navbar Collapse -->
        <div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">
            <ul class="nav navbar-toolbar">
                <li class="nav-item hidden-float" id="toggleMenubar">
                    <a class="nav-link" data-toggle="menubar" href="#" role="button">
                        <i class="icon hamburger hamburger-arrow-left hided unfolded">
                            <span class="sr-only">Toggle menubar</span>
                            <span class="hamburger-bar"></span>
                        </i>
                    </a>
                </li>
            </ul>
            <!-- Navbar Toolbar Right -->
            <ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">
                <li class="nav-item dropdown">
                    <a class="nav-link navbar-avatar" data-toggle="dropdown" href="#" aria-expanded="false"
                        data-animation="scale-up" role="button">
                        <span class="avatar avatar-online">
                            <img src="{{asset('template')}}/global/portraits/5.jpg" alt="...">
                            <i></i>
                        </span>
                    </a>
                    <div class="dropdown-menu" role="menu">
                        <a class="dropdown-item" href="javascript:void(0)" role="menuitem"><i class="icon md-account" aria-hidden="true"></i> Profile</a>
                        <div class="dropdown-divider" role="presentation"></div>
                        <a class="dropdown-item" href="javascript:void(0)" role="menuitem" onclick="logout()">
                            <i class="icon md-power" aria-hidden="true"></i> Logout
                        </a>

                    </div>
                </li>
            </ul>
            <!-- End Navbar Toolbar Right -->
        </div>
        <!-- End Navbar Collapse -->
    </div>
</nav>