<div class="header">
    <div class="header-content">
        <nav class="navbar navbar-expand">
            <div class="collapse navbar-collapse justify-content-between">
                <div class="header-left"></div>
                <ul class="navbar-nav header-right main-notification">

                    <li class="nav-item dropdown header-profile">
                        <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                            <img src="https://cdn-icons-png.flaticon.com/512/6596/6596121.png"
                                style="width: 40px !important; height: 40px !important;" alt="" />
                            <div class="header-info">
                                <span class="text-uppercase"
                                    style="font-size: 10pt !important;">{{ Auth::user()->username }}</span>
                                <small class="text-uppercase"
                                    style="font-size: 10pt !important;">{{ Auth::user()->account_type }}</small>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="./app-profile.html" class="dropdown-item ai-icon">
                                <i class="fa-regular fa-user text-primary"></i>
                                <span class="ml-2">Profile </span>
                            </a>
                            <form method="POST" action="{{ route('logout') }}" id='logoutForm'>
                                @csrf
                                <a href="{{ route('logout') }}" class="dropdown-item ai-icon"
                                    onclick="event.preventDefault();
                                    document.getElementById('logoutForm').submit();">
                                    <i class="fa-solid fa-arrow-right-from-bracket text-success"></i>
                                    <span class="ml-2">Logout </span>
                                </a>
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
