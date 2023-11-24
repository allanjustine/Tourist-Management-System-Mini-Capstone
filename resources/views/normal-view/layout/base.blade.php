<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@auth
            User
        @else
            Guest
        @endauth @yield('title')</title>
    <link rel="shortcut icon" href="/images/icon.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.0/css/all.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.0/css/sharp-solid.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.0/css/sharp-regular.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.0/css/sharp-light.css">
    @include('normal-view.layout.navbar')
</head>

<body>
    @yield('content')


    <script>
        function goBack() {
            window.history.back();
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

<footer class="footer text-white mt-auto py-3" style="background: linear-gradient(to right, #1569ca, #7beafe);">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h5>Navigation</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-white"><i class="far fa-earth-americas"></i> Travel and Tours</a>
                    </li>
                    <li><a href="#" class="text-white"><i class="far fa-circle-info"></i> About Us</a></li>
                    <li><a href="#" class="text-white"><i class="far fa-light fa-phone"></i> Contact Us</a></li>
                    <li><a href="#" class="text-white"><i class="far fa-calendar-check"></i> My Bookings</a></li>
                </ul>
            </div>
            <div class="col-md-6">
                <h5>Connect with Us</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-white"><i class="fab fa-facebook"></i> Facebook</a></li>
                    <li><a href="#" class="text-white"><i class="fab fa-twitter"></i> Twitter</a></li>
                    <li><a href="#" class="text-white"><i class="fab fa-instagram"></i> Instagram</a></li>
                    <li><a href="#" class="text-white"><i class="fab fa-google"></i> Google</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>

</html>

<style>
    html {
        scroll-behavior: smooth;
    }
</style>
