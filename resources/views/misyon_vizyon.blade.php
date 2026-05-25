@extends('layouts.app')
@section('title', 'Misyon & Vizyon')

@section('content')
    <div class="breadcumb-area bg-img bg-overlay" style="background-image: url('{{ asset('img/bg-img/confetti.jpg') }}');">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcumb-text text-center">
                        <h2>Biz Kimiz?</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="about-area section-padding-80-0 mb-5">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="section-heading text-left mt-30">
                        <h3>Bir Tariften Çok Daha Ötesi</h3>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-6 mb-50">
                            <div class="quote-area text-center" style="box-shadow: 0 5px 15px rgba(0,0,0,0.05); padding: 30px; border-radius: 10px; height: 100%;">
                                <span class="d-block mb-30"><i class="fa fa-cutlery fa-2x" aria-hidden="true" style="color: #D34E4E;"></i></span>
                                <h4>Hedefimiz</h4>
                                <p class="text-muted mt-3">Sadece lezzetli tarifler sunmakla kalmıyor, <i>"akşama ne pişirsem"</i> ve <i>"eksik malzeme"</i> derdini ortadan kaldırıyoruz. Tam ölçülü malzeme kutularımızla, mutfak tecrübesi ne olursa olsun herkesin kendi evinde usta bir şef gibi hissetmesini sağlamak en büyük tutkumuz.</p>
                                <p class="font-bold mt-3" style="color: #4b4b4b;">Afiyet Olsun ve Ellerinize Sağlık!</p>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 mb-50">
                            <div class="quote-area text-center" style="box-shadow: 0 5px 15px rgba(0,0,0,0.05); padding: 30px; border-radius: 10px; height: 100%;">
                                <span class="d-block mb-30"><i class="fa fa-leaf fa-2x" aria-hidden="true" style="color: #D34E4E;"></i></span>
                                <h4>Geleceğimiz</h4>
                                <p class="text-muted mt-3">Geleneksel Türk lezzetlerinden dünya mutfağına kadar her tarifi ulaşılabilir kılmak. Evlerdeki gıda israfını sıfıra indirirken, benzersiz lezzet deneyimlerini kapınıza kadar getirerek Türkiye'nin bir numaralı gurme tarif kutusu platformu olmak.</p>
                                <p class="font-bold mt-3" style="color: #4b4b4b;">Yeni Lezzetlerle Birlikte Büyüyoruz!</p>
                            </div>
                        </div>
                    </div>

                    <div class="delicious-add text-center mb-80" style="border-radius: 10px; overflow: hidden;">
                        <div style="background-color: #F9E7B2; padding: 25px 15px;">
                            <h4 style="color: #D34E4E; font-weight: 700; margin-bottom: 0;">🥘 2018'DEN BERİ SİZİNLEYİZ! 🥘</h4>
                            <p style="color: #474747; margin-bottom: 0; font-style: italic; font-size: 16px; margin-top: 5px;">Bu lezzet yolculuğunda bize eşlik ettiğiniz için teşekkür ederiz.</p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="single-widget mb-80" style="background-color: #f8f9fa; padding: 30px; border-radius: 10px; border: 1px solid #eee;">
                        <h6 class="section-heading text-center mb-50">Kurucumuz</h6>

                        <div class="single-blog-area style-3">
                            <div class="blog-thumbnail text-center">
                                <img src="{{ asset('img/bg-img/person.jpg') }}" alt="Kurucu Görseli" class="mb-30" style="max-width: 100%; border-radius: 5px; border-bottom: 3px solid #D34E4E;">
                            </div>
                            <div class="blog-content">
                                <a href="#" class="post-title" style="text-align: center; display: block; color: #4b4b4b; margin-bottom: 15px;">
                                    <h5>Gülnihal ERUSLU</h5>
                                </a>
                                <p class="text-center font-italic text-muted" style="font-size: 14px; line-height: 1.8;">"Yemek yapmak her zaman en büyük hobilerimden biri oldu. Ancak tarifleri uygularken yaşanan malzeme arayışı ve artan malzemelerin israf olması beni yeni bir çözüm bulmaya itti. Artık tarifleri sadece dijital ekranda bırakmıyor, onları tam ölçüsüyle bir kutuya sığdırıp kapınıza getiriyoruz."</p>
                                
                                <div class="meta-data text-center mt-30">
                                    <a href="https://www.linkedin.com/in/g%C3%BClnihal-eruslu-8a8869308" target="_blank" class="btn btn-sm btn-outline-secondary">
                                        <i class="fa fa-linkedin"></i> LinkedIn Profili
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endsection