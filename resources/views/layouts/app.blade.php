<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Tarif Pakati - Malzeme Kutuları">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Tarif Paketi | @yield('title', 'Ana Sayfa')</title>

    <link rel="icon" href="{{ asset('img/core-img/favicon.ico') }}">

    <link rel="stylesheet" href="{{ asset('style.css') }}">
    @yield('styles') </head>

<body>
    <div id="preloader">
        <i class="circle-preloader"></i>
        <img src="{{ asset('img/core-img/salad.png') }}" alt="">
    </div>

    <header class="header-area">

        <div class="top-header-area">
            <div class="container h-100">
                <div class="row h-100 align-items-center justify-content-between">
                    <div class="col-12 col-sm-6">
                        <div class="breaking-news">
                            <div id="breakingNewsTicker" class="ticker">
                                <ul>
                                    <li><a href="#">Hoşgeldiniz!</a></li>
                                    <li><a href="#">Lezzetli tarif kutuları için doğru yerdesiniz!</a></li>
                                    <li><a href="#">Hemen Deneyin!</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6">
                        <div class="top-social-info text-right">
                            <a href="https://www.instagram.com/"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                            <a href="https://www.facebook.com/"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                            <a href="https://www.linkedin.com/"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="delicious-main-menu">
            <div class="classy-nav-container breakpoint-off">
                <div class="container">
                    <nav class="classy-navbar justify-content-between" id="deliciousNav">

                        <a class="nav-brand" href="/"><img src="{{ asset('img/core-img/logo.png') }}" alt="Logo"></a>

                        <div class="classy-navbar-toggler">
                            <span class="navbarToggler"><span></span><span></span><span></span></span>
                        </div>

                        <div class="classy-menu">

                            <div class="classycloseIcon">
                                <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                            </div>

                            <div class="classynav">
                                <ul>
                                    <li class="active"><a href="/">Ana Sayfa</a></li>
                                    <li><a href="#">Sayfalar</a>
                                        <ul class="dropdown">
                                            <li><a href="/">Ana Sayfa</a></li>
                                            <li><a href="/hakkimizda">Hakkımızda</a></li>
                                            <li><a href="/iletisim">İletişim</a></li>
                                            <li><a href="{{ route('misyon-vizyon') }}">Hikayemiz</a></li>
                                            @auth
                                                <li><a href="/siparislerim">Siparişlerim</a></li>
                                                <li><a href="/profil">Hesabım</a></li>
                                            @endauth
                                        </ul>
                                    </li>
                                    
                                    <li><a href="#">Tarİfler</a>
    <div class="megamenu">
       <ul class="single-mega cn-col-3">
    <li class="title" style="color: #D34E4E; font-weight: bold;">Çorbalar ve Ön Lezzetler</li>
    <li><a href="{{ route('category.show', 'corbalar') }}">Çorba ve Meze Tarifleri</a></li>
    <!-- <li><a href="{{ route('category.show', 'corbalar') }}">Meze Tarifleri</a></li> -->
    <li><a href="{{ route('category.show', 'salata') }}">Salata Tarifleri</a></li>
</ul>

        <!-- <ul class="single-mega cn-col-5">
            <li class="title" style="color: #D34E4E; font-weight: bold;">İçecekler</li>
            <li><a href="#">Geleneksel Lezzetler</a></li>
            <li><a href="#">Komposto ve Meyve Suları</a></li>
        </ul> -->

       <ul class="single-mega cn-col-3">
    <li class="title" style="color: #D34E4E; font-weight: bold;">Ana Yemek</li>
    <li><a href="{{ route('category.show', 'zeytinyaglilar') }}">Zeytinyağlı Tarifler</a></li>
    <li><a href="{{ route('category.show', 'et-tavuk') }}">Kırmızı Et ve Tavuk Tarifleri</a></li>
    <!-- <li><a href="{{ route('category.show', 'et-tavuk') }}">Tavuklu Tarifler</a></li> -->
    <li><a href="{{ route('category.show', 'balik') }}">Balık Tarifleri</a></li>
    <li><a href="{{ route('category.show', 'makarna-pilav') }}">Makarna ve Pilav Tarifleri</a></li>
    <!-- <li><a href="{{ route('category.show', 'makarna-pilav') }}">Makarna Tarifleri</a></li> -->
</ul>
        
     <ul class="single-mega cn-col-3">
    <li class="title" style="color: #D34E4E; font-weight: bold;">Tatlılar</li>
    <li><a href="{{ route('category.show', 'tatlilar') }}">Şerbetli ve Sütlü Tatlılar</a></li>
    <!-- <li><a href="{{ route('category.show', 'tatlilar') }}">Sütlü Tatlılar</a></li> -->
    <li><a href="{{ route('category.show', 'tatlilar1') }}">Meyveli ve Çikolatalı Tatlılar</a></li>
</ul>

        <!-- <ul class="single-mega cn-col-5">
            <li class="title" style="color: #D34E4E; font-weight: bold;">Kahvaltı</li>
            <li><a href="#">Yumurta, Ekmek ve Hamur İşi</a></li>
            <li><a href="#">Reçel ve Marmelatlar</a></li>
        </ul> -->
    </div>
</li>
                                    
                                    <li><a href="#">Dünya MUTFAĞI</a>
                                        <ul class="dropdown">
                                            <li><a href="{{ route('category.show', 'dunya') }}">Dünya Lezzetleri</a></li>
                                        </ul>
                                    </li>
                                    
                                    @auth
                                        <li><a href="#" style="color: #D34E4E; font-weight: bold;">{{ Auth::user()->name }}</a>
                                            <ul class="dropdown">
                                                @if(Auth::user()->role === 'admin')
                                                    <li><a href="/admin" style="font-weight: bold; color: #b45ed8;"><i class="fa fa-dashboard"></i> Admin Paneli</a></li>
                                                @endif
                                                <li><a href="/profil"><i class="fa fa-user"></i> Hesabım</a></li>
                                                <li><a href="/siparislerim"><i class="fa fa-list"></i> Siparişlerim</a></li>
                                                <li><a href="#"><i class="fa fa-google-wallet"></i> Bakiye: {{ Auth::user()->balance }} TL</a></li>
                                                <li>
                                                    <form action="{{ route('logout') }}" method="POST" style="margin: 0; padding: 0;">
                                                        @csrf
                                                        <button type="submit" style="background: none; border: none; color: #000000; padding: 10px 20px; width: 100%; text-align: left; cursor: pointer; font-size: 14px;"><i class="fa fa-sign-out"></i> Çıkış Yap</button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </li>
                                    @endauth
                                </ul>

                                <div class="d-flex align-items-center justify-content-end" style="margin-top: 10px; margin-bottom: 10px;">
                                    @guest
                                        <div class="admin-login-btn ml-15">
                                            <a href="{{ route('login') }}" class="btn delicious-btn btn-4" style="height: 40px; line-height: 38px; font-size: 13px; padding: 0 15px;">
                                                <i class="fa fa-sign-in" aria-hidden="true"></i> Giriş Yap
                                            </a>
                                        </div>
                                        

<div class="admin-login-btn ml-15">
    <a href="{{ route('register') }}" 
       class="btn delicious-btn btn-5 register-btn"
       style="height: 40px; line-height: 38px; font-size: 13px;  padding: 0 15px; ">
        
        <i class="fa fa-user-plus " aria-hidden="true"></i> Kayıt Ol
    </a>
</div>
                                    @endguest

                                    @auth
                                        <div class="admin-login-btn ml-15">
                                            <a href="{{ route('cart.index') }}" class="btn delicious-btn btn-4" style="height: 40px; line-height: 38px; font-size: 13px; padding: 0 15px;">
                                                <i class="fa fa-shopping-cart" aria-hidden="true"></i> Sepetim ({{ count((array) session('cart')) }})
                                            </a>
                                        </div>
                                    @endauth

                                    <!-- <div class="search-btn ml-30">
                                        <i class="fa fa-search" aria-hidden="true"></i>
                                    </div>
                                </div> -->

                            </div>
                            </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>

    @yield('content')
   <footer class="footer-area py-5" style=" border-top: 1px solid #eee;">
    <div class="container">
        <div class="row">
            
            <div class="col-12 col-md-4 mb-4 text-center text-md-left">
                <div class="footer-logo mb-3">
                    <a href="/"><img src="{{ asset('img/core-img/logo.png') }}" alt="Tarif Paketi"></a>
                </div>
                <p style="font-size: 13px; color: #777; line-height: 1.6;">
                    Tarif Paketi, yemek yapmayı karmaşık olmaktan çıkarıp keyifli bir deneyime dönüştürür. Seçtiğiniz seçkin gurme tariflerin tüm malzemelerini tam ölçüsünde kapınıza getirerek mutfakta kusursuz başarı sunar.
                </p>
                <div class="footer-social-info mt-3">
                    <a href="https://www.instagram.com/" class="mr-2" style="color:#777;"><i class="fa fa-instagram fa-lg"></i></a>
                    <a href="https://www.facebook.com/" class="mr-2" style="color:#777;"><i class="fa fa-facebook fa-lg"></i></a>
                    <a href="https://www.linkedin.com/" style="color:#777;"><i class="fa fa-linkedin fa-lg"></i></a>
                </div>
            </div>

            <div class="col-12 col-md-4 mb-4 text-center">
                <h5 class="mb-3" style="color: #4b4b4b; font-weight: 600;">Hızlı Menü</h5>
                <ul class="list-unstyled" style="font-size: 14px; line-height: 2;">
                    <li><a href="/" style="color: #666;">Ana Sayfa</a></li>
                    <li><a href="/hakkimizda" style="color: #666;">Hakkımızda</a></li>
                    <li><a href="/iletisim" style="color: #666;">İletişim & Harita</a></li>
                    <li><a href="/sepet" style="color: #666;">Sepetim</a></li>
                </ul>
            </div>

            <div class="col-12 col-md-4 mb-4 text-center text-md-right">
                <h5 class="mb-3" style="color: #4b4b4b; font-weight: 600;">İletişim Bilgileri</h5>
                <p class="mb-2" style="font-weight: 400; font-size: 13px; color: #555;">
                    <i class="fa fa-map-marker" aria-hidden="true" style="color: #D34E4E;"></i>
                    Kabaoğlu Mah. Baki Komsuoğlu Sk. İzmit, Kocaeli
                </p>
                <p class="mb-2" style="font-weight: 400; font-size: 13px; color: #555;">
                    <i class="fa fa-phone" aria-hidden="true" style="color: #D34E4E;"></i>
                    +90 555 555 55 55
                </p>
                <p style="font-weight: 400; font-size: 13px; color: #555;">
                    <i class="fa fa-envelope" aria-hidden="true" style="color: #D34E4E;"></i>
                    gulni.eruslu@gmail.com
                </p>
            </div>

        </div>

        <div class="row pt-3 mt-3" style="border-top: 1px solid #e9ecef;">
            <div class="col-12 text-center">
                <p class="mb-0" style="font-weight: 400; font-size: 13px; color: #777;">
                    Copyright © 2026 Tüm haklar saklıdır. 
                    <span style="margin: 0 5px;">|</span> 
                    Website Tasarımcısı: <span style="font-weight: 700; color: #4b4b4b;">Gülnihal Eruslu</span>
                </p>
            </div>
        </div>
    </div>
</footer>
    <script src="{{ asset('js/jquery/jquery-2.2.4.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/plugins/plugins.js') }}"></script>
    <script src="{{ asset('js/active.js') }}"></script>
    @yield('scripts') </body>
</html>