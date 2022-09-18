<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ITO X</title>
    <link rel="shortcut icon" href="{{ asset('image/LogoITO_1.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/participant.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Teko:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="rm-p-m">
        <header class="navbar-wrapper">
            <nav class="navbar">
                <a href="">
                    <div class="logo">
                        <img src="{{ asset('image/LogoITO_1.png') }}" alt="">
                    </div>
                </a>
                <div class="nav-link">
                    <div class="nav-link-wrapper">
                        @guest
                        <a href="{{route('home')}}">
                            <p>
                                Beranda
                            </p>
                        </a>
                        @else
                        <a href="{{route('Dashboard')}}">
                            <p>
                                Dashboard
                            </p>
                        </a>
                        <form action="{{ route('logout') }}" method="POST" class="signOut-form">
                            @csrf
                            <input type="submit" value="Logout" class="button signOut">
                        </form>
                        @endguest
                    </div>

                </div>
            </nav>
        </header>
    <main class="mx-auto dashboard">
        @yield('ParticipantDashboard')
    </main>
    <footer></footer>
</body>
</html>