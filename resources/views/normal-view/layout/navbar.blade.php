<nav class="navbar navbar-expand-lg static-top shadow-lg sticky-top" id="navbar">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="/images/icon.png" alt="travel-and-tours" height="50">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link text-white" href="/travel-and-tours"><i class="far fa-earth-americas"></i> Travel
                        and Tours</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="/about-us"><i class="far fa-circle-info"></i> About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="/contact-us"><i class="far fa-light fa-phone"></i> Contact
                        Us</a>
                </li>
                @role('User')
                    @auth
                        <li class="nav-item">
                            <a class="nav-link text-white" href="/bookings"><i class="far fa-calendar-check"></i> My
                                Bookings</a>
                        </li>
                    @endauth
                @endrole
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="btn btn-primary w-100" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        @auth
                            {{ auth()->user()->name }}
                        @else
                            Join us <i class="far fa-right-to-bracket"></i>
                        @endauth
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        @auth
                            <li><a class="dropdown-item text-white" href="#"><i class="far fa-user"></i> {{ auth()->user()->name }}</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item text-white" href="/logout"><i class="far fa-right-from-bracket"></i>
                                    Logout</a>
                            </li>
                        @else
                            <li><a class="dropdown-item text-white" href="/login"><i class="far fa-right-to-bracket"></i>
                                    Login</a>
                            </li>
                            <li><a class="dropdown-item text-white" href="/register"><i class="fa fa-up-from-bracket"></i>
                                    Register</a>
                            </li>
                        @endauth
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>


<style>
    #navbar {
        background: linear-gradient(to right, #1569ca, #7beafe);
    }

    .navbar-brand,
    .navbar-nav .nav-link {
        font-weight: 700;
        margin-right: 40px;
    }

    .dropdown-menu {
        background: linear-gradient(to right, #1569ca, #7beafe);
    }

    .dropdown-item:hover {
        background-color: #7beafe65;
    }

    #navbarDropdown {
        filter: drop-shadow(12px 12px 7px rgba(41, 113, 248, 0.7));
    }

    .navbar-brand img {
        filter: drop-shadow(12px 12px 7px rgba(0, 0, 0, 0.7));
    }
</style>
