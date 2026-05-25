<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Schema;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Eski seeder verilerinin çakışmaması için önce tabloyu temizliyoruz
        Schema::disableForeignKeyConstraints();
        Product::truncate();
        Schema::enableForeignKeyConstraints();

        $packages = [
            // ================= ÇORBALAR VE ÖN LEZZETLER =================
            [
                'name' => 'Ezo Gelin Çorbası Malzeme Kutusu',
                'description' => 'Tam ölçüsünde kırmızı mercimek, bulgur, pirinç ve özel nane-pul biber karışımıyla geleneksel lezzet.',
                'price' => 75.00,
                'stock' => 45,
                'image_url' => 'img/bg-img/r2.jpg',
            ],
            [
                'name' => 'Süzme Mercimek Çorbası Kutusu',
                'description' => 'Kıvamı tam tutan mercimek, taze patates, havuç ve üzerine dökülecek özel tereyağı sosu ile birlikte.',
                'price' => 70.00,
                'stock' => 50,
                'image_url' => 'img/bg-img/suzme-mercimek-corbasi-t.jpg',
            ],
            [
                'name' => 'Közlenmiş Domates Çorbası Kutusu',
                'description' => 'Taze közlenmiş domatesler, krema, tereyağı ve özel baharatlarla nefis domates çorbası kiti.',
                'price' => 65.00,
                'stock' => 40,
                'image_url' => '', // Görsel eklenecek
            ],
            [
                'name' => 'Gurme Acılı Ezme Kutusu',
                'description' => 'Taze domates, biber, bol maydanoz, nar ekşisi ve acısıyla mezelerin şahı ezme kiti.',
                'price' => 55.00,
                'stock' => 30,
                'image_url' => 'img/bg-img/acili-ezme.jpg',
            ],
            [
                'name' => 'Geleneksel Kısır Kutusu',
                'description' => 'İnce bulgur, taze yeşillikler, nar ekşisi, özel salça karışımı ve baharatlarla tam ölçülü kısır seti.',
                'price' => 55.00,
                'stock' => 35,
                'image_url' => '', // Görsel eklenecek
            ],
            [
                'name' => 'Orijinal Sezar Salata Kutusu',
                'description' => 'Taze marul, çıtır kruton ekmekler, parmesan peyniri ve orijinal ançüezli Sezar sos malzemeleri.',
                'price' => 85.00,
                'stock' => 35,
                'image_url' => '', // Görsel eklenecek
            ],
            [
                'name' => 'Zeytinyağlı Şakşuka Kutusu',
                'description' => 'Kızartmalık patlıcan, biber, domates ve özel sarmısaklı domates sosu ile nefis şakşuka malzemeleri.',
                'price' => 75.00,
                'stock' => 25,
                'image_url' => '', // Görsel eklenecek
            ],

            // ================= ANA YEMEKLER - ZEYTİNYAĞLILAR =================
            [
                'name' => 'Zeytinyağlı Yaprak Sarma Kutusu',
                'description' => 'İncecik salamura asma yaprakları, kuş üzümlü ve dolma fıstıklı özel iç harcı bileşenleri.',
                'price' => 140.00,
                'stock' => 25,
                'image_url' => 'img/bg-img/zeytinyagli-yaprak-sarma-281366-5282c119-d499-47d6-80f0-cbefbbcf3488-resized.png',
            ],
            [
                'name' => 'Geleneksel İmambayıldı Kutusu',
                'description' => 'Alacalı soyulmuş taze patlıcanlar, bol domatesli ve sarımsaklı iç harç malzemesi.',
                'price' => 110.00,
                'stock' => 20,
                'image_url' => 'img/bg-img/imam-bayildi-t.jpg',
            ],
            [
                'name' => 'Zeytinyağlı Enginar Kutusu',
                'description' => 'Ayıklanmış çanak enginarlar, taze garnitür miksi ve portakallı özel pişirme sosu.',
                'price' => 160.00,
                'stock' => 15,
                'image_url' => 'img/bg-img/zey-eng.jpg',
            ],
            [
                'name' => 'Zeytinyağlı Taze Fasulye Kutusu',
                'description' => 'Mevsiminde toplanmış taze fasulye, sızma zeytinyağı, soğan ve domates rendesi ile geleneksel lezzet.',
                'price' => 85.00,
                'stock' => 30,
                'image_url' => '', // Görsel eklenecek
            ],
            [
                'name' => 'Zeytinyağlı Barbunya Pilaki Kutusu',
                'description' => 'Taze barbunya, havuç, patates ve sızma zeytinyağı ile hazırlanan hafif ve doyurucu pilaki seti.',
                'price' => 80.00,
                'stock' => 20,
                'image_url' => '', // Görsel eklenecek
            ],

            // ================= ANA YEMEKLER - ETLİLER & TAVUKLULAR =================
            [
                'name' => 'Arpaçık Soğanlı Kuzu Güveç Kutusu',
                'description' => 'Lokum gibi kuzu eti, arpaçık soğanlar, taze sarımsak ve toprak güveç lezzeti kiti.',
                'price' => 240.00,
                'stock' => 15,
                'image_url' => 'img/bg-img/arpacik-soganli-kuzu-guvec-tarifi.jpg',
            ],
            [
                'name' => 'Fırında Beşamel Soslu Tavuk Kutusu',
                'description' => 'Kuşbaşı tavuk göğsü, beşamel sos için un ve tereyağı, üzeri için taze kaşar peyniri.',
                'price' => 135.00,
                'stock' => 40,
                'image_url' => 'img/bg-img/besamel-soslu-firin-tavuk-t.jpg',
            ],
            [
                'name' => 'Soslu Tavuk Kanat Kutusu',
                'description' => 'Özel marine sosuyla harmanlanmış taze kanatlar ve fırınlama sebzeleri.',
                'price' => 125.00,
                'stock' => 35,
                'image_url' => 'img/bg-img/soslu-tavuk-kanatlari-t.jpg',
            ],
            [
                'name' => 'Etli Nohut Yemeği Kutusu',
                'description' => 'Kuşbaşı dana eti, ıslatılmış koçbaşı nohut ve özel salça sosu ile esnaf lokantası lezzeti.',
                'price' => 140.00,
                'stock' => 30,
                'image_url' => '', // Görsel eklenecek
            ],
            [
                'name' => 'Çıtır Tavuk Şinitzel Kutusu',
                'description' => 'Özel dövülmüş tavuk göğsü, panko pane harcı, un, yumurta ve kızartma yağını içeren tam set.',
                'price' => 115.00,
                'stock' => 40,
                'image_url' => '', // Görsel eklenecek
            ],

            // ================= MAKARNA VE PİLAVLAR =================
            [
                'name' => 'Fırında Mac and Cheese Kutusu',
                'description' => 'Özel dirsek makarna, yoğun çedar peyniri sosu karışımı ve fırın tepsisi dahil yemek kiti.',
                'price' => 95.00,
                'stock' => 60,
                'image_url' => 'img/bg-img/mac-and-cheese-i.jpg',
            ],
            [
                'name' => 'Soslu Köfteli Makarna Kutusu',
                'description' => 'Özel İtalyan makarnası, anne köftesi harcı ve fesleğenli domates sosu ile çocukların favorisi.',
                'price' => 110.00,
                'stock' => 45,
                'image_url' => '', // Görsel eklenecek
            ],
            [
                'name' => 'Garnitürlü Pirinç Pilavı Kutusu',
                'description' => 'Baldo pirinç, taze bezelye-havuç-mısır miksi ve pilavın sırrı hakiki tereyağı.',
                'price' => 65.00,
                'stock' => 50,
                'image_url' => 'img/bg-img/garneturlu-pilav.html',
            ],
            [
                'name' => 'Nohutlu Sokak Pilavı Kutusu',
                'description' => 'Geceden ıslatılmış koçbaşı nohutlar, pilavlık pirinç ve özel tavuk bulyon özü.',
                'price' => 60.00,
                'stock' => 55,
                'image_url' => 'img/bg-img/nohutlu-pilav-4.jpg',
            ],
            [
                'name' => 'Tavuklu Arpa Şehriye Pilavı Kutusu',
                'description' => 'Didiklenmiş tavuk göğsü, kavrulmuş arpa şehriye ve tavuk suyu özü ile tane tane dökülen pilav kiti.',
                'price' => 90.00,
                'stock' => 40,
                'image_url' => '', // Görsel eklenecek
            ],

            // ================= TATLILAR =================
            [
                'name' => 'Çikolatalı Akışkan Sufle Kutusu',
                'description' => 'Yüksek kakao oranlı bitter çikolata, sufle unu, tereyağı ve ısıya dayanıklı kaplar.',
                'price' => 85.00,
                'stock' => 40,
                'image_url' => 'img/bg-img/r1.jpg',
            ],
            [
                'name' => 'Hafif Fırın Sütlaç Kutusu',
                'description' => 'Tam ölçülü nişasta, kırık pirinç, vanilin ve fırında kızarması için özel toprak kaseler.',
                'price' => 70.00,
                'stock' => 30,
                'image_url' => 'img/bg-img/fırın-sutlac.html',
            ],
            [
                'name' => 'Cevizli Ev Baklavası Kutusu',
                'description' => 'İncecik açılmış hazır baklava yufkaları, bol yerli ceviz içi ve şerbet malzemeleri.',
                'price' => 190.00,
                'stock' => 12,
                'image_url' => 'img/bg-img/cevizli-kolay-baklava-t.jpg',
            ],
            [
                'name' => 'Geleneksel Keskül Kutusu',
                'description' => 'Çekilmiş badem tozu, sütlaçlık pirinç unu ve süsleme için file badem parçacıkları.',
                'price' => 75.00,
                'stock' => 25,
                'image_url' => 'img/bg-img/keskul-t.jpg',
            ],
            [
                'name' => 'İtalyan Usulü Tiramisu Kutusu',
                'description' => 'Kedidili bisküviler, özel espresso kahve miksi ve labneli krema harcı bileşenleri.',
                'price' => 120.00,
                'stock' => 20,
                'image_url' => 'img/bg-img/tiramisu-kek-i8.jpg',
            ],
            [
                'name' => 'Yanık Tereyağlı Brownie Kutusu',
                'description' => 'Karamelize edilmiş tereyağı lezzeti, yoğun çikolata parçacıkları ve brownie un miksi.',
                'price' => 115.00,
                'stock' => 30,
                'image_url' => 'img/bg-img/yanik-tereyagli-brownie-t.jpg',
            ],
            [
                'name' => 'Cevizli Kalburabastı Kutusu',
                'description' => 'Kıyır kıyır hamuru, ceviz içi ve tam ölçülü şerbet malzemeleriyle geleneksel tatlımız.',
                'price' => 95.00,
                'stock' => 25,
                'image_url' => '', // Görsel eklenecek
            ],
            [
                'name' => 'Limonlu Haşhaşlı Kek Kutusu',
                'description' => 'Taze limon kabuğu rendesi, mavi haşhaş tohumu ve yumuşacık kek harcı bileşenleri.',
                'price' => 75.00,
                'stock' => 30,
                'image_url' => '', // Görsel eklenecek
            ],
            [
                'name' => 'Orman Meyveli Kek Kutusu',
                'description' => 'Dondurulmuş orman meyveleri, özel kek unu ve beyaz çikolata parçacıkları ile nefis tatlı kiti.',
                'price' => 85.00,
                'stock' => 20,
                'image_url' => '', // Görsel eklenecek
            ],
            [
                'name' => 'Tarçınlı Elmalı Crumble Kutusu',
                'description' => 'Karamelize elma harcı, tarçın ve kıtır üst hamuru (crumble) ile sıcak servis edilecek tatlı kiti.',
                'price' => 90.00,
                'stock' => 35,
                'image_url' => '', // Görsel eklenecek
            ],

            // ================= DÜNYA MUTFAĞI =================
            [
                'name' => 'Fettuccine Alfredo Paket Kutusu',
                'description' => 'Özel İtalyan yassı makarnası, taze krema, mantar, parmesan peyniri ve özel italyan otları.',
                'price' => 130.00,
                'stock' => 40,
                'image_url' => 'img/bg-img/bg4.jpg',
            ],
            [
                'name' => 'Gurme Etli Meksika Taco Kutusu',
                'description' => 'Çıtır taco kabukları, özel kıyma baharatı, çedar sosu ve meksika fasulyeli iç harç malzemesi.',
                'price' => 175.00,
                'stock' => 18,
                'image_url' => 'img/bg-img/bg2.jpg',
            ]
        ];

        foreach ($packages as $package) {
            Product::create($package);
        }
    }
}