<div class="header">
    <div class="header-content">
        <nav class="navbar navbar-expand">
            <div class="collapse navbar-collapse justify-content-between">
                <div class="header-left"></div>
                <ul class="navbar-nav header-right main-notification">

                    <li class="nav-item dropdown header-profile">
                        <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                            @if (Auth::user()->user_image)
                                <img src="{{ asset(Auth::user()->user_image->icon_full_path) }}"
                                    style="width: 40px !important; height: 40px !important;"
                                    alt="{{ Auth::user()->username }}" />
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->username }}&background=f3f3f3&color=444444"
                                    style="width: 40px !important; height: 40px !important;"
                                    alt="{{ Auth::user()->username }}" />
                            @endif
                            <div class="header-info">
                                <span class="text-uppercase"
                                    style="font-size: 10pt !important;">{{ Auth::user()->username }}</span>
                                <small class="text-uppercase"
                                    style="font-size: 10pt !important;">{{ Auth::user()->account_type }}</small>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="{{ route('user_profile.index') }}" class="dropdown-item ai-icon">
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
