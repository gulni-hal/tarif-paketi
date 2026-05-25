@extends('layouts.app')
@section('title', 'Ürün Düzenle')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row">
        
        <div class="col-md-3 mb-4">
            <div class="list-group shadow-sm">
                <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action">Özet</a>
                <a href="{{ route('admin.orders') }}" class="list-group-item list-group-item-action">Sipariş Yönetimi</a>
                <a href="{{ route('admin.products') }}" class="list-group-item list-group-item-action active">Ürün Yönetimi</a>
                <a href="{{ route('admin.users') }}" class="list-group-item list-group-item-action">Kullanıcı Yönetimi</a>
                <a href="{{ route('admin.messages') }}" class="list-group-item list-group-item-action">Gelen Mesajlar</a>
            </div>
        </div>

        <div class="col-md-9">
            <div class="card shadow-sm border-0" style="border-radius: 12px;">
                <div class="card-header bg-dark text-white" style="border-radius: 12px 12px 0 0;">
                    <h5 class="mb-0"><i class="fa fa-edit"></i> Ürünü Düzenle: {{ $product->name }}</h5>
                </div>
                
                <div class="card-body p-4">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6 form-group mb-3">
                                <label class="font-weight-bold">Ürün (Tarif) Adı</label>
                                <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
                            </div>
                            
                            <div class="col-md-3 form-group mb-3">
                                <label class="font-weight-bold">Fiyat (TL)</label>
                                <input type="number" step="0.01" name="price" class="form-control" value="{{ $product->price }}" required>
                            </div>

                            <div class="col-md-3 form-group mb-3">
                                <label class="font-weight-bold">Stok Miktarı</label>
                                <input type="number" name="stock" class="form-control" value="{{ $product->stock }}" required>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Kısa Açıklama (Herkese Açık)</label>
                            <textarea name="description" class="form-control" rows="2" required>{{ $product->description }}</textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label class="font-weight-bold text-warning"><i class="fa fa-lock"></i> Kutu İçeriği / Malzemeler (Sadece Alanlar Görür)</label>
                            <textarea name="ingredients" class="form-control" rows="4">{{ $product->ingredients }}</textarea>
                        </div>

                        <div class="form-group mb-4">
                            <label class="font-weight-bold text-success"><i class="fa fa-lock"></i> Şefin Hazırlanış Adımları (Sadece Alanlar Görür)</label>
                            <textarea name="recipe_steps" class="form-control" rows="6">{{ $product->recipe_steps }}</textarea>
                        </div>

                        <div class="form-group mb-4">
                            <label class="font-weight-bold">Ürün Görseli (Değiştirmek istemiyorsanız boş bırakın)</label><br>
                            <img src="{{ asset($product->image_url) }}" alt="Mevcut Görsel" style="width: 100px; border-radius: 8px; margin-bottom: 10px;">
                            <input type="file" name="image" class="form-control-file">
                        </div>

                        <hr>
                        
                        <div class="d-flex flex-column flex-md-row justify-content-between mt-4">
                            <a href="{{ route('admin.products') }}" class="btn btn-secondary px-4 mb-2 mb-md-0">İptal ve Geri Dön</a>
                            <button type="submit" class="btn btn-success px-5">Değişiklikleri Kaydet</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection