<!-- Navbar -->
<nav class="navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item" style="font-size: 1.3em;padding: 5px;">
            <a href="{{ route('dashboard') }}" title="" data-toggle="tooltip" data-placement="bottom"
                class="btn btn-primary btn-flat pull-left m-8 hidden-xs btn-sm mt-10" data-original-title="Dashboard">
                <strong><i class="fas fa-undo"></i> &nbsp; @lang('site.dashboard')</strong>
            </a>
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown" style="font-size: 1.3em;padding: 5px;">
            <a class="btn btn-primary btn-flat pull-left m-8 hidden-xs btn-sm mt-10" data-toggle="dropdown" href="#">
                <i class="fas fa-bell"></i> <span>9</span>
            </a>
        </li>
    </ul>
    <ul class="navbar-nav mx-auto">
        <li class="nav-item" style="display:inline-block;">
            <div class="font-weight-bold" id='date-part' style="font-size: 1.2em;padding: 5px;"></div>
        </li>
        <li class="nav-item" style="display:inline-block;">
            <div class="font-weight-bold" id='time-part' style="font-size: 1.3em;padding: 5px;"></div>
        </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="dropdown09" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                {{ LaravelLocalization::getCurrentLocaleName() }}
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdown09">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}"
                    href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                    {{ $properties['native'] }}
                </a>
                @endforeach
            </div>
        </li>
        <li class="dropdown user user-menu" style="font-size: 1.3em;padding: 5px">
            <a href=" #" class="user-panel d-flex" style="text-decoration: none;" data-toggle="dropdown">
                <div class="image">
                    <img src="{{ auth()->user()->image_path }}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <span class="d-block">{{ auth()->user()->first_name }}
                        {{ auth()->user()->last_name }}</span>
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right text-center">
                <div class="text-center">
                    <img src="{{ auth()->user()->image_path }}" style="width:150px;"
                        class="img img-thumbnail dropdown-item mx-auto d-block" alt="User Image">
                </div>
                <div class="dropdown-divider"></div>
                <span class="dropdown-item dropdown-header">{{ auth()->user()->first_name }}
                    {{ auth()->user()->last_name }}</span>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item dropdown-header"><i class="fas fa-user-circle"></i> @lang('site.profile')</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item dropdown-header" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i
                        class="fas fa-power-off"></i>
                    @lang('site.logout')
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
