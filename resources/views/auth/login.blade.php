@extends('layouts.app')
@section('title', 'Giriş Yap')
@section('content')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="contact-form-area text-center" style="padding: 40px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); border-radius: 15px; background: #fff;">
                <h4 class="mb-4">Oturum Aç</h4>
                
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0" style="padding-left: 20px; text-align: left;">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <input type="email" name="email" class="form-control mb-3" placeholder="E-posta Adresiniz" required>
                    <input type="password" name="password" class="form-control mb-3" placeholder="Şifreniz" required>
                    
                    <button type="submit" class="btn delicious-btn mt-2 w-100">Giriş Yap</button>
                </form>
                
                <div class="d-flex justify-content-between mt-3 px-2">
                    <p class="mb-0 text-left" style="font-size: 14px;">Hesabınız yok mu? <a href="{{ route('register') }}" style="color: #D34E4E; font-weight: bold;">Kayıt Ol</a></p>
                    
                    <a href="#" data-toggle="modal" data-target="#forgotPasswordModal" style="color: #4b4b4b; font-size: 14px; text-decoration: underline;">Şifremi Unuttum</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="forgotPasswordModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 15px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
            <div class="modal-header" style="background-color: #f8f9fa; border-bottom: none; padding-top: 25px; padding-bottom: 0;">
                <h5 class="modal-title w-100 text-center" style="color: #4b4b4b;"><i class="fa fa-envelope" style="color: #D34E4E;"></i> Şifremi Unuttum</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; right: 20px;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4 text-center">
                <p class="text-muted mb-4" style="font-size: 14px;">Kayıtlı e-posta adresinizi girin. Şifrenizi sıfırlamanız için size bir bağlantı göndereceğiz.</p>
                
                <form action="{{ route('password.forgot.post') }}" method="POST">
                    @csrf
                    <input type="email" name="reset_email" class="form-control mb-3" placeholder="E-posta Adresinizi Yazın..." required>
                    <button type="submit" class="btn delicious-btn w-100">Şifre Sıfırlama Maili Gönder</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection