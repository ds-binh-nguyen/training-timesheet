<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <title>@yield('title')</title>

    <!-- Bootstrap core CSS -->
    <link href="{!! url('assets/bootstrap/css/bootstrap.min.css') !!}" rel="stylesheet">
    <script src="{!! url('assets/bootstrap/js/bootstrap.bundle.min.js') !!}"></script>
</head>
<body>
    <div class="container-fluid h-100">
        <div class="row h-100">
            @include('layouts.partials.sidebar')

            <div class="col-md-10">
                <!-- Navbar -->
                @include('layouts.partials.navbar')

                <!-- Content -->
                <div class="container mt-3" style="height: 100vh;">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</body>
</html>
