<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
class HomeController extends Controller
{
   public function index()
    {
        // Veritabanındaki tüm yayında olan ürünleri çekiyoruz
        $products = Product::where('is_published', 1)->get();

        // Çektiğimiz ürünleri 'home' view dosyasına gönderiyoruz
        return view('home', compact('products'));
    }
    public function show($id)
    {
        // URL'den gelen ID'ye ait ürünü bulur. Bulamazsa 404 hatası verir.
        $product = Product::with('reviews.user')->findOrFail($id);
        
        $hasPurchased = false;
        if (auth()->check()) {
            // Kullanıcı bu ürünü satın almış mı?
            $hasPurchased = \App\Models\Order::where('user_id', auth()->id())
                ->where('status', '!=', 'iptal_edildi')
                ->whereHas('items', function($query) use ($id) {
                    $query->where('product_id', $id);
                })->exists();
        }

        return view('product_detail', compact('product', 'hasPurchased'));
    }

    public function category($slug)
{
    // Varsayılan değerler
    $title = 'Tarif Paketleri';
    $query = Product::where('is_published', 1);

    // Gelen slug değerine göre veritabanı filtresi ve sayfa başlığı ayarı
    switch ($slug) {
        case 'corbalar':
            $title = 'Çorbalar ve Ön Lezzetler';
            $query->where(function($q) {
                $q->where('name', 'LIKE', '%Çorba%')->orWhere('name', 'LIKE', '%Şakşuka%')->orWhere('name', 'LIKE', '%ezme%');
            });
            break;
        case 'zeytinyaglilar':
            $title = 'Zeytinyağlı Tarif Paketleri';
            $query->where('name', 'LIKE', '%Zeytinyağlı%')
                  ->orWhere('name', 'LIKE', '%İmambayıldı%')
                  ->orWhere('name', 'LIKE', '%Enginar%');
            break;
        case 'et-tavuk':
            $title = 'Et ve Tavuk Yemekleri Paketleri';
            $query->where('name', 'LIKE', '%Kuzu%')
                  ->orWhere('name', 'LIKE', '%Tavuk%')
                  ->orWhere('name', 'LIKE', '%Et%')
                  ->orWhere('name', 'LIKE', '%Kanat%');
            break;
        case 'tatlilar':
            $title = 'Şerbetli ve Sütlü Tatlı Paketleri';
            $query->where(function($q) {
                $q->where('name', 'LIKE', '%Sütlaç%')->orWhere('name', 'LIKE', '%Sütlaç%')
                  ->orWhere('name', 'LIKE', '%Baklava%')->orWhere('name', 'LIKE', '%Keskül%')
                  ->orWhere('name', 'LIKE', '%Kalbur%')
                  ;
            });
            break;
         case 'tatlilar1':
            $title = 'Meyveli ve Çikolatalı Tatlı Paketleri';
            $query->where(function($q) {
                $q->where('name', 'LIKE', '%Sufle%')
                  ->orWhere('name', 'LIKE', '%Brownie%')
                  ->orWhere('name', 'LIKE', '%Tiramisu%')->orWhere('name', 'LIKE', '%Brownie%')
                  ->orWhere('name', 'LIKE', '%Limon%')
                  ->orWhere('name', 'LIKE', '%Elma%')
                  ->orWhere('name', 'LIKE', '%Meyve%');
            });
            break;
             case 'dunya':
            $title = 'Dünya Lezzetleri Paketleri';
            $query->where(function($q) {
                $q->where('name', 'LIKE', '%Mac%')
                  ->orWhere('name', 'LIKE', '%Brownie%')
                  ->orWhere('name', 'LIKE', '%Şinitzel%')->orWhere('name', 'LIKE', '%Brownie%')
                  ->orWhere('name', 'LIKE', '%Sezar%')->orWhere('name', 'LIKE', '%Sufle%')->orWhere('name', 'LIKE', '%Alfredo%')
                  ->orWhere('name', 'LIKE', '%Crumble%')
                  ->orWhere('name', 'LIKE', '%Taco%')
                  ->orWhere('name', 'LIKE', '%Tiramisu%');
            });
            break;
             case 'salata':
            $title = 'Salata Paketleri';
            $query->where(function($q) {
                $q->where('name', 'LIKE', '%Sezar%')
                ->orWhere('name', 'LIKE', '%Salata%')
                  ;
            });
            break;
              case 'balik':
            $title = 'Balık Paketleri';
            $query->where(function($q) {
                $q->where('name', 'LIKE', '%Hamsi%')
                ->orWhere('name', 'LIKE', '%Palamut%')
                  ;
            });
            break;
        case 'makarna-pilav':
            $title = 'Makarna ve Pilav Paketleri';
            $query->where(function($q) {
                $q->where('name', 'LIKE', '%Mac%')->orWhere('name', 'LIKE', '%Pilav%')
                  ->orWhere('name', 'LIKE', '%Noodle%')->orWhere('name', 'LIKE', '%makarna%')->orWhere('name', 'LIKE', '%Fettuccine%');
            });
            break;
        default:
            abort(404); // Tanımsız bir kategori gelirse 404 hatası ver
    }

    $products = $query->paginate(6);

    // Verileri yeni oluşturacağımız bağımsız 'category.blade.php' sayfasına gönderiyoruz
    return view('category', compact('products', 'title'));
}
}
