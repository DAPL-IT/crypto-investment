<div class="deznav">
    <div class="deznav-scroll">

        <ul class="metismenu" id="menu">
            <li>
                <a href="{{ route('dashboard') }}">
                    <span class="fa-solid fa-house pr-2"></span>
                    <span class="nav-text">Home</span>
                </a>
            </li>
            @if (Auth::user()->isAdmin() || Auth::user()->isSuperAdmin())
                <li>
                    <a href="{{ route('deposit.requests') }}">
                        <span class="fa-solid fa-filter-circle-dollar pr-2"></span>
                        <span class="nav-text">Deposit Requests</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('withdraw.requests') }}">
                        <span class="fa-solid fa-money-bill-trend-up pr-2"></span>
                        <span class="nav-text">Withdraw Requests</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('user.index') }}">
                        <span class="fa-solid fa-users-gear pr-2"></span>
                        <span class="nav-text">Users</span>
                    </a>
                </li>

                <li>
                    <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <span class="fa-solid fa-sliders pr-2"></span>
                        <span class="nav-text">Settings</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('banner_slider.index') }}">Banner</a></li>
                        <li><a href="{{ route('news_slider.index') }}">News</a></li>
                        <li><a href="{{ route('app_settings.index') }}">App</a></li>
                        {{-- <li><a href="#">Gateway</a></li> --}}
                    </ul>
                </li>
                <li>
                    <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <span class="fa-solid fa-list-check"></span>
                        <span class="nav-text">Tasks</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('tasks.index') }}">All</a></li>
                    </ul>
                </li>
            @endif
        </ul>
    </div>
</div>
