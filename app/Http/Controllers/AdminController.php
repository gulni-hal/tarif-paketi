<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Admin Ana Sayfası
   public function index()
    {
        // 1. Kartlar için genel toplamlar
        $totalOrders = \App\Models\Order::count();
        $totalUsers = \App\Models\User::count();
        $totalProducts = \App\Models\Product::count();

        // 2. GRAFİKLER İÇİN SON 7 GÜNÜN HESAPLANMASI
        $chartDates = [];
        $userCounts = [];
        $reviewCounts = [];
        $messageCounts = [];

        // Geriye doğru 7 günü döngüyle alıyoruz
        for ($i = 6; $i >= 0; $i--) {
            $date = \Carbon\Carbon::now()->subDays($i)->format('Y-m-d');
            $displayDate = \Carbon\Carbon::now()->subDays($i)->format('d.m.Y'); // Örn: 25.05.2026
            
            $chartDates[] = $displayDate;
            
            // O güne ait veritabanı kayıt sayılarını çekiyoruz
            $userCounts[] = \App\Models\User::whereDate('created_at', $date)->count();
            
            // Not: Yorum modelinizin adı Review değilse burayı kendi modelinize göre düzeltin
            $reviewCounts[] = \App\Models\Review::whereDate('created_at', $date)->count(); 
            
            $messageCounts[] = \App\Models\ContactMessage::whereDate('created_at', $date)->count();
            
        }

        // 3. EN ÖNEMLİ KISIM: Verileri Blade dosyasına gönderiyoruz
        return view('admin.dashboard', compact(
            'totalOrders', 'totalUsers', 'totalProducts',
            'chartDates', 'userCounts', 'reviewCounts', 'messageCounts'
        ));
    }

    // Siparişleri Listeleme
    public function orders()
    {
        // Eski kod: $orders = Order::all(); veya Order::get();
        // Yeni kod: get() yerine paginate(10) kullanıyoruz
        $orders = \App\Models\Order::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.orders', compact('orders'));
    }

    // Hocanızın İsteri: Durumu İleri İleri İlerletme Algoritması
    public function advanceOrderStatus($id)
    {
        $order = Order::findOrFail($id);

        // Sıralı durumlar dizisi
        $statuses = [
            'bekliyor', 
            'onaylandi', 
            'tedarik_ediliyor', 
            'kutulaniyor', 
            'kargoya_verildi', 
            'teslim_edildi'
        ];

        // Mevcut durumun dizideki sırasını (index) bul
        $currentIndex = array_search($order->status, $statuses);

        // Eğer son aşamadan (veya iptalden) önceyse bir sonraki aşamaya geçir
        if ($currentIndex !== false && $currentIndex < 4) { // 4 = kargoya_verildi (teslimi kullanıcı yapacak)
            $order->status = $statuses[$currentIndex + 1];
            $order->save();
            return redirect()->back()->with('success', 'Sipariş durumu başarıyla güncellendi: ' . ucfirst($order->status));
        }

        return redirect()->back()->withErrors(['Hata' => 'Sipariş durumu daha fazla ilerletilemez.']);
    }

    // Ürünleri Listeleme
  public function products()
    {
        // Eski kod: $products = Product::all(); veya Product::get();
        $products = \App\Models\Product::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.products', compact('products'));
    }

    // Yeni Ürün Ekleme Sayfasını Gösterme
    public function createProduct()
    {
        return view('admin.product_form');
    }

    // Yeni Ürünü ve Fotoğrafı Veritabanına Kaydetme
    public function storeProduct(Request $request)
    {
        // Gelen verileri doğrula
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048' // Max 2MB Resim
        ]);

        // Resim dosyasını temanızın bulunduğu img/bg-img klasörüne yükle
        $imageName = time() . '.' . $request->image->extension();  
        $request->image->move(public_path('img/bg-img'), $imageName);
        $imageUrl = 'img/bg-img/' . $imageName;

        // Ürünü veritabanına yaz
        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image_url' => $imageUrl,
            'is_published' => 1
        ]);

        return redirect()->route('admin.products')->with('success', 'Yeni tarif kutusu başarıyla eklendi.');
    }

    // Ürün Silme
    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->back()->with('success', 'Ürün başarıyla silindi.');
    }

    // Kullanıcıları Listeleme
    public function users()
    {
        // Tüm kullanıcıları en yeniden eskiye doğru çek
        // $users = User::orderBy('created_at', 'desc')->get();
        // Eski kod: $products = Product::all(); veya Product::get();
        $users = \App\Models\User::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.users', compact('users'));
    }

    // Kullanıcı Durumunu Değiştirme (Dondurma / Aktifleştirme)
    public function toggleUserStatus($id)
    {
        $user = User::findOrFail($id);
        
        // Admin'in kendi kendini dondurmasını engelle
        if ($user->id === Auth::id()) {
            return redirect()->back()->withErrors(['Hata' => 'Kendi hesabınızı donduramazsınız.']);
        }

        $user->is_active = !$user->is_active; // Durumu tersine çevir (1 ise 0, 0 ise 1 yap)
        $user->save();

        $durum = $user->is_active ? 'aktifleştirildi' : 'donduruldu';
        return redirect()->back()->with('success', "Kullanıcı hesabı başarıyla $durum.");
    }

    // Kullanıcı Silme
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        
        // Admin'in kendi kendini silmesini engelle
        if ($user->id === Auth::id()) {
            return redirect()->back()->withErrors(['Hata' => 'Kendi hesabınızı silemezsiniz.']);
        }

        $user->delete();
        return redirect()->back()->with('success', 'Kullanıcı ve ona ait veriler başarıyla silindi.');
    }

    // Adminin Ürün Yorumlarını Silmesi
    public function deleteReview($id)
    {
        $review = \App\Models\Review::findOrFail($id);
        $review->delete();

        return redirect()->back()->with('success', 'Kullanıcı yorumu başarıyla silindi.');
    }

    // Gelen Mesajları Listeleme
    public function messages()
    {
        // $messages = \App\Models\ContactMessage::orderBy('created_at', 'desc')->get();
        $messages = \App\Models\ContactMessage::orderBy('created_at', 'desc')->paginate(3);
        return view('admin.messages', compact('messages'));
    }

    // Mesajı Silme
    public function deleteMessage($id)
    {
        $message = \App\Models\ContactMessage::findOrFail($id);
        $message->delete();
        return redirect()->back()->with('success', 'Mesaj başarıyla silindi.');
    }

    // Ürün Düzenleme Sayfasını Göster
    public function editProduct($id)
    {
        $product = \App\Models\Product::findOrFail($id);
        return view('admin.product_edit', compact('product'));
    }

    // Ürün Güncelleme İşlemini Veritabanına Kaydet
    public function updateProduct(Request $request, $id)
    {
        $product = \App\Models\Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'description' => 'required|string',
            'ingredients' => 'nullable|string',
            'recipe_steps' => 'nullable|string',
        ]);

        $product->name = $request->name;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->description = $request->description;
        $product->ingredients = $request->ingredients;
        $product->recipe_steps = $request->recipe_steps;

        // Görsel güncelleme işlemi yapıldıysa
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('img/bg-img'), $imageName);
            $product->image_url = 'img/bg-img/' . $imageName;
        }

        $product->save();

        return redirect()->route('admin.products')->with('success', 'Ürün (Kutu) başarıyla güncellendi.');
    }
}