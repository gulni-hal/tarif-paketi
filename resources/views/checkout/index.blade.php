@extends('layouts.app')
@section('title', 'Ödeme ve Onay')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-8">
            <h3 class="mb-4" style="color: #4b4b4b;">Teslimat ve Ödeme Bilgileri</h3>
            <div class="contact-form-area p-4" style="background-color: #fff; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.05);">
                <form action="{{ route('order.place') }}" method="POST">
                    @csrf
                    
                    <h5 class="mb-3" style="color: #4b4b4b;"><i class="fa fa-map-marker" style="color: #D34E4E;"></i> Teslimat Adresi</h5>
                    <textarea name="address" class="form-control mb-4" rows="4" placeholder="Açık adresinizi giriniz..." style="border-radius: 10px;" required>{{ Auth::user()->address }}</textarea>

                    @if($balance < $total)
                        <div class="payment-card-details p-4 mb-4" style="background-color: #f8f9fa; border-radius: 15px; border: 1px solid #e9ecef;">
                            <h5 class="mb-3" style="color: #4b4b4b;"><i class="fa fa-credit-card" style="color: #D34E4E;"></i> Kredi Kartı Bilgileri</h5>
                            
                            <div class="alert alert-info mb-4" style="font-size: 14px; border-radius: 10px;">
                                <i class="fa fa-info-circle"></i> Cüzdan bakiyeniz yetersiz olduğu için kalan <strong>{{ $total - $balance }} TL</strong> kredi kartınızdan tahsil edilecektir.
                            </div>
                            
                            <div class="form-group mb-3">
                                <label class="font-weight-bold text-muted" style="font-size: 12px; letter-spacing: 1px;">KART ÜZERİNDEKİ İSİM</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-white" style="border-radius: 10px 0 0 10px; border-right: none;"><i class="fa fa-user text-muted"></i></span>
                                    </div>
                                    <input type="text" class="form-control border-left-0" style="border-radius: 0 10px 10px 0; background-color: #fff;" placeholder="Ad Soyad" required>
                                </div>
                            </div>
                            
                            <div class="form-group mb-4">
                                <label class="font-weight-bold text-muted" style="font-size: 12px; letter-spacing: 1px;">KART NUMARASI</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-white" style="border-radius: 10px 0 0 10px; border-right: none;"><i class="fa fa-credit-card text-muted"></i></span>
                                    </div>
                                    <input type="text" class="form-control border-left-0" style="border-radius: 0 10px 10px 0; background-color: #fff;" placeholder="0000 0000 0000 0000" maxlength="16" pattern="\d{16}" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-sm-6 form-group mb-3 mb-sm-0">
                                    <label class="font-weight-bold text-muted" style="font-size: 12px; letter-spacing: 1px;">SON KULLANMA TARİHİ</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-white" style="border-radius: 10px 0 0 10px; border-right: none;"><i class="fa fa-calendar text-muted"></i></span>
                                        </div>
<input 
    type="text" 
    class="form-control border-left-0"
    style="border-radius: 0 10px 10px 0; background-color: #fff;"
    placeholder="AA/YY"
    maxlength="5"
    pattern="^(0[1-9]|1[0-2])\/\d{2}$"
    oninput="
        this.value = this.value.replace(/\D/g, '');
        
        if(this.value.length >= 2){
            let month = this.value.substring(0,2);

            if(parseInt(month) > 12){
                month = '12';
            }

            if(parseInt(month) < 1){
                month = '01';
            }

            this.value = month + '/' + this.value.substring(2,4);
        }
    "
    required
>                                    </div>
                                </div>
                                <div class="col-sm-6 form-group mb-0">
                                    <label class="font-weight-bold text-muted" style="font-size: 12px; letter-spacing: 1px;">GÜVENLİK KODU (CVV)</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-white" style="border-radius: 10px 0 0 10px; border-right: none;"><i class="fa fa-lock text-muted"></i></span>
                                        </div>
                                        <input type="password" class="form-control border-left-0" style="border-radius: 0 10px 10px 0; background-color: #fff;" placeholder="&#9679;&#9679;&#9679;" maxlength="3" pattern="\d{3}" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="alert alert-success" style="border-radius: 10px;">
                            <i class="fa fa-check-circle"></i> Sipariş tutarının tamamı ({{ $total }} TL) cüzdan bakiyenizden karşılanacaktır. Kredi kartı bilgisi girmenize gerek yoktur.
                        </div>
                    @endif

                    <button type="submit" class="btn delicious-btn w-100 py-3 mt-2" style="font-size: 18px; border-radius: 10px; font-weight: bold;">
                        Siparişi Onayla ve Bitir <i class="fa fa-angle-right ml-2"></i>
                    </button>
                </form>
            </div>
        </div>

        <div class="col-md-4 mt-4 mt-md-0">
            <div class="card shadow-sm border-0" style="border-radius: 15px; position: sticky; top: 20px;">
                <div class="card-body p-4">
                    <h5 class="card-title mb-4" style="color: #4b4b4b;"><i class="fa fa-shopping-basket" style="color: #D34E4E;"></i> Sepet Özeti</h5>
                    
                    @foreach($cart as $item)
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div style="line-height: 1.2;">
                                <span class="d-block font-weight-bold" style="font-size: 15px; color: #4b4b4b;">{{ $item['name'] }}</span>
                                <small class="text-muted">Adet: {{ $item['quantity'] }}</small>
                            </div>
                            <span class="font-weight-bold text-dark">{{ $item['price'] * $item['quantity'] }} TL</span>
                        </div>
                        <hr class="my-2">
                    @endforeach
                    
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <h6 class="mb-0 font-weight-bold" style="color: #4b4b4b;">Genel Toplam:</h6>
                        <h5 class="mb-0 font-weight-bold" style="color: #D34E4E;">{{ $total }} TL</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection