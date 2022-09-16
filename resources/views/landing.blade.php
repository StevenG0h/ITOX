<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/participant.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
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
    <body>
        <header class="navbar-wrapper p1">
            <nav class="navbar">
                <a href="">
                    <div class="logo">
                        Hello
                    </div>
                </a>
                <div class="nav-link">
                    <a href="" >
                        <p>Beranda</p>
                    </a>
                    <a href="" class="mx-1">
                        <p>Tentang ITO</p>
                    </a>
                    <a href="" >
                        <p>Cabang Lomba</p>
                    </a>
                    <a href="" class="mx-1">
                        <p>Kontak</p>
                    </a>
                    <a href="">
                        Daftar
                    </a>
                </div>
            </nav>
        </header>
        <main class="landing-wrapper">
            <section class="hero-section" id="home">
                <h1>PENDAFTARAN ITO X TELAH DIBUKA</h1>
                <div class="hero-image">
                    <img src="{{ asset('image/maskotITO.png') }}" alt="" srcset="">
                </div>
                <h2>" Innovate without limit "</h2>
                <div>
                    <a href="#about" class="button">
                        Yuk, lihat lebih banyak
                    </a>
                </div>
            </section>
            <section class="about p1" id="about">
                <div class="about-image">
                    
                </div>
                <div class="about-content">
                    <h1>Apa itu ITO</h1>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloribus perspiciatis harum reprehenderit nulla, tempore voluptas! Quod perferendis exercitationem, vitae officiis alias aliquid soluta accusantium dolores veniam consectetur enim voluptate quis.</p>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloribus perspiciatis harum reprehenderit nulla, tempore voluptas! Quod perferendis exercitationem, vitae officiis alias aliquid soluta accusantium dolores veniam consectetur enim voluptate quis.</p>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloribus perspiciatis harum reprehenderit nulla, tempore voluptas! Quod perferendis exercitationem, vitae officiis alias aliquid soluta accusantium dolores veniam consectetur enim voluptate quis.</p>
                </div>
            </section>
            <section class="competition my-1" id="competition">
                <h1>Kategori Lomba</h1>
                <div class="competition-item my-1">
                    <h2 class="competition-carousel-head">Web Design</h2>
                    <h2 class="competition-carousel-head">Poster</h2>
                    <h2 class="competition-carousel-head">Jaringan</h2>
                    <h2 class="competition-carousel-head">Web Design</h2>
                    <h2 class="competition-carousel-head">Web Design</h2>
                    <div class="competition-slider-wrapper">
                        <div class="competition-item-image carousel-item-image-active">
                            <img src="{{ asset('image/WEB1.png') }}" alt="">
                        </div>
                        <div class="competition-item-image">
                            <img src="{{ asset('image/JARINGAN.png') }}" alt="">
                        </div>
                        <div class="competition-item-image">
                            <img src="{{ asset('image/WEB1.png') }}" alt="">
                        </div>
                        <div class="competition-item-image">
                            <img src="{{ asset('image/WEB1.png') }}" alt="">
                        </div>
                        <div class="competition-item-image">
                            <img src="{{ asset('image/WEB1.png') }}" alt="">
                        </div>
                    </div>
                    <h2 class="competition-carousel-subhead">Batas Pendaftaran 3 November 2022</h2>
                    <h2 class="competition-carousel-subhead">Batas Pendaftaran 4 November 2022</h2>
                    <h2 class="competition-carousel-subhead">Batas Pendaftaran 5 November 2022</h2>
                    <h2 class="competition-carousel-subhead">Batas Pendaftaran 6 November 2022</h2>
                    <h2 class="competition-carousel-subhead">Batas Pendaftaran 7 November 2022</h2>
                    <div class="button-wrap">
                        <a href="" class="button">Unduh Guidebook</a>
                    </div>
                </div>
            </section>
        </main>
        <footer>

        </footer>
    </body>
</html>
<script>
var carouselWrapper = document.querySelectorAll('.competition-slider-wrapper');
var carouselItem = document.querySelectorAll('.competition-item-image');
var carouselSubHead = document.querySelectorAll('.competition-carousel-subhead');
var carouselHead = document.querySelectorAll('.competition-carousel-head');
var carouselIndex = [];
var carouselButtonIndex = [];
for (let i = 0; i < carouselWrapper.length; i++) {
    carouselIndex[i] = 0;
    carouselButtonIndex[i] = 0;
}
function carousel(index,carousel) {
    carouselItem[index].classList.add("carousel-item-image-active");
    carouselWrapper[carousel].style.transform = "translateX("+index*-20+"%)";
    carouselSubHead[index].style.display = "block";
    carouselHead[index].style.display = "block";
    carouselIndex[carousel] = index;
    
}
function carouselFade(index,carousel){
    if(index == -1){
        index = 4;
    }
    carouselItem[index].classList.remove("carousel-item-image-active");
    carouselWrapper[carousel].style.transform = "translateX("+index*-20+"%)";
    carouselSubHead[index].style.display = "none";  
    carouselHead[index].style.display = "none";  
}
function nextCarousel(){
    
    for (let i = 0; i < carouselIndex.length; i++) {
        let carousel = carouselIndex[i];
        if(carousel == 4){
            carousel =-1;
        }
        this.carouselFade(carousel,i)   
        this.carousel(carousel+1,i);
        
    }   
    
}
setInterval(nextCarousel,4000);
</script>