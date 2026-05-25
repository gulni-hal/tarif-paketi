@extends('layouts.app')
@section('title', 'Sipariş Yönetimi')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="list-group shadow-sm">
                <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action">Özet</a>
                <a href="{{ route('admin.orders') }}" class="list-group-item list-group-item-action active">Sipariş Yönetimi</a>
                <a href="{{ route('admin.products') }}" class="list-group-item list-group-item-action">Ürün Yönetimi</a>
                <a href="{{ route('admin.users') }}" class="list-group-item list-group-item-action">Kullanıcı Yönetimi</a>
                <a href="{{ route('admin.messages') }}" class="list-group-item list-group-item-action">Gelen Mesajlar</a>
            </div>
        </div>
        
        <div class="col-md-9">
            <h3 class="mb-4">Tüm Siparişler</h3>
            
            <div class="table-responsive shadow-sm" style="border-radius: 10px; background: #fff;">
                <table class="table table-bordered text-center align-middle mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Sipariş No</th>
                            <th>Kullanıcı (Müşteri)</th>
                            <th>Tutar</th>
                            <th>Durum</th>
                            <th>İşlem (Durum İlerlet)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td class="align-middle">#{{ $order->id + 1000 }}</td>
                            <td class="align-middle">Kullanıcı ID: {{ $order->user_id }}</td>
                            <td class="align-middle font-weight-bold" style="color: #D34E4E;">{{ $order->total_amount }} TL</td>
                            <td class="align-middle">
                                @if($order->status == 'bekliyor') <span class="badge badge-warning px-3 py-2">Onay Bekliyor</span>
                                @elseif($order->status == 'onaylandi') <span class="badge badge-info px-3 py-2">Onaylandı</span>
                                @elseif($order->status == 'tedarik_ediliyor') <span class="badge badge-secondary px-3 py-2">Tedarik Ediliyor</span>
                                @elseif($order->status == 'kutulaniyor') <span class="badge badge-primary px-3 py-2">Kutulanıyor</span>
                                @elseif($order->status == 'kargoya_verildi') <span class="badge badge-dark px-3 py-2">Kargoya Verildi</span>
                                @elseif($order->status == 'teslim_edildi') <span class="badge badge-success px-3 py-2">Teslim Edildi</span>
                                @elseif($order->status == 'iptal_edildi') <span class="badge badge-danger px-3 py-2">İptal Edildi</span>
                                @endif
                            </td>
                            <td class="align-middle">
                                @if(!in_array($order->status, ['kargoya_verildi', 'teslim_edildi', 'iptal_edildi']))
                                    <form action="{{ route('admin.order.advance', $order->id) }}" method="POST" class="m-0">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">Süreci İlerlet <i class="fa fa-arrow-right ml-1"></i></button>
                                    </form>
                                @else
                                    <span class="text-muted" style="font-size: 13px;">İşlem Yok</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="d-flex justify-content-center mt-4">
                {{ $orders->links('pagination::bootstrap-4') }}
            </div>

        </div>
    </div>
</div>
@endsection