<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> @yield('title') </title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
</head>

<body>



    <section class=" container">

        <div class=" row">
            <div class="col-12">
                @include('layout.header')
            </div>
            <div class="col-12 col-md-3">
                @user
                    @if (is_null(session('auth')->email_verified_at))
                        <div class=" alert alert-info">
                            Your account verify is <a href="{{ route('auth.verify') }}" class=" alert-link">here</a>
                        </div>
                    @endif
                @enduser

                @include('layout.nav')
            </div>
            <div class="col-12 col-md-9">
                @yield('content')
            </div>
        </div>

    </section>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
