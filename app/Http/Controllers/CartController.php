<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Sepete Ürün Ekleme
    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        // Eğer stok yoksa ekletme
        if ($product->stock < 1) {
            return redirect()->back()->withErrors(['Hata' => 'Bu ürün stokta kalmamıştır.']);
        }

        $cart = session()->get('cart', []);

        // Ürün sepette zaten varsa sayısını artır, yoksa yeni ekle
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image_url
            ];
        }

        session()->put('cart', $cart);
        return redirect()->route('cart.index')->with('success', 'Ürün sepete eklendi!');
    }

    // Sepetteki Ürünün Miktarını Artırma
    public function increase($id)
    {
        $cart = session()->get('cart');
        
        if(isset($cart[$id])) {
            $product = \App\Models\Product::find($id);
            
            // Veritabanındaki stok, sepettekinden fazlaysa artırmaya izin ver
            if($product && $product->stock > $cart[$id]['quantity']) {
                $cart[$id]['quantity']++;
                session()->put('cart', $cart);
                return redirect()->back()->with('success', 'Ürün miktarı artırıldı.');
            }
            
            return redirect()->back()->withErrors(['Hata' => 'Maalesef bu üründen stoklarımızda daha fazla kalmadı.']);
        }
        return redirect()->back();
    }

    // Sepetteki Ürünün Miktarını Azaltma
    public function decrease($id)
    {
        $cart = session()->get('cart');
        
        if(isset($cart[$id])) {
            // Eğer miktar 1'den büyükse sadece eksilt
            if($cart[$id]['quantity'] > 1) {
                $cart[$id]['quantity']--;
                session()->put('cart', $cart);
                return redirect()->back()->with('success', 'Ürün miktarı azaltıldı.');
            } else {
                // Eğer miktar 1 ise ve tekrar '-' butonuna basıldıysa ürünü tamamen sepetten çıkar
                unset($cart[$id]);
                session()->put('cart', $cart);
                return redirect()->back()->with('success', 'Ürün sepetinizden tamamen çıkarıldı.');
            }
        }
        return redirect()->back();
    }

    // Sepet Sayfasını Görüntüleme
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        
        foreach($cart as $item){
            $total += $item['price'] * $item['quantity'];
        }

        // Kullanıcının cüzdanındaki para
        $balance = Auth::user()->balance;

        return view('cart.index', compact('cart', 'total', 'balance'));
    }

    // Sepetten Ürün Silme
    public function remove($id)
    {
        $cart = session()->get('cart');
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Ürün sepetten çıkarıldı.');
    }
}