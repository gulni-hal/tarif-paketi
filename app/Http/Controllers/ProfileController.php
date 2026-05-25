<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File; // Dosya silme işlemi için gerekli

class ProfileController extends Controller
{
    // Profil sayfasını göster
    public function index()
    {
        $user = Auth::user();
        return view('profile.index', compact('user'));
    }

    // Profil bilgilerini güncelle
    public function update(Request $request)
    {
        $user = Auth::user();

        // 1. Doğrulama (Validation)
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'address' => 'nullable|string',
            // Resim doğrulaması: max 2MB, jpeg,png,jpg
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // 2. Metin Bilgilerini Güncelleme
        $user->name = $request->name;
        $user->email = $request->email;
        $user->address = $request->address;

        // 3. Şifre Güncelleme (Eğer girilmişse)
        if ($request->filled('password')) {
            $request->validate([
                'password' => 'min:6|confirmed'
            ]);
            $user->password = Hash::make($request->password);
        }

        // 4. ================= YENİ: Profil Resmi Yükleme Mantığı =================
        if ($request->hasFile('avatar')) {
            // Eğer kullanıcının eski bir resmi varsa onu klasörden silelim (israfı önlemek için)
            if ($user->avatar && $user->avatar != 'img/avatars/default-person.jpg') {
                $oldImagePath = public_path($user->avatar);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            // Yeni resmi yükle
            $image = $request->file('avatar');
            // Benzersiz bir isim oluştur (örn: 1_1623456789.jpg)
            $imageName = $user->id . '_' . time() . '.' . $image->extension();
            // public/img/avatars/ klasörüne taşı
            $image->move(public_path('img/avatars'), $imageName);
            
            // Veritabanına kaydedilecek yolu ayarla
            $user->avatar = 'img/avatars/' . $imageName;
        }
        // ========================================================================

        $user->save();

        return redirect()->back()->with('success', 'Profil bilgileriniz ve resminiz başarıyla güncellendi.');
    }

    // Hesabı Pasife Alma (Dondurma)
    public function deactivate(Request $request)
    {
        $user = Auth::user();
        $user->is_active = 0; // Hesabı pasif yap
        $user->save();

        Auth::logout(); // Kullanıcıyı sistemden at
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Hesabınız başarıyla dondurulmuştur. Tekrar görüşmek üzere!');
    }
}