<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Giriş sayfasını gösterir
    public function showLogin() {
        return view('auth.login');
    }

    // Giriş işlemini yapar
    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            // Hesap aktif mi kontrol et
            if (Auth::user()->is_active == 0) {
                Auth::logout();
                return back()->withErrors(['email' => 'Hesabınız dondurulmuştur. Lütfen yönetici ile iletişime geçin.']);
            }

            $request->session()->regenerate();
            return redirect('/');
        }

        return back()->withErrors(['email' => 'E-posta veya şifre hatalı.']);
    }

    // Kayıt sayfasını gösterir
    public function showRegister() {
        return view('auth.register');
    }

    // Yeni kullanıcı kaydını veritabanına ekler
  public function register(Request $request)
{
    // 1. KONTROL AŞAMASI (VALIDATION)
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email', // unique:users,email kısmı "bu e-posta daha önce kullanıldı mı?" kontrolünü yapar.
        'password' => 'required|string|min:6|confirmed', // min:6 (en az 6 karakter) ve confirmed (şifreler eşleşiyor mu?) kontrolü.
    ], [
        // 2. ÖZEL TÜRKÇE HATA MESAJLARI
        'email.unique' => 'Bu e-posta adresine ait bir kullanıcı zaten bulunmaktadır.',
        'password.min' => 'Şifreniz en az 6 karakter uzunluğunda olmalıdır.',
        'password.confirmed' => 'Girdiğiniz şifreler birbiriyle eşleşmiyor. Lütfen kontrol edin.',
        'email.email' => 'Lütfen geçerli bir e-posta adresi girin.'
    ]);

    // Eğer kod buraya ulaştıysa kontrollerden başarıyla geçmiş demektir. Kayıt işlemini yapabilirsiniz:
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        // 'role' => 'user', // Eğer rolleriniz varsa
        // 'balance' => 0, // Eğer cüzdan bakiyesi varsa
    ]);

    // Kayıt sonrası otomatik giriş yaptırıp ana sayfaya veya login sayfasına yönlendirebilirsiniz
    auth()->login($user);

    return redirect('/')->with('success', 'Hesabınız başarıyla oluşturuldu!');
}

// Şifremi Unuttum İşlemi
    public function forgotPassword(\Illuminate\Http\Request $request)
    {
        // 1. Veritabanı Kontrolü (Böyle bir mail var mı?)
        $request->validate([
            // exists:users,email kısmı "users tablosunun email sütununda bu veri var mı?" diye bakar.
            'reset_email' => 'required|email|exists:users,email',
        ], [
            // Eğer veritabanında bulunamazsa gösterilecek Türkçe hata mesajı
            'reset_email.exists' => 'Sistemimizde bu e-posta adresine ait bir kullanıcı bulunamadı.',
        ]);

        // Gerçek bir projede burada Mail::to($request->reset_email)->send(...) ile e-posta gönderimi yapılır.
        // Şimdilik biz sadece veritabanı kontrolünü geçip başarılı senaryoyu simüle ediyoruz:
        
        return redirect()->back()->with('success', 'Şifre sıfırlama bağlantısı e-posta adresinize başarıyla gönderildi! Lütfen gelen kutunuzu kontrol edin.');
    }

    // Çıkış işlemini yapar
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}