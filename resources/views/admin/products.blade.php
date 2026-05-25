@extends('layouts.app')
@section('title', 'Ürün Yönetimi')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-3">
            <div class="list-group">
                <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action">Özet</a>
                <a href="{{ route('admin.orders') }}" class="list-group-item list-group-item-action">Sipariş Yönetimi</a>
                <a href="{{ route('admin.products') }}" class="list-group-item list-group-item-action active">Ürün Yönetimi</a>
                <a href="{{ route('admin.users') }}" class="list-group-item list-group-item-action">Kullanıcı Yönetimi</a>
                <a href="{{ route('admin.messages') }}" class="list-group-item list-group-item-action">Gelen Mesajlar</a>
            </div>
        </div>

        <div class="col-md-9">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3>Ürün Yönetimi</h3>
                <a href="{{ route('admin.product.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Yeni Ürün Ekle</a>
            </div>
            
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif


            <div class="table-responsive shadow-sm" style="border-radius: 10px; background: #fff;">
             <table class="table table-bordered text-center align-middle mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>Görsel</th>
                        <th>Ürün Adı</th>
                        <th>Fiyat</th>
                        <th>Stok</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td class="align-middle">
                            <img src="{{ asset($product->image_url) }}" width="60" style="border-radius:5px; height: 45px; object-fit: cover;">
                        </td>
                        <td class="align-middle text-left font-weight-bold">{{ $product->name }}</td>
                        <td class="align-middle">{{ $product->price }} TL</td>
                        <td class="align-middle">{{ $product->stock }} Adet</td>
                        <td class="align-middle">
                            <div class="d-flex justify-content-center align-items-center">
                                <a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-sm btn-warning text-white mr-2">
                                    <i class="fa fa-edit"></i> Düzenle
                                </a>

                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteProductModal{{ $product->id }}">
                                    <i class="fa fa-trash"></i> Sil
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
</div>

            <div class="d-flex justify-content-center mt-4">
                {{ $products->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>

@foreach($products as $product)
<div class="modal fade" id="deleteProductModal{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $product->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 12px; overflow: hidden; border: none; box-shadow: 0 5px 25px rgba(0,0,0,0.2);">
            
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel{{ $product->id }}">
                    <i class="fa fa-exclamation-triangle"></i> Tarif Kutusu Silme Onayı
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Kapat">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body p-4 text-left">
                <p class="mb-1" style="font-size: 16px; color: #333;">
                    <strong>"{{ $product->name }}"</strong> isimli ürün paketini sistemden kalıcı olarak silmek istediğinize emin misiniz?
                </p>
                <small class="text-danger">* Bu işlem geri alınamaz ve ürüne bağlı geçmiş istatistikleri etkileyebilir.</small>
            </div>
            
            <div class="modal-footer bg-light border-0">
                <button type="button" class="btn btn-sm btn-secondary px-3" data-dismiss="modal">Vazgeç</button>
                
                <form action="{{ route('admin.product.delete', $product->id) }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-danger px-4">Evet, Sil</button>
                </form>
            </div>
            
        </div>
    </div>
</div>
@endforeach

@endsection