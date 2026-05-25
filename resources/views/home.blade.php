@extends('layouts.app')

@section('title', 'Ana Sayfa | Lezzetin Tam Ölçülü Durağı')

@section('content')

    <section class="hero-area">
        <div class="hero-slides owl-carousel">
            
            <div class="single-hero-slide bg-img" style="background-image: url('{{ asset('img/bg-img/bg4.jpg') }}');">
                <div class="container h-100">
                    <div class="row h-100 align-items-center">
                        <div class="col-12 col-md-8 col-lg-7">
                            <div class="hero-content" data-animation="fadeInUp" data-delay="100ms">
                                <h2 data-animation="fadeInUp" data-delay="300ms"  style="color: white;">Mutfakta Devrim!</h2>
                                <p data-animation="fadeInUp" data-delay="700ms"  style="color: white;" >Market market dolaşıp malzeme aramaya son. Beğendiğiniz tarifin tüm malzemeleri, şeflerin tam ölçüsüyle kapınıza gelsin. Siz sadece pişirmenin keyfini çıkarın.</p>
                                <a href="#kutular" class="btn delicious-btn" data-animation="fadeInUp" data-delay="900ms">Kutuları İncele</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="single-hero-slide bg-img" style="background-image: url('{{ asset('img/bg-img/dunnnnn.png') }}');">
                <div class="container h-100">
                    <div class="row h-100 align-items-center">
                        <div class="col-12 col-md-8 col-lg-7">
                            <div class="hero-content" data-animation="fadeInUp" data-delay="100ms">
                                <h2 data-animation="fadeInUp" data-delay="300ms" style="color: white;">Dünya Lezzetleri</h2>
                                <p data-animation="fadeInUp" data-delay="700ms"  style="color: white;">İtalyan mutfağından Uzak Doğu esintilerine kadar tüm dünya lezzetlerini evinizde profesyonelce hazırlayın. Özel tarif kartları ve taze malzemeler paketimizde gizli.</p>
                                <a href="#dunya-mutfagi" class="btn delicious-btn" data-animation="fadeInUp" data-delay="900ms">Dünya Mutfağını Keşfet</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="single-hero-slide bg-img" style="background-image: url('{{ asset('img/bg-img/pexels-jill-wellington-1638660-257816.jpg') }}');">
                <div class="container h-100">
                    <div class="row h-100 align-items-center">
                        <div class="col-12 col-md-8 col-lg-7">
                            <div class="hero-content" data-animation="fadeInUp" data-delay="100ms">
                                <h2 data-animation="fadeInUp" data-delay="300ms"style="color: white;">Sıfır Artık, Tam Ölçü</h2>
                                <p data-animation="fadeInUp" data-delay="700ms"  style="color: white;">Bir yemek için kilolarca malzeme alıp kalanını israf etmeyin. İhtiyacınız olan her şey miligramı miligramına paketlendi. Hem bütçenizi hem de doğayı koruyun.</p>
                                <a href="#kutular" class="btn delicious-btn" data-animation="fadeInUp" data-delay="900ms">Hemen Sipariş Ver</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <section class="cta-area section-padding-80-0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading">
                        <h3>Neden Hazır Tarif Paketleri?</h3>
                        <p>Mutfakta hayatınızı kolaylaştıran modern yemek yapma kültürü ile tanışın.</p>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-12 col-md-4 mb-5 text-center">
                    <div class="single-cta-content" style="padding: 25px; background: #f8f9fa; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
                        <div class="cta-icon mb-3">
                            <img src="{{ asset('img/core-img/pancake.png') }}" alt="Zaman" style="max-height: 60px;">
                        </div>
                        <h5>Zamanınız Size Kalsın</h5>
                        <p style="font-size: 14px;">Akşama ne pişirsem stresi ve saatler süren market alışverişi mazide kaldı. Paketlerimiz sayesinde tüm ön hazırlık süresini sıfıra indiriyoruz.</p>
                    </div>
                </div>

                <div class="col-12 col-md-4 mb-5 text-center">
                    <div class="single-cta-content" style="padding: 25px; background: #f8f9fa; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
                        <div class="cta-icon mb-3">
                            <img src="{{ asset('img/core-img/salad.png') }}" alt="Sıfır Atık" style="max-height: 60px;">
                        </div>
                        <h5>%0 Gıda Atığı, Tam Ölçü</h5>
                        <p style="font-size: 14px;">Kutularımızda sadece tarifin gerektirdiği gramajda malzeme yer alır. Fazla malzeme alıp dolapta çürütme derdine kesin çözüm sunar.</p>
                    </div>
                </div>

                <div class="col-12 col-md-4 mb-5 text-center">
                    <div class="single-cta-content" style="padding: 25px; background: #f8f9fa; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
                        <div class="cta-icon mb-3">
                            <img src="{{ asset('img/core-img/burger.svg') }}" alt="Şef Kartı" style="max-height: 60px;">
                        </div>
                        <h5>İlk Denemede Şef Başarısı</h5>
                        <p style="font-size: 14px;">Kutuların içerisinden çıkan kilitli şef adımları sayesinde, mutfak tecrübeniz ne olursa olsun restoran kalitesinde yemekler hazırlayabilirsiniz.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="best-receipe-area section-padding-80-0" id="kutular">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading">
                        <h3>Öne Çıkan Tarif ve Malzeme Kutuları</h3>
                        <p>Kilitli şef tarifini açmak ve tüm malzemelere tek tıkla ulaşmak için kutunuzu seçin.</p>
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach($products->take(6) as $product)
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="single-best-receipe-area mb-30 shadow-sm" style="border: 1px solid #eee; border-radius: 10px; overflow: hidden; background: #fff;">
                        <img src="{{ asset($product->image_url) }}" alt="{{ $product->name }}" style="width: 100%; height: 230px; object-fit: cover;">
                        <div class="receipe-content" style="padding: 20px;">
                            <a href="{{ route('product.detail', $product->id) }}">
                                <h5 style="color: #4b4b4b;">{{ $product->name }}</h5>
                            </a>
                            <p class="text-muted mt-2" style="font-size: 13px; line-height: 1.5;">{{ Str::limit($product->description, 90) }}</p>
                            <hr>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="h4 mb-0" style="color: #D34E4E; font-weight: bold;">{{ $product->price }} TL</span>
                                <small class="text-secondary">Stok: {{ $product->stock }} Kutu</small>
                            </div>
                            <div class="mt-3">
                                <a href="{{ route('product.detail', $product->id) }}" class="btn delicious-btn btn-sm w-100 text-center" style="height: 38px; line-height: 38px; font-size: 13px;">
                                    <i class="fa fa-shopping-basket"></i> Detay ve Satın Al
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

<section class="best-receipe-area section-padding-80-0" id="dunya-mutfagi" style="background-color: #f8f9fa;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading">
                    <h3>Dünya Mutfağından Özel Paketler</h3>
                    <p>Sınırları aşan gurme lezzetlerin ham malzemeleri şef ölçüleriyle kutulandı.</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="single-best-receipe-area mb-30 shadow-sm" style="border: 1px solid #eee; border-radius: 10px; overflow: hidden; background: #fff;">
                    <img src="{{ asset('img/bg-img/insta4.png') }}" alt="İtalyan" style="width: 100%; height: 230px; object-fit: cover;">
                    <div class="receipe-content" style="padding: 20px;">
                        <span class="badge badge-danger mb-2" style="background-color: #D34E4E;">İTALYAN MUTFAĞI</span>
                        <h5>Fettuccine Alfredo Kutusu</h5>
                        <p class="text-muted mt-2" style="font-size: 13px;">Özel İtalyan makarnası, taze krema, mantar, parmesan peyniri ve özel baharat miksi ile tam ölçüsünde.</p>
                        <hr>
                        <div class="mt-3">
                            <a href="{{ route('product.detail', 33) }}" class="btn delicious-btn btn-sm w-100 text-center" style="height: 38px; line-height: 38px; font-size: 13px;">
                                <i class="fa fa-shopping-basket"></i> Detay ve Satın Al
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-4">
                <div class="single-best-receipe-area mb-30 shadow-sm" style="border: 1px solid #eee; border-radius: 10px; overflow: hidden; background: #fff;">
                    <img src="{{ asset('img/bg-img/Quick-Tacos_1200x800 (1).jpg') }}" alt="Meksika" style="width: 100%; height: 230px; object-fit: cover;">
                    <div class="receipe-content" style="padding: 20px;">
                        <span class="badge badge-success mb-2" style="background-color: #28a745;">MEKSİKA MUTFAĞI</span>
                        <h5>Gurme Etli Taco Kutusu</h5>
                        <p class="text-muted mt-2" style="font-size: 13px;">Özel taco kabukları, marine edilmiş kıyma, cheddar sosu, jalapeno ve otantik avokado sosu miksiyle.</p>
                        <hr>
                        <div class="mt-3">
                            <a href="{{ route('product.detail', 34) }}" class="btn delicious-btn btn-sm w-100 text-center" style="height: 38px; line-height: 38px; font-size: 13px;">
                                <i class="fa fa-shopping-basket"></i> Detay ve Satın Al
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-4">
                <div class="single-best-receipe-area mb-30 shadow-sm" style="border: 1px solid #eee; border-radius: 10px; overflow: hidden; background: #fff;">
                    <img src="{{ asset('img/bg-img/sebzeli-noodle.jpg') }}" alt="Asya" style="width: 100%; height: 230px; object-fit: cover;">
                    <div class="receipe-content" style="padding: 20px;">
                        <span class="badge badge-warning mb-2" style="background-color: #ffc107; color:#fff;">ASYA MUTFAĞI</span>
                        <h5>Sebzeli Noodle Kutusu</h5>
                        <p class="text-muted mt-2" style="font-size: 13px;">Uzak Doğu usulü yumurtalı erişte, soya sosu, zencefil, taze jülyen sebzeler ve susam yağı bileşenleri.</p>
                        <hr>
                        <div class="mt-3">
                            <a href="{{ route('product.detail', 38) }}" class="btn delicious-btn btn-sm w-100 text-center" style="height: 38px; line-height: 38px; font-size: 13px;">
                                <i class="fa fa-shopping-basket"></i> Detay ve Satın Al
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    <section class="quote-subscribe-adds section-padding-80-0" style="background-color: #ffffff;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading text-center">
                        <h3>Kullanıcı Yorumları</h3>
                        <p>Hazır paketlerimizi deneyimleyen müşterilerimizin düşünceleri.</p>
                    </div>
                </div>
            </div>

            <div class="row align-items-center justify-content-center mb-5">
                <div class="col-12 col-lg-4 mb-4">
                    <div class="quote-area text-center" style="padding: 30px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); border-radius: 10px; height: 100%;">
                        <span style="font-size: 60px; color: #D34E4E; line-height: 0.5; display: block; margin-bottom: 20px;">"</span>
                        <h4 style="font-size: 18px; margin-bottom: 15px;">Bu tarifler sayesinde artık yemek yapmak çok kolay! Malzeme arama derdinden kurtuldum.</h4>
                        <p style="font-weight: bold; color: #474747; margin-bottom: 5px;">İrem Taflan</p>
                        <div class="date-comments d-flex justify-content-center">
                            <div class="date text-muted" style="font-size: 12px;">21 Nisan, 2024</div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-4 mb-4">
                    <div class="quote-area text-center" style="padding: 30px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); border-radius: 10px; height: 100%;">
                        <span style="font-size: 60px; color: #D34E4E; line-height: 0.5; display: block; margin-bottom: 20px;">"</span>
                        <h4 style="font-size: 18px; margin-bottom: 15px;">Fettuccine Alfredo kutusu tam bir İtalyan rüyasıydı. İlk defa denememe rağmen restoran kalitesinde oldu.</h4>
                        <p style="font-weight: bold; color: #474747; margin-bottom: 5px;">Ayşe Yılmaz</p>
                        <div class="date-comments d-flex justify-content-center">
                            <div class="date text-muted" style="font-size: 12px;">15 Mayıs, 2024</div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-4 mb-4">
                    <div class="quote-area text-center" style="padding: 30px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); border-radius: 10px; height: 100%;">
                        <span style="font-size: 60px; color: #D34E4E; line-height: 0.5; display: block; margin-bottom: 20px;">"</span>
                        <h4 style="font-size: 18px; margin-bottom: 15px;">Hiçbir malzeme israfı olmadan şef gibi hissettim. Porsiyonlar inanılmaz doyurucu ve tam kararında.</h4>
                        <p style="font-weight: bold; color: #474747; margin-bottom: 5px;">Ahmet Kaya</p>
                        <div class="date-comments d-flex justify-content-center">
                            <div class="date text-muted" style="font-size: 12px;">02 Haziran, 2024</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    


<section class="newsletter-area section-padding-80" style="background-image: url('{{ asset('img/bg-img/soups.jpg') }}'); background-size: cover; background-attachment: fixed;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-md-6">
                    <div class="newsletter-heading">
                        <h3 class="text-white">Daha Fazla Paket İçin Haberdar Olun!</h3>
                        <p class="text-white mb-0">Menümüze her hafta eklenen yeni dünya mutfakları, şef tarif kutuları ve sürpriz indirimlerden ilk siz haberdar olun.</p>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="newsletter-form-area">
                        
                        <div id="subscribe-success-msg" class="alert alert-success" style="display: none; background-color: rgba(40, 167, 69, 0.9); color: white; border: none; padding: 15px; border-radius: 5px; font-weight: 500;">
                            <i class="fa fa-check-circle"></i> Başarıyla abone olundu! Yeni paket duyuruları e-postanıza gönderilecektir.
                        </div>

                        <form action="#" method="get" id="subscribe-form" onsubmit="event.preventDefault(); document.getElementById('subscribe-form').style.display = 'none'; document.getElementById('subscribe-success-msg').style.display = 'block';">
                            <input type="email" class="form-control" placeholder="E-posta adresinizi yazın..." required>
                            <button type="submit" class="btn delicious-btn">Abone Ol</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
    @endsection