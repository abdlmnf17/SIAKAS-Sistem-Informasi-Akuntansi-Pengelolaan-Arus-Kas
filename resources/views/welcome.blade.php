<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Fonts -->
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=nunito:400,600&display=swap" rel="stylesheet">
    <!-- Styles -->
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background: #022b92;

        }

        .navbar {
            background-color: #3498db;
        }

        .navbar-brand {
            color: #ff0000;
            font-size: 1.5rem;
            font-weight: bold;
        }

        .navbar-nav .nav-link {
            color: #ffffff;
        }

        .welcome-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;

        }

        .welcome-card {
            max-width: 400px;
            width: 100%;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 8px rgba(3, 18, 240, 0.968);
            background-color: #e1e1e1;
        }

        .welcome-logo {
            width: 100px;
            height: 100px;
            margin-bottom: 20px;
        }

        .welcome-links a {

            margin-top: 10px;
            text-align: center;
            align-content: center;
            align-items: center;
            color: #ffffff;
            font-weight: bold;

        }
    </style>
</head>

<body>


    <div class="welcome-container">
        <div class="text-center">
            <div class="welcome-logos-container">
                <img src="https://www.svgrepo.com/show/493351/accounting-man-upper-body.svg" alt="Logo" class="welcome-logo">
                <img src="https://www.svgrepo.com/show/493352/accounting-woman-upper-body.svg" alt="Logo" class="welcome-logo">
        <div class="welcome-card">
            <div class="text-center">

                <p class="text-center text-dark">{{ config('app.name', 'Laravel') }}<br />

            </div>


            <p class="text-center text-dark">Masuk untuk memakai layanan<br />
            </p>




            <div class="welcome-links text-center">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/home') }}" class="btn btn-primary">Masuk</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary">Masuk</a>

                    @endauth
                @endif
            </div>


        </div><br/>
        <br/>


        <p class="text-center text-white">Laravel versi {{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }}) | Status Server : Online <br />
        </p>
    </div>

    <!-- Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
