@extends('layouts.app')
@section('title', 'Sepetim')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4">Sepetim</h2>
            
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger">{{ $errors->first() }}</div>
            @endif

            @if(count($cart) > 0)
                
                <div class="table-responsive shadow-sm" style="border-radius: 10px; background: #fff;">
                    <table class="table table-bordered text-center align-middle mb-0">
                        <thead style="background-color: #f8f9fa;">
                            <tr>
                                <th>Ürün</th>
                                <th>Adet</th>
                                <th>Fiyat</th>
                                <th>Toplam</th>
                                <th>İşlem</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cart as $id => $details)
                            <tr>
                                <td class="text-left align-middle" style="min-width: 200px;">
                                    <img src="{{ asset($details['image']) }}" width="50" height="50" class="mr-2" style="border-radius: 5px; object-fit: cover;">
                                    <strong>{{ $details['name'] }}</strong>
                                </td>
                                
                                <td class="align-middle" style="width: 150px; min-width: 150px;">
                                    <div class="d-flex justify-content-center align-items-center">
                                        
                                        <form action="{{ route('cart.decrease', $id) }}" method="POST" class="m-0">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-secondary" style="border-radius: 5px 0 0 5px;" title="Azalt">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </form>

                                        <span class="px-3 py-1 border-top border-bottom" style="min-width: 45px; text-align: center; background-color: #fff; font-weight: bold;">
                                            {{ $details['quantity'] }}
                                        </span>

                                        <form action="{{ route('cart.increase', $id) }}" method="POST" class="m-0">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-secondary" style="border-radius: 0 5px 5px 0;" title="Artır">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </form>
                                        
                                    </div>
                                </td>

                                <td class="align-middle" style="min-width: 100px;">{{ $details['price'] }} TL</td>
                                <td class="align-middle font-weight-bold" style="color: #D34E4E; min-width: 120px;">{{ $details['price'] * $details['quantity'] }} TL</td>
                                <td class="align-middle">
                                    <form action="{{ route('cart.remove', $id) }}" method="POST" class="m-0">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Sil</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="row mt-4">
                    <div class="col-12 col-md-6 offset-md-6">
                        <div class="card shadow-sm border-0" style="border-radius: 15px;">
                            <div class="card-body p-4">
                                <h5>Sipariş Özeti</h5>
                                <hr>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Sepet Tutarı:</span>
                                    <span>{{ $total }} TL</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Cüzdan Bakiyeniz:</span>
                                    <span>{{ $balance }} TL</span>
                                </div>
                                <hr>
                                @if($balance >= $total)
                                    <p class="text-success mb-1" style="font-size: 14px;"><i class="fa fa-check-circle"></i> Siparişin tamamı cüzdan bakiyenizden karşılanacaktır.</p>
                                    <div class="d-flex justify-content-between mt-3">
                                        <span class="font-weight-bold h5">Ödenecek Tutar:</span>
                                        <span class="font-weight-bold h5" style="color: #D34E4E;">0.00 TL</span>
                                    </div>
                                @else
                                    <p class="text-danger mb-1" style="font-size: 14px;"><i class="fa fa-exclamation-triangle"></i> Cüzdan bakiyeniz yetersiz. Kalan tutar kredi kartınızdan çekilecektir.</p>
                                    <div class="d-flex justify-content-between mt-3">
                                        <span class="font-weight-bold h6">Kredi Kartından Çekilecek:</span>
                                        <span class="font-weight-bold h6" style="color: #D34E4E;">{{ $total - $balance }} TL</span>
                                    </div>
                                @endif
                                
                               <a href="{{ route('checkout') }}" class="btn delicious-btn w-100 mt-4">Ödeme Adımına Geç</a>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="alert alert-info text-center py-5">
                    <i class="fa fa-shopping-basket fa-3x mb-3" style="color: #ccc;"></i><br>
                    Sepetinizde henüz ürün bulunmuyor. <br><br>
                    <a href="/#kutular" class="btn delicious-btn btn-sm mt-2 px-4">Alışverişe Başla</a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection