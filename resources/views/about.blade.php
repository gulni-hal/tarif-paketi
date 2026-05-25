@extends('layouts.app')
@section('title', 'Hakkımızda')

@section('content')
    <div class="breadcumb-area bg-img bg-overlay" style="background-image: url('{{ asset('img/bg-img/breadcumb1.jpg') }}');">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcumb-text text-center">
                        <h2>Hakkımızda</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="about-area section-padding-80">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading">
                        <h3>Neden böyle bir platform oluşturduk?</h3>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <h6 class="sub-heading pb-5">Yemek yapmak her zaman en büyük hobilerimden biri olmuştur. Yaptığım yemekler, oluşturduğum tarifleri sevdiklerimle paylaşmaktan çok keyif alıyorum. Bu tariflerin sadece kendime özel kalmaması ve aynı zamanda tam ölçülü malzemeleriyle kapınıza gelmesi için bu platformu kurduk.</h6>

                    <p class="text-center">Hangi sebepten dolayı burada olursanız olun, hoşgeldiniz! Yeni, ilginç ve leziz tarifler denemeyi çok seviyoruz. Hedefimiz sadece tarif vermek değil, o tarifi birebir tutturmanızı sağlayacak "Malzeme Kutularını" sizlere ulaştırmak. Siz de bu lezzet yolculuğunda bizimle beraber olursanız çok mutlu oluruz. Afiyet olsun ve ellerinize sağlık!</p>
                </div>
            </div>

           <div class="row align-items-center mt-70">
    <div class="col-12 col-sm-6 col-lg-3">
        <div class="single-cool-fact">
            <img src="{{ asset('img/core-img/salad.png') }}" alt="Kutular">
            <h3><span class="counter">{{ $totalProducts }}</span></h3>
            <h6>Tüm Kutular</h6>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-lg-3">
        <div class="single-cool-fact">
            <img src="{{ asset('img/core-img/icons8-comment-48.png') }}" alt="Yorumlar">
            <h3><span class="counter">{{ $totalReviews }}</span></h3>
            <h6>Toplam Yorum</h6>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-lg-3">
        <div class="single-cool-fact">
            <img src="{{ asset('img/core-img/icons8-user-48.png') }}" alt="Kullanıcılar">
            <h3><span class="counter">{{ $totalUsers }}</span></h3>
            <h6>Kayıtlı Kullanıcı</h6>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-lg-3">
        <div class="single-cool-fact">
            <img src="{{ asset('img/core-img/icons8-package-94.png') }}" alt="Siparişler">
            <h3><span class="counter">{{ $totalOrders }}</span></h3>
            <h6>Toplam Sipariş</h6>
        </div>
    </div>
</div>
          
            <div class="row mt-5">
                <div class="col-12">
                    <div class="our-skills-area text-center">
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="single-pie-bar mb-80" data-percent="100">
                                    <canvas class="bar-circle" width="70" height="100"></canvas>
                                    <h6>Sevgiyle Yapıldı</h6>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="single-pie-bar mb-80" data-percent="87">
                                    <canvas class="bar-circle" width="70" height="100"></canvas>
                                    <h6>Olumlu Geri Dönüş</h6>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="single-pie-bar mb-80" data-percent="60">
                                    <canvas class="bar-circle" width="70" height="100"></canvas>
                                    <h6>Farklı Lezzetler</h6>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="single-pie-bar mb-80" data-percent="93">
                                    <canvas class="bar-circle" width="70" height="100"></canvas>
                                    <h6>Taze ve Sağlıklı</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- <div class="row">
                <div class="col-12">
                    <p class="text-center">İşbirlikleri ya da geri dönüşleriniz için bizimle aşağıdan iletişime geçebilirsiniz! Yanıtlarımız için lütfen sabırlı olunuz. Elimizden geldiğince hızlı bir şekilde cevap vermeye çalışıyoruz.</p>
                </div>
            </div> -->
        </div>
    </section>
    <!-- <div class="contact-area section-padding-0-80">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading">
                        <h3>İletişim Formu</h3>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="contact-form-area">
                        
                        <div id="contact-success-msg" class="alert alert-success text-center" style="display: none; background-color: rgba(40, 167, 69, 0.9); color: white; border: none; padding: 30px; border-radius: 8px; font-weight: 500;">
                            <i class="fa fa-check-circle fa-3x mb-3"></i><br>
                            <h4 style="color: white;">Mesajınız Başarıyla Alındı!</h4>
                            <p class="mb-0" style="color: white;">Bizimle iletişime geçtiğiniz için teşekkür ederiz. Mesajınız admin panelimize iletildi.</p>
                        </div>

                        <form action="{{ route('contact.store') }}" method="POST" id="contact-form">
                            @csrf 
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <input type="text" class="form-control" name="name" id="name" placeholder="İsim Soyisim" required>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <input type="email" class="form-control" name="email" id="email" placeholder="E-mail Adresiniz" required>
                                </div>
                                <div class="col-12">
                                    <input type="text" class="form-control" name="subject" id="subject" placeholder="Konu" required>
                                </div>
                                <div class="col-12">
                                    <textarea name="message" class="form-control" id="message" cols="30" rows="10" placeholder="İçerik (Mesajınız...)" required></textarea>
                                </div>
                                <div class="col-12 text-center">
                                    <button class="btn delicious-btn mt-30" type="submit">Gönder</button>
                                </div>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <script>
        document.getElementById('contact-form').addEventListener('submit', function(e) {
            e.preventDefault(); // Sayfa yenilenmesini engelle

            let form = this;
            let formData = new FormData(form);

            // Laravel Rotalarına arka planda istek atıyoruz
            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    form.style.display = 'none'; // Formu gizle
                    document.getElementById('contact-success-msg').style.display = 'block'; // Başarı mesajını göster
                }
            })
            .catch(error => console.error('Hata:', error));
        });
    </script>
    @endsection