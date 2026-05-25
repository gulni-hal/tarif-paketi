@extends('layouts.app')

@section('title', $title)

@section('content')

    <div class="breadcumb-area bg-img bg-overlay" style="background-image: url('{{ asset('img/bg-img/about1.png') }}');">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcumb-text text-center">
                        <h2>{{ $title }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <section class="best-receipe-area section-padding-80">
        <div class="container">
            <div class="row">
                @if($products->count() > 0)
                    @foreach($products as $product)
                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="single-best-receipe-area mb-30 shadow-sm" style="border: 1px solid #eee; border-radius: 10px; overflow: hidden; background: #fff;">
                            <img src="{{ asset($product->image_url) }}" alt="{{ $product->name }}" style="width: 100%; height: 230px; object-fit: cover;">
                            <div class="receipe-content" style="padding: 20px;">
                                <a href="{{ route('product.detail', $product->id) }}">
                                    <h5 style="color: #4b4b4b;">{{ $product->name }}</h5>
                                </a>
                                <p class="text-muted mt-2" style="font-size: 13px; line-height: 1.5;">
                                    {{ Str::limit($product->description, 95) }}
                                </p>
                                <hr>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <span class="h4 mb-0" style="color: #D34E4E; font-weight: bold;">{{ $product->price }} TL</span>
                                    <small class="text-secondary">Stok: {{ $product->stock }} Kutu</small>
                                </div>
                                
                                <div class="mt-3">
                                    <a href="{{ route('product.detail', $product->id) }}" class="btn delicious-btn btn-sm w-100 text-center" style="height: 38px; line-height: 38px; font-size: 13px;">
                                        <i class="fa fa-search"></i> Paketi İncele
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    <div class="col-12 mt-4">
                        <div class="d-flex justify-content-center">
                            {{ $products->links('pagination::bootstrap-4') }}
                        </div>
                    </div>

                @else
                    <div class="col-12 text-center">
                        <div class="alert alert-warning p-5">
                            <h5>Bu kategoriye ait hazır malzeme kutusu şu an stoklarımızda bulunmamaktadır.</h5>
                            <a href="/" class="btn delicious-btn btn-sm mt-3">Ana Sayfaya Dön</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection