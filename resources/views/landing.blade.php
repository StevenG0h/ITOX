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
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="{{ asset('css/draggable-slider.css') }}" />
    
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,500;0,800;1,500;1,800&display=swap" rel="stylesheet">
<style>
    body{
        font-family: 'Noto Sans', sans-serif;
    }
</style>
</head>
    <body class="landing">
        
        <header class="navbar-wrapper">
            <nav class="navbar">
                <a href="">
                    <div class="logo">
                        <img src="{{ asset('image/LogoITO_1.png') }}" alt="">
                    </div>
                </a>
                <div class="nav-link">
                    <div class="nav-link-wrapper" >
                        <a href="#home" class="mx-1">
                            <p>Beranda</p>
                        </a>
                        <a href="#about" >
                            <p>Tentang ITO</p>
                        </a>
                        <a href="#competition" class="mx-1">
                            <p>Cabang Lomba</p>
                        </a>
                        @guest
                        <a href="{{ route('login') }}" class="ml-1">
                            <p>Login</p>
                        </a>
                        <form action="{{ route('register') }}" method="get" class="signOut-form">
                            <input type="submit" value="Daftar" class="button signOut">
                        </form>
                        @else
                        <a href="">
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
        <div class="divider" id="home">
        <section class="hero-section">
            <div class="hero-section-content">
                    <div class="hero-section-content-title">
                        <h1>PENDAFTARAN ITO X TELAH DIBUKA</h1>
                    </div>
                <div class="hero-image">
                    <img src="{{ asset('image/LogoITO_1.png') }}" alt="" srcset="">
                </div>
                <div class="hero-section-content-sub">  
                    <h2>" INNOVATE WITHOUT LIMIT "</h2>
                    <a href="#about" class="button">
                        Yuk, lihat lebih banyak
                    </a>
                </div>
                    
            </div>
            
        </section>
        <div class="divider" id="about">
        </div>
        <main class="landing-wrapper">
            <section class="about p1" id="about">
                <div class="about-image">
                    <img src="{{ asset('image/maskotITO.png') }}" alt="" srcset="">
                </div>
                
                <div class="about-content">
                    <h1>Apa itu ITO X</h1>
                    <p>ITO merupakan acara olimpiade yang dibuat dan dijalankan langsung oleh mahasiswa dari program studi Teknik Informatika atau yang lebih dikenal dengan ITSA. Pada tahun ini diadakan Acara ITO yang ke 10 oleh karena itu dinamakan ITO X. Acara ini akan berlangsung selama 3 (tiga) hari, dimana hari pertama akan diadakan acara pembukaan dan technical meeting. Pada hari kedua diadakan perlombaan seperti Lomba Cerdas Cermat, Jaringan, Animasi, Pemograman, Film Pendek, Desain Web dan Desain Poster.</p>
                    <p>Pada hari ketiga beberapa lomba akan masuk ketahap selanjutnya dan juga akan dilaksanakan pengumuman pemenang pada akhir acara. Pada acara ini, akan melibatkan dosen serta mahasiswa Politeknik Caltex Riau yang berperan sebagai juri hingga panitia, sementara untuk peserta olimpiade akan diikuti oleh siswa-siswi SMA dan SMK sederajat serta mahasiswa-mahasiswi kampus sederajat seluruh Indonesia. Perlombaan akan diadakan di beberapa laboratorium dan lingkungan Politeknik Caltex Riau.</p>
                </div>
            </section>
            <section class="competition my-1" id="competition">
                <h1>Kategori Lomba</h1>
                <div id="css-script-menu">
                  <div class="container">
                    <div id="example" class="draggable-slider">
                    <div class="inner">
                    @foreach($competitions as $competition)
                        <div class="slide">
                            <div class="slide-child">
                                <div class="slide-child-title">
                                    <h1>{{$competition->nama_lomba}}</h1>
                                </div>
                                <div class="slide-child-image">
                                    <img src="{{ asset('storage/'.$competition->maskot) }}" alt="">
                                </div>
                                <div class="slide-child-title">
                                    @php
                                        $date = new DateTime($competition->batas_pendaftaran)
                                    @endphp
                                    <h1>{{$date->format("j F, Y")}}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="slide">
                            <div class="slide-child">
                                <div class="slide-child-title">
                                    <h1>{{$competition->nama_lomba}}</h1>
                                </div>
                                <div class="slide-child-image">
                                    <img src="{{ asset('storage/'.$competition->maskot) }}" alt="">
                                </div>
                                <div class="slide-child-title">
                                    @php
                                        $date = new DateTime($competition->batas_pendaftaran)
                                    @endphp
                                    <h1>{{$date->format("j F, Y")}}</h1>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </div>
                  </div>
                  </div>
            </section>
        </main>
        
        <footer>
            <p>Copyright&copy ITO X Team 2022</p>
        </footer>
    </body>
</html>
<script src="{{ asset('js/draggable-slider.js') }}"></script>
<script>
  const mySlider = new DraggableSlider('example');
</script>