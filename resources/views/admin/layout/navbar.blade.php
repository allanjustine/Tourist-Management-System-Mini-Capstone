<nav class="main-header navbar navbar-expand navbar-light fixed-top">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item mr-3">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <img style="width: 40px; height: 40px; margin-top: -10px;" class="rounded-circle border"
                    src="{{ Auth::user()->profile_image === null && Auth::user()->gender === 'Male'
                        ? url('images/profile-image.png')
                        : (Auth::user()->profile_image === null && Auth::user()->gender === 'Female'
                            ? url('images/profile-image2.png')
                            : Storage::url(Auth::user()->profile_image)) }}"
                    alt=""></i>{{ Auth::user()->name }} <i class="far fa-gears"></i></a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right mr-3">
                <div class=" dropdown-header noti-title">
                    <h6 class="text-overflow m-0" style="text-align: left;">Welcome! {{ Auth::user()->name }}
                    </h6>
                </div>
                <a href="#" class="dropdown-item">
                    <i class="fa fa-user mr-2"></i>
                    <span>{{ auth()->user()->name }}</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="fa-regular fa-arrow-right-from-bracket mr-2"></i>
                    <span>Logout</span>
                </a>
            </div>
        </li>
    </ul>
</nav>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="/admin/dashboard" class="brand-link">
        <img src="/images/icon.png" alt="AJM logo" class="brand-image img-circle elevation-0"
            style="opacity: .8; border-radius: 50%;">
        <span class="brand-text"><strong id="branding-ajm">Travel and Tours</strong></span>
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img id="sidebar-img"
                    src="{{ Auth::user()->profile_image === null && Auth::user()->gender === 'Male'
                        ? url('images/profile-image.png')
                        : (Auth::user()->profile_image === null && Auth::user()->gender === 'Female'
                            ? url('images/profile-image2.png')
                            : Storage::url(Auth::user()->profile_image)) }}"
                    class="img-circle elevation-2" alt="User Image"
                    style="border-radius: 50%; width: 40px; height: 40px;">
            </div>
            <div class="info">
                <a href="#" class="d-block">Welcome, {{ Auth::user()->name }}</a>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar nav-child-indent flex-column" data-widget="treeview" role="menu">
                <li class="nav-item">
                    <a href="/admin/dashboard"
                        class="nav-link {{ 'admin/dashboard' == request()->path() ? 'active2' : '' }}">
                        <i class="nav-icon fa-regular fa-gauge-max"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/users" class="nav-link {{ 'admin/users' == request()->path() ? 'active2' : '' }}">
                        <i class="nav-icon fa-regular fa-users"></i>
                        <p>
                            Users
                        </p>

                        <span class="right badge badge-primary">{{ App\Models\User::count() }}</span>
                    </a>
                </li>
                <li class="nav-header">TRAVEL & TOURS MANAGEMENT</li>
                <li class="nav-item">
                    <a href="/admin/categories"
                        class="nav-link {{ 'admin/categories' == request()->path() ? 'active2' : '' }}">
                        <i class="nav-icon fa-regular fa-grid-2"></i>
                        <p>
                            Categories
                        </p>
                        <span class="right badge badge-primary">{{ App\Models\Category::count() }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/posts" class="nav-link {{ 'admin/posts' == request()->path() ? 'active2' : '' }}">
                        <i class="nav-icon fa-regular fa-blog"></i>
                        <p>
                            Posts
                        </p>
                        <span class="right badge badge-primary">{{ App\Models\Post::count() }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/bookings"
                        class="nav-link {{ 'admin/bookings' == request()->path() ? 'active2' : '' }}">
                        <i class="nav-icon fa-regular fa-calendar-check"></i>
                        <p>
                            Bookings
                        </p>
                        <span class="right badge badge-primary">{{ App\Models\Booking::count() }}</span>
                    </a>
                </li>
                <li class="nav-header">PAGE MANAGEMENT</li>
                <li class="nav-item">
                    <a href="/admin/feedbacks"
                        class="nav-link {{ 'admin/feedbacks' == request()->path() ? 'active2' : '' }}">
                        <i class="nav-icon fa-regular fa-comments"></i>
                        <p>
                            Feed Backs
                        </p>
                        <span class="right badge badge-primary">{{ App\Models\Feedback::count() }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/logs" class="nav-link {{ 'admin/logs' == request()->path() ? 'active2' : '' }}">
                        <i class="nav-icon fa-regular fa-notebook"></i>
                        <p>
                            Logs
                        </p>
                        <span class="right badge badge-primary">{{ App\Models\Log::count() }}</span>
                    </a>
                </li>
                <li class="nav-header">SETTING MANAGEMENT</li>
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa-regular fa-gear"></i>
                        <p>
                            Settings
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <span class="nav-link">
                                <i class="nav-icon fa-regular fa-moon nav-icon"></i>
                                <p>Switch to Dark Mode</p>
                            </span>
                        </li>
                        <li class="nav-item">
                            <span class="nav-link">
                                <i class="nav-icon fa-regular fa-sun"></i>
                                <p>
                                    <label class="theme-switch" for="checkbox">
                                        <input type="checkbox" id="checkbox" />
                                        <span class="slider round"></span>
                                    </label>
                                    <i class="nav-icon fa-regular fa-moon"></i>
                                </p>
                            </span>
                        </li>
                        <li class="nav-item">
                            <a href="#"
                                class="nav-link {{ '#' == request()->path() ? 'active2' : '' }}">
                                <i class="fa-regular fa-user nav-icon"></i>
                                <p>{{ auth()->user()->name }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                <i class="fa-regular fa-right-from-bracket nav-icon"></i>
                                <p>Logout</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Logout</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to logout?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="/logout" class="btn btn-danger">Yes, Logout</a>
            </div>
        </div>
    </div>
</div>

<style>
    .brand-link img {
        filter: drop-shadow(5px 5px 7px rgba(189, 187, 187, 0.7));
    }
</style>
