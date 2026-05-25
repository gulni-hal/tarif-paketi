@extends('layouts.app')
@section('title', 'Profilim')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm text-center p-4">
                
                <img src="{{ asset($user->avatar ? $user->avatar : 'img/core-img/icons8-user-100.png') }}" alt="Profil" class="rounded-circle mx-auto mb-3 shadow" style="width: 150px; height: 150px; object-fit: cover; border: 4px solid #fff; box-shadow: 0 2px 10px rgba(0,0,0,0.1) !important;">
                
                <h4 class="mt-2">{{ $user->name }}</h4>
                <p class="text-muted" style="font-size: 14px;">{{ $user->email }}</p>
                
                @if(isset($user->balance))
                    <h5 style="color: #D34E4E; font-weight: bold;">Cüzdan: {{ $user->balance }} TL</h5>
                @endif
                
                <hr>
                
                <button type="button" class="btn btn-sm btn-outline-danger w-100" data-toggle="modal" data-target="#deactivateModal">
                    <i class="fa fa-power-off"></i> Hesabımı Dondur
                </button>
            </div>
        </div>

        <div class="col-md-8">
            <div class="contact-form-area p-4" style="box-shadow: 0 5px 15px rgba(0,0,0,0.05); border-radius: 15px; background: #fff;">
                <h3 class="mb-4">Bilgilerimi Güncelle</h3>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0" style="padding-left: 20px;">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row">
                        <div class="col-12 mb-4">
                            <label class="font-bold">Profil Resmi Değiştir</label>
                            <div class="custom-file">
                                <input type="file" name="avatar" class="custom-file-input" id="avatar" accept="image/*">
                                <label class="custom-file-label" for="avatar">Resim seçin (max 2MB)...</label>
                            </div>
                            <small class="text-muted">Kare formatında (1:1) resimler daha iyi görünür.</small>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="font-bold">Ad Soyad</label>
                            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="font-bold">E-posta Adresi</label>
                            <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                        </div>
                    </div>

                    @if(Schema::hasColumn('users', 'address'))
                    <div class="form-group mb-3">
                        <label class="font-bold">Açık Adres (Teslimat için kullanılır)</label>
                        <textarea name="address" class="form-control" rows="3">{{ $user->address }}</textarea>
                    </div>
                    @endif

                    <hr class="mt-4 mb-4">
                    <h5 class="mb-3">Şifre Değiştirme (Opsiyonel)</h5>
                    <p class="text-muted" style="font-size: 13px;">Şifrenizi değiştirmek istemiyorsanız buraları boş bırakın.</p>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Yeni Şifre">
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Yeni Şifre (Tekrar)">
                        </div>
                    </div>

                    <button type="submit" class="btn delicious-btn mt-3 w-100">Değişiklikleri Kaydet</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deactivateModal" tabindex="-1" role="dialog" aria-labelledby="deactivateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 12px; overflow: hidden; border: none; box-shadow: 0 5px 25px rgba(0,0,0,0.2);">
            
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deactivateModalLabel">
                    <i class="fa fa-exclamation-triangle"></i> Hesap Dondurma Onayı
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Kapat">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body p-4 text-left">
                <p class="mb-2" style="font-size: 16px; color: #333;">
                    <strong>{{ $user->name }}</strong>, hesabınızı dondurmak istediğinize emin misiniz?
                </p>
                <small class="text-danger">* Bu işlemi onayladığınızda sistemden çıkışınız yapılacaktır. Fikrinizi değiştirirseniz, yönetici ile iletişime geçip yeniden aktifleştirebilirsiniz.</small>
            </div>
            
            <div class="modal-footer bg-light border-0">
                <button type="button" class="btn btn-sm btn-secondary px-3" data-dismiss="modal">Vazgeç</button>
                
                <form action="{{ route('profile.deactivate') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-danger px-4">Evet, Hesabımı Dondur</button>
                </form>
            </div>
            
        </div>
    </div>
</div>
<script>
    document.getElementById('avatar').onchange = function () {
        var fileName = this.value.split("\\").pop();
        this.nextElementSibling.classList.add("selected");
        this.nextElementSibling.innerHTML = fileName;
    };
</script>
@endsection