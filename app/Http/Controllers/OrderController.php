<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Ödeme Ekranını Göster
    public function checkout()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->withErrors(['Hata' => 'Sepetiniz boş.']);
        }

        $total = 0;
        foreach($cart as $item){
            $total += $item['price'] * $item['quantity'];
        }

        $balance = Auth::user()->balance;
        return view('checkout.index', compact('cart', 'total', 'balance'));
    }

    // Siparişi Veritabanına Kaydet
    public function placeOrder(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index');
        }

        // 1. Toplam Tutarı ve Kullanılacak Bakiyeyi Hesapla
        $total = 0;
        foreach($cart as $item){
            $total += $item['price'] * $item['quantity'];
        }

        $user = Auth::user();
        $used_balance = 0;

        if ($user->balance >= $total) {
            $used_balance = $total;
            $user->balance -= $total; // Cüzdandan düş
        } else {
            $used_balance = $user->balance;
            $user->balance = 0; // Cüzdanı sıfırla, kalanı kredi kartından çekildi varsay
        }
        $user->save();

        // 2. Siparişi (orders) Oluştur - Hocanızın istediği varsayılan 'bekliyor' durumu ile
        $order = Order::create([
            'user_id' => $user->id,
            'total_amount' => $total,
            'used_balance' => $used_balance,
            'status' => 'bekliyor'
        ]);

        // 3. Sipariş Detaylarını (order_items) Oluştur ve Stok Düş
        foreach($cart as $id => $item){
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'quantity' => $item['quantity'],
                'price' => $item['price']
            ]);

            // Stok Güncellemesi
            $product = Product::find($id);
            if($product){
                $product->stock -= $item['quantity'];
                $product->save();
            }
        }

        // 4. Sepeti Temizle
        session()->forget('cart');

        return redirect()->route('orders.index')->with('success', 'Siparişiniz başarıyla alındı ve onay bekliyor!');
    }

    // Siparişlerim Sayfası (Kullanıcının sipariş takibi yapacağı yer)
    public function myOrders()
    {
        // Kullanıcının siparişlerini en yeniden eskiye doğru çekiyoruz
        // $orders = Order::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        $orders =Order::where('user_id', Auth::id())->orderBy('created_at', 'desc')->paginate(10);
        return view('orders.index', compact('orders'));
    }

    // Kullanıcının Siparişi İptal Etmesi
    public function cancelOrder($id)
    {
        $order = Order::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        // Sadece 'bekliyor' (Admin onaylamadıysa) durumunda iptal edilebilir
        if ($order->status == 'bekliyor') {
            $order->status = 'iptal_edildi';
            $order->save();

            // Hocanızın isteri: Toplam tutar kredi kartına değil, cüzdana (bakiye) iade edilir.
            $user = Auth::user();
            $user->balance += $order->total_amount; 
            $user->save();

            // İptal edilen ürünlerin stoğunu geri yükle
            foreach($order->items as $item) {
                $product = Product::find($item->product_id);
                if($product) {
                    $product->stock += $item->quantity;
                    $product->save();
                }
            }

            return redirect()->back()->with('success', 'Sipariş iptal edildi. ' . $order->total_amount . ' TL cüzdanınıza iade edildi.');
        }

        return redirect()->back()->withErrors(['Hata' => 'Bu sipariş onaylandığı için iptal edilemez.']);
    }

    // Kullanıcının "Teslim Aldım" Butonuna Basması
    public function confirmDelivery($id)
    {
        $order = Order::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        // Kargo aşamasına gelmişse teslim aldım diyebilir
        if ($order->status == 'kargoya_verildi') {
            $order->status = 'teslim_edildi';
            $order->save();
            return redirect()->back()->with('success', 'Siparişin teslim alındığı onaylandı. Afiyet olsun!');
        }

        return redirect()->back()->withErrors(['Hata' => 'Bu işlem şu an yapılamaz.']);
    }
}