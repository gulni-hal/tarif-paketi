@extends('layouts.app')
@section('title', 'Kayıt Ol')
@section('content')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="contact-form-area text-center" style="padding: 40px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); border-radius: 15px;">
                <h4 class="mb-4">Yeni Hesap Oluştur</h4>
                
                @if($errors->any())
                    <div class="alert alert-danger text-left" style="font-size: 14px; border-radius: 8px;">
                        <ul class="mb-0" style="padding-left: 20px;">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('register') }}" method="post">
                    @csrf
                    <input type="text" name="name" class="form-control mb-3" placeholder="Adınız Soyadınız" value="{{ old('name') }}" required>
                    
                    <input type="email" name="email" class="form-control mb-3" placeholder="E-posta Adresiniz" value="{{ old('email') }}" required>
                    
                    <input type="password" name="password" class="form-control mb-3" placeholder="Şifreniz (En az 6 karakter)" required>
                    
                    <input type="password" name="password_confirmation" class="form-control mb-3" placeholder="Şifrenizi Tekrar Girin" required>
                    
                    <button type="submit" class="btn delicious-btn mt-2 w-100">Üye Ol</button>
                </form>
                <p class="mt-4">Zaten üye misiniz? <a href="{{ route('login') }}" style="color: #D34E4E;">Giriş Yap</a></p>
            </div>
        </div>
    </div>
</div>
@endsection