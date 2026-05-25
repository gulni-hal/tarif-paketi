@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="receipe-post-area section-padding-80">

    <div class="receipe-post-search mb-80">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <img src="{{ asset($product->image_url ? $product->image_url : 'img/bg-img/bg1.jpg') }}" alt="{{ $product->name }}" style="width: 100%; max-height: 500px; object-fit: cover; border-radius: 15px;">
                </div>
            </div>
        </div>
    </div>

    <div class="receipe-content-area">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-8">
                    <div class="receipe-headline my-5">
                        <span>Fiyat: {{ $product->price }} TL</span>
                        <h2>{{ $product->name }}</h2>
                        <div class="receipe-duration">
                            <h6>Stok Durumu: {{ $product->stock > 0 ? $product->stock . ' Adet Kutu Kaldı' : 'Tükendi' }}</h6>
                        </div>
                    </div>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success col-12">{{ session('success') }}</div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger col-12">{{ $errors->first() }}</div>
            @endif

            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="single-preparation-step d-flex mb-4">
                        <p class="ml-3">{{ $product->description }}</p>
                    </div>

                    <div class="locked-content mt-5 p-5 text-center mb-5" style="background-color: #f8f9fa; border: 2px dashed #D34E4E; border-radius: 15px;">
                        <i class="fa fa-lock fa-3x mb-3" style="color: #D34E4E;"></i>
                        <h4 style="color: #4b4b4b;">Tarifin Devamı ve Hazırlanış Detayları Kilitli</h4>
                        <p>Bu lezzetin adım adım hazırlanış sırlarını görmek ve yemeği yapmak için gereken tüm malzemelerin tam ölçüsüyle kapınıza gelmesi için kutuyu satın almalısınız!</p>
                        
                        @if($product->stock > 0)
                            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn delicious-btn mt-3">Kutuyu Sepete Ekle - {{ $product->price }} TL</button>
                            </form>
                        @else
                            <button class="btn btn-secondary mt-3" disabled>Stokta Yok</button>
                        @endif
                    </div>
                   
                    <div class="col-12 p-0 mt-5">
                        <h3 class="admin-heading" style="border-bottom: 2px solid #CE7E5A; padding-bottom: 10px; margin-bottom: 30px; color: #474747;">
                            Tarif Hakkında Yorumlar ({{ $product->reviews->count() }})
                        </h3>
                        
                        @forelse($product->reviews as $review)
                            <div class="comment-card p-4 mb-4" style="background-color: #ffffff; border: 1px solid #f3f5f8; border-radius: 4px; box-shadow: 0 0 5px rgba(0, 0, 0, 0.05);">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h5 style="font-size: 16px; font-weight: 600; color: #474747; margin: 0;">{{ $review->user->name }}</h5>
                                    <div class="ratings">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $review->rating)
                                                <i class="fa fa-star" style="color: #fbb710;"></i>
                                            @else
                                                <i class="fa fa-star-o" style="color: #fbb710;"></i>
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                                <p style="font-size: 14px; color: #9b9b9b; line-height: 1.6; margin-bottom: 0;">
                                    {{ $review->comment }}
                                </p>
                                
                                <div class="d-flex justify-content-between align-items-end mt-2">
                                    <small class="text-muted" style="font-size: 11px;">{{ $review->created_at->format('d.m.Y') }}</small>
                                    
                                    @if(auth()->check() && auth()->user()->role === 'admin')
                                        <button type="button" class="btn btn-sm btn-outline-danger" style="padding: 2px 8px; font-size: 12px;" data-toggle="modal" data-target="#deleteReviewModal{{ $review->id }}" title="Admin Olarak Yorumu Sil">
                                            <i class="fa fa-trash"></i> Sil
                                        </button>
                                    @endif
                                </div>

                            </div>
                        @empty
                            <p class="text-muted mb-4">Bu paket kutusu için henüz yorum yapılmamış. İlk yorumu siz yapın!</p>
                        @endforelse
                    </div>

                    <div class="col-12 p-0 mt-4">
                        @auth
                            @if($hasPurchased)
                               <div class="contact-form-area p-4 mt-4" style="background: #f8f9fa; border-radius: 12px; border: 1px solid #e9ecef; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
                                    <h5 class="mb-4" style="font-weight: 600; color: #333;">
                                        <i class="fa fa-star mr-2" style="color: #D34E4E;"></i> Yorum ve Puan Bırakın
                                    </h5>
                                    <form action="{{ route('review.store', $product->id) }}" method="POST">
                                        @csrf
                                        <div class="form-group mb-4">
                                            <label for="rating" style="font-weight: 600; margin-bottom: 8px; display: block; color: #444;">Tarife Puanınız</label>
                                            <select name="rating" id="rating" class="form-control" style="max-width: 220px; border-radius: 8px; height: 45px;" required>
                                                <option value="5">⭐⭐⭐⭐⭐ (5 / 5)</option>
                                                <option value="4">⭐⭐⭐⭐ (4 / 5)</option>
                                                <option value="3">⭐⭐⭐ (3 / 5)</option>
                                                <option value="2">⭐⭐ (2 / 5)</option>
                                                <option value="1">⭐ (1 / 5)</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="comment" style="font-weight: 600; margin-bottom: 8px; display: block; color: #444;">Yorumunuz</label>
                                            <textarea name="comment" id="comment" rows="5" class="form-control" placeholder="Deneyiminizi ve fikirlerinizi buraya yazın..." style="border-radius: 10px; resize: none; padding: 12px;" required></textarea>
                                        </div>
                                        <button type="submit" class="btn delicious-btn" style="border-radius: 8px; padding: 10px 24px; font-weight: 600;">Yorumu Gönder</button>
                                    </form>
                                </div>
                            @else
                                <div class="alert alert-info">
                                    <i class="fa fa-info-circle"></i> Sadece bu yemek paketi kutusunu <strong>satın almış olan kullanıcılar</strong> yorum yapabilir.
                                </div>
                            @endif
                        @else
                            <div class="p-4 text-center" style="background: #f8f9fa; border-radius: 8px; border: 1px solid #eee;">
                                <p class="mb-2" style="color: #666;">Yorum yapabilmek ve puan bırakabilmek için oturum açmanız gerekmektedir.</p>
                                <a href="{{ route('login') }}" class="btn delicious-btn btn-sm"><i class="fa fa-sign-in"></i> Giriş Yap sayfasına Git</a>
                            </div>
                        @endauth
                    </div>

                </div>

                <div class="col-12 col-lg-4">
                    <div class="ingredients" style="background-color: #fff; padding: 30px; border: 1px solid #eee; border-radius: 10px;">
                        <h4>Bu Kutuda Neler Var?</h4>
                        <div class="custom-control custom-checkbox mb-2">
                            <input type="checkbox" class="custom-control-input" id="customCheck1" checked disabled>
                            <label class="custom-control-label" for="customCheck1">Tam Ölçülü Kuru Malzemeler</label>
                        </div>
                        <div class="custom-control custom-checkbox mb-2">
                            <input type="checkbox" class="custom-control-input" id="customCheck2" checked disabled>
                            <label class="custom-control-label" for="customCheck2">Özel Sos ve Baharat Karışımları</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="customCheck3" checked disabled>
                            <label class="custom-control-label" for="customCheck3">Kilitli Şef Tarifi Kartı</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if(auth()->check() && auth()->user()->role === 'admin')
    @foreach($product->reviews as $review)
    <div class="modal fade" id="deleteReviewModal{{ $review->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteReviewModalLabel{{ $review->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="border-radius: 12px; overflow: hidden; border: none; box-shadow: 0 5px 25px rgba(0,0,0,0.2);">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteReviewModalLabel{{ $review->id }}">
                        <i class="fa fa-exclamation-triangle"></i> Yorumu Silme Onayı
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Kapat">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4 text-left">
                    <p class="mb-0" style="font-size: 16px; color: #333;">
                        <strong>{{ $review->user->name }}</strong> isimli kullanıcının bu yorumunu kalıcı olarak silmek istediğinize emin misiniz?
                    </p>
                </div>
                <div class="modal-footer bg-light border-0">
                    <button type="button" class="btn btn-sm btn-secondary px-3" data-dismiss="modal">Vazgeç</button>
                    <form action="{{ route('admin.review.delete', $review->id) }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger px-4">Evet, Sil</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
@endif

@endsection