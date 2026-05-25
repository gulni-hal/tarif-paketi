<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, $productId)
    {
        // Kullanıcı giriş yapmamışsa direkt login sayfasına yönlendir
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors(['email' => 'Yorum yapabilmek için önce oturum açmalısınız.']);
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        // Hocanızın isteri: Kullanıcı bu paketi gerçekten satın almış mı kontrol et (İptal edilenler hariç)
        $hasPurchased = Order::where('user_id', Auth::id())
            ->where('status', '!=', 'iptal_edildi')
            ->whereHas('items', function($query) use ($productId) {
                $query->where('product_id', $productId);
            })->exists();

        if (!$hasPurchased) {
            return redirect()->back()->withErrors(['Hata' => 'Yalnızca bu malzeme kutusunu satın almış olan kullanıcılar yorum bırakabilir.']);
        }

        // Yorum kaydet
        Review::create([
            'user_id' => Auth::id(),
            'product_id' => $productId,
            'rating' => $request->rating,
            'comment' => $request->comment
        ]);

        return redirect()->back()->with('success', 'Yorumunuz ve puanınız başarıyla yayınlandı!');
    }}
