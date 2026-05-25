@extends('layouts.app')
@section('title', 'Yeni Ürün Ekle')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8">
            <div class="contact-form-area" style="padding: 30px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); border-radius: 15px; background: #fff;">
                <h3 class="mb-4">Yeni Tarif Kutusu Ekle</h3>
                
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0" style="padding-left: 20px;">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="form-group mb-3">
                        <label class="font-weight-bold">Ürün / Kutu Adı</label>
                        <input type="text" name="name" class="form-control" placeholder="Örn: Zeytinyağlı Yaprak Sarma Kutusu" required>
                    </div>

                    <div class="form-group mb-3">
                        <label class="font-weight-bold">Kısa Açıklama (Herkese Açık Özet)</label>
                        <textarea name="description" class="form-control" rows="2" placeholder="Sitede herkesin göreceği kısa tanıtım metni..." required></textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label class="font-weight-bold text-warning"><i class="fa fa-lock"></i> Kutu İçeriği / Malzemeler (Sadece Alanlar Görür)</label>
                        <textarea name="ingredients" class="form-control" rows="4" placeholder="Kutudan çıkacak malzemeleri alt alta yazın..."></textarea>
                    </div>

                    <div class="form-group mb-4">
                        <label class="font-weight-bold text-success"><i class="fa fa-lock"></i> Şefin Hazırlanış Adımları (Sadece Alanlar Görür)</label>
                        <textarea name="recipe_steps" class="form-control" rows="5" placeholder="1. Adım: ...&#10;2. Adım: ..."></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="font-weight-bold">Satış Fiyatı (TL)</label>
                            <input type="number" step="0.01" name="price" class="form-control" placeholder="Örn: 120.50" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="font-weight-bold">Stok Adeti</label>
                            <input type="number" name="stock" class="form-control" placeholder="Örn: 50" required>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label class="font-weight-bold">Ürün Fotoğrafı Yükle</label><br>
                        <input type="file" name="image" class="form-control-file" accept="image/*" required>
                    </div>

                    <hr>
                    <div class="d-flex flex-column flex-md-row justify-content-between mt-4">
                        <a href="{{ route('admin.products') }}" class="btn btn-secondary px-4 mb-2 mb-md-0">İptal ve Geri Dön</a>
                        <button type="submit" class="btn btn-success px-5">Ürünü Kaydet ve Satışa Sun</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection