<div class="deznav">
    <div class="deznav-scroll">

        <ul class="metismenu" id="menu">
            <li>
                <a class="" href="{{ route('dashboard') }}">
                    <i class="flaticon-144-layout"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            @if (Auth::user()->isAdmin() || Auth::user()->isSuperAdmin())
                <li>
                    <a class="" href="{{ route('deposit.requests') }}">
                        <i class="flaticon-144-layout"></i>
                        <span class="nav-text">Deposit Requests</span>
                    </a>
                </li>

                <li>
                    <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-381-settings-2"></i>
                        <span class="nav-text">Settings</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('banner_slider.index') }}">Banner</a></li>
                        <li><a href="{{ route('news_slider.index') }}">News</a></li>
                        <li><a href="{{ route('app_settings.index') }}">App</a></li>
                    </ul>
                </li>
            @endif
        </ul>
    </div>
</div>
