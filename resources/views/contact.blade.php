@extends('layouts.app')
@section('title', 'İletişim')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="contact-form-area" style="padding: 30px; border-radius: 15px; background: #fff; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                <h3 class="mb-4">Bizimle İletişime Geçin</h3>
                <p><i class="fa fa-map-marker fa-lg mr-2" style="color: #D34E4E;"></i> Kabaoğlu Mah. Baki Komsuoğlu Sk. İzmit, Kocaeli</p>
                <p><i class="fa fa-phone fa-lg mr-2" style="color: #D34E4E;"></i> +90 555 555 55 55</p>
                <p><i class="fa fa-envelope fa-lg mr-2" style="color: #D34E4E;"></i> gulni.eruslu@gmail.com</p>

                <div class="card mt-5 border-0" style="background-color: #f8f9fa; border-left: 5px solid #D34E4E !important;">
                    <div class="card-body" id="weather-widget">
                        <div class="text-center">
                            <i class="fa fa-spinner fa-spin fa-2x mb-2"></i>
                            <p>Anlık hava durumu API'den çekiliyor...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div id="map" style="width: 100%; height: 100%; min-height: 400px; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);"></div>
        </div>


        <!-- <div class="row">
                <div class="col-12">
                    <p class="text-center">İşbirlikleri ya da geri dönüşleriniz için bizimle aşağıdan iletişime geçebilirsiniz! Yanıtlarımız için lütfen sabırlı olunuz. Elimizden geldiğince hızlı bir şekilde cevap vermeye çalışıyoruz.</p>
                </div>
            
        </div>
    </section> -->
   
    <div class="contact-area section-padding-0-80">
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
    </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Not: Gerçek projede https://openweathermap.org/ adresinden ücretsiz bir API Key alıp buraya yazmalısınız.
    const weatherApiKey = '4c8ad11a6d8896833ee3c7aa3abbed83'; // Test için geçici bir anahtar bıraktım
    const city = 'Kocaeli';

    fetch(`https://api.openweathermap.org/data/2.5/weather?q=${city}&units=metric&lang=tr&appid=${weatherApiKey}`)
        .then(response => response.json())
        .then(data => {
            if(data.main) {
                // Hocanın istediği tüm verileri JSON'dan ayıklıyoruz
                const temp = data.main.temp;
                const desc = data.weather[0].description;
                const humidity = data.main.humidity;
                const pressure = data.main.pressure;

                // Div'in içine dinamik olarak basıyoruz
                document.getElementById('weather-widget').innerHTML = `
                    <h5 class="card-title text-uppercase" style="color: #4b4b4b;"><i class="fa fa-cloud"></i> ${data.name} Hava Durumu</h5>
                    <h2 class="display-4" style="color: #D34E4E; font-weight: bold;">${temp}°C</h2>
                    <p class="mb-1 text-capitalize" style="font-size: 16px;"><b>Açıklama:</b> ${desc}</p>
                    <p class="mb-1" style="font-size: 16px;"><b>Nemlilik:</b> %${humidity}</p>
                    <p class="mb-0" style="font-size: 16px;"><b>Basınç:</b> ${pressure} hPa</p>
                `;
            } else {
                document.getElementById('weather-widget').innerHTML = '<p class="text-danger">API bağlantı hatası veya geçersiz anahtar.</p>';
            }
        })
        .catch(err => {
            console.log(err);
            document.getElementById('weather-widget').innerHTML = '<p class="text-danger">Hava durumu servisine şu an ulaşılamıyor.</p>';
        });
</script>
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
<script>
    function initMap() {

        // Kocaeli Üniversitesi Umuttepe Kampüsü
        var location = {
            lat: 40.8222,
            lng: 29.9217
        };

        // Harita oluştur
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 16,
            center: location,
            mapTypeId: 'roadmap'
        });

        // Marker ekle
        var marker = new google.maps.Marker({
            position: location,
            map: map,
            title: 'Kocaeli Üniversitesi Umuttepe Kampüsü',
            animation: google.maps.Animation.DROP
        });
    }
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD4hGT8XHQavsnGqI4SEuT4lTl1fdQEVg8&callback=initMap" async defer></script>
@endsection