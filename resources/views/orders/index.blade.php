@extends('layouts.app')
@section('title', 'Siparişlerim')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4">Geçmiş Siparişlerim ve Kargo Takibi</h2>
            
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($orders->count() > 0)
                 <div class="table-responsive shadow-sm" style="border-radius: 10px; background: #fff;">
             <table class="table table-bordered text-center align-middle mb-0">
                    <thead style="background-color: #4b4b4b; color: white;">
                        <tr>
                            <th>Sipariş No</th>
                            <th>Tarih</th>
                            <th>Tutar</th>
                            <th>Sipariş Durumu</th>
                            <th>İşlemler</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td class="align-middle">#{{ $order->id + 1000 }}</td>
                            <td class="align-middle">{{ $order->created_at->format('d.m.Y H:i') }}</td>
                            <td class="align-middle font-weight-bold" style="color: #D34E4E;">{{ $order->total_amount }} TL</td>
                            <td class="align-middle">
                                @if($order->status == 'bekliyor')
                                    <span class="badge badge-warning text-dark px-3 py-2"><i class="fa fa-clock-o"></i> Onay Bekliyor</span>
                                @elseif($order->status == 'onaylandi')
                                    <span class="badge badge-info px-3 py-2"><i class="fa fa-check"></i> Onaylandı</span>
                                @elseif($order->status == 'tedarik_ediliyor')
                                    <span class="badge badge-secondary px-3 py-2"><i class="fa fa-shopping-cart"></i> Tedarik Ediliyor</span>
                                @elseif($order->status == 'kutulaniyor')
                                    <span class="badge badge-dark px-3 py-2"><i class="fa fa-box"></i> Kutulanıyor</span>
                                @elseif($order->status == 'kargoya_verildi')
                                    <span class="badge badge-primary px-3 py-2"><i class="fa fa-truck"></i> Kargoya Verildi</span>
                                @elseif($order->status == 'teslim_edildi')
                                    <span class="badge badge-success px-3 py-2"><i class="fa fa-check-circle"></i> Teslim Edildi</span>
                                @elseif($order->status == 'iptal_edildi')
                                    <span class="badge badge-danger px-3 py-2"><i class="fa fa-times"></i> İptal Edildi</span>
                                @else
                                    <span class="badge badge-light px-3 py-2">{{ $order->status }}</span>
                                @endif
                            </td>
                            <td class="align-middle">
                                <div class="d-flex justify-content-center align-items-center">
                                    
                                    @if($order->status == 'bekliyor')
                                        <button type="button" class="btn btn-sm btn-danger mr-2" data-toggle="modal" data-target="#cancelOrderModal{{ $order->id }}">
                                            <i class="fa fa-times"></i> İptal Et
                                        </button>
                                    @endif

                                    @if($order->status == 'kargoya_verildi')
                                        <form action="{{ route('order.deliver', $order->id) }}" method="POST" class="m-0 mr-2">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Teslim Aldım</button>
                                        </form>
                                    @endif
                                    
                                    <button type="button" class="btn btn-sm btn-outline-dark" data-toggle="modal" data-target="#orderDetailModal{{ $order->id }}">
                                        <i class="fa fa-eye"></i> Detay Gör
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
</div>

                @foreach($orders as $order)
                
                @if($order->status == 'bekliyor')
                <div class="modal fade" id="cancelOrderModal{{ $order->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content" style="border-radius: 12px; overflow: hidden; border: none; box-shadow: 0 5px 25px rgba(0,0,0,0.2);">
                            <div class="modal-header bg-danger text-white">
                                <h5 class="modal-title"><i class="fa fa-exclamation-triangle"></i> Sipariş İptal Onayı</h5>
                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Kapat">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body p-4 text-left">
                                <p class="mb-1" style="font-size: 16px; color: #333;">
                                    <strong>#{{ $order->id + 1000 }}</strong> numaralı siparişinizi iptal etmek istediğinize emin misiniz?
                                </p>
                                <small class="text-danger">* İptal işlemi gerçekleştiğinde, <strong>{{ $order->total_amount }} TL</strong> tutarındaki ücret anında cüzdan bakiyenize iade edilecektir.</small>
                            </div>
                            <div class="modal-footer bg-light border-0">
                                <button type="button" class="btn btn-sm btn-secondary px-3" data-dismiss="modal">Vazgeç</button>
                                <form action="{{ route('order.cancel', $order->id) }}" method="POST" class="m-0">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger px-4">Evet, İptal Et</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                
                <div class="modal fade" id="orderDetailModal{{ $order->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content" style="border-radius: 15px; overflow: hidden; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
                            
                            <div class="modal-header" style="background-color: #4b4b4b; color: white;">
                                <h5 class="modal-title"><i class="fa fa-shopping-basket"></i> Sipariş Detayları (#{{ $order->id + 1000 }})</h5>
                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Kapat">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            
                            <div class="modal-body p-4">
                                
                                <div class="order-status-timeline mb-4 p-3" style="background: #f8f9fa; border-radius: 8px; border: 1px solid #e9ecef;">
                                    <h6 class="font-weight-bold mb-3 border-bottom pb-2" style="color: #D34E4E;">Sipariş ve Kargo Süreci</h6>
                                    <p class="mb-1" style="font-size: 15px;">
                                        <strong>Mevcut Durum:</strong> 
                                        @if($order->status == 'bekliyor') 
                                            Ödeme onayınız kontrol ediliyor. Tarif kilitleriniz onaydan sonra açılacaktır.
                                        @elseif($order->status == 'onaylandi') 
                                            Siparişiniz onaylandı! Şeflerimiz şu an sizin için malzeme listesini hazırlıyor.
                                        @elseif($order->status == 'tedarik_ediliyor') 
                                            Tarifiniz için en taze malzemeler özenle seçilip tedarik ediliyor.
                                        @elseif($order->status == 'kutulaniyor') 
                                            Harika! Malzemeleriniz ve şef tarifiniz ısı yalıtımlı özel kutunuza yerleştiriliyor.
                                        @elseif($order->status == 'kargoya_verildi') 
                                            Kutunuz yola çıktı! Anlaşmalı kargo firmamız paketinizi adresinize doğru getiriyor.
                                        @elseif($order->status == 'teslim_edildi') 
                                            Siparişiniz başarıyla teslim edildi. Mutfakta harikalar yaratma vakti, afiyet olsun!
                                        @elseif($order->status == 'iptal_edildi') 
                                            Sipariş iptal işlemi gerçekleşti. Tutar cüzdanınıza iade edildi.
                                        @endif
                                    </p>
                                    <p class="mb-0 text-muted"><small>Oluşturulma: {{ $order->created_at->format('d.m.Y H:i') }}</small></p>
                                </div>

                                <h6 class="font-weight-bold mb-3">Satın Alınan Paketler ve İçerikler</h6>
                                
                              @foreach($order->items as $item)
                                <div class="card mb-3 shadow-sm border-0" style="background-color: #fff;">
                                    <div class="card-body d-flex flex-column flex-md-row align-items-start">
                                        
                                        @if($item->product)
                                            <img src="{{ asset($item->product->image_url ? $item->product->image_url : 'img/bg-img/bg1.jpg') }}" alt="{{ $item->product->name }}" class="rounded mr-3 mb-3 mb-md-0" style="width: 120px; height: 120px; object-fit: cover; border: 1px solid #eee;">
                                            
                                            <div class="flex-grow-1 w-100">
                                                <div class="d-flex justify-content-between border-bottom pb-2 mb-2">
                                                    <h6 class="mb-0" style="font-size: 16px; color: #4b4b4b;">{{ $item->product->name }}</h6>
                                                    <strong style="color: #D34E4E;">{{ $item->quantity }} Adet</strong>
                                                </div>
                                                
                                                @if(in_array($order->status, ['onaylandi', 'tedarik_ediliyor', 'kutulaniyor', 'kargoya_verildi', 'teslim_edildi']))
                                                    <div class="recipe-unlocked mt-3">
                                                        <div class="d-flex mb-2">
                                                            <button class="btn btn-sm text-white mr-2" style="background-color: #f39c12; border:none;" type="button" data-toggle="collapse" data-target="#collapseIngredients{{ $item->id }}" aria-expanded="false" aria-controls="collapseIngredients{{ $item->id }}">
                                                                <i class="fa fa-shopping-basket"></i> Malzemeleri Gör
                                                            </button>
                                                            <button class="btn btn-sm text-white" style="background-color: #28a745; border:none;" type="button" data-toggle="collapse" data-target="#collapseRecipe{{ $item->id }}" aria-expanded="false" aria-controls="collapseRecipe{{ $item->id }}">
                                                                <i class="fa fa-list-ol"></i> Hazırlanışı Gör
                                                            </button>
                                                        </div>

                                                        <div class="collapse mb-2" id="collapseIngredients{{ $item->id }}">
                                                            <div class="p-3 shadow-sm" style="background-color: #fff8e1; border-left: 4px solid #f39c12; border-radius: 4px; max-height: 200px; overflow-y: auto;">
                                                                <p class="mb-0 text-dark" style="font-size: 13px; line-height: 1.6;">
                                                                    {!! nl2br(e($item->product->ingredients ?? 'Malzeme listesi yakında eklenecek.')) !!}
                                                                </p>
                                                            </div>
                                                        </div>

                                                        <div class="collapse" id="collapseRecipe{{ $item->id }}">
                                                            <div class="p-3 shadow-sm" style="background-color: #e9f7ef; border-left: 4px solid #28a745; border-radius: 4px; max-height: 250px; overflow-y: auto;">
                                                                <p class="mb-0 text-dark" style="font-size: 13px; line-height: 1.6;">
                                                                    {!! nl2br(e($item->product->recipe_steps ?? 'Hazırlanış adımları yakında eklenecek.')) !!}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="recipe-locked p-3 mt-2" style="background-color: #f8d7da; border-left: 4px solid #dc3545; border-radius: 4px;">
                                                        <strong style="color: #dc3545; font-size: 14px;"><i class="fa fa-lock"></i> Kutu İçeriği Kilitli</strong>
                                                        <p class="mt-2 mb-0 text-dark" style="font-size: 13px;">Bu pakete ait özel malzemeler listesi ve adım adım hazırlanış sırları, siparişinizin ödeme onayı verildikten hemen sonra burada erişime açılacaktır.</p>
                                                    </div>
                                                @endif
                                            </div>

                                        @else
                                            <img src="{{ asset('img/bg-img/bg1.jpg') }}" alt="Silinmiş Ürün" class="rounded mr-3 mb-3 mb-md-0" style="width: 120px; height: 120px; object-fit: cover; border: 1px dashed #ccc; opacity: 0.5;">
                                            <div class="flex-grow-1 w-100">
                                                <div class="d-flex justify-content-between border-bottom pb-2 mb-2">
                                                    <h6 class="mb-0" style="font-size: 16px; color: #999;"><i>Ürün Yayından Kaldırılmış</i></h6>
                                                    <strong style="color: #999;">{{ $item->quantity }} Adet</strong>
                                                </div>
                                                <p class="mt-2 mb-0 text-muted" style="font-size: 13px;">Bu ürün yöneticiler tarafından mağazadan kaldırıldığı için detaylarına erişilemiyor.</p>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                                @endforeach
                                
                            </div>
                            
                            <div class="modal-footer bg-light d-flex justify-content-between">
                                <div>
                                    <span class="text-muted" style="font-size: 14px;">Toplam Tutar:</span>
                                    <strong style="font-size: 18px; color: #D34E4E; margin-left: 5px;">{{ $order->total_amount }} TL</strong>
                                </div>
                                <button type="button" class="btn btn-secondary btn-sm px-4" data-dismiss="modal">Kapat</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            @else
                <div class="alert alert-info text-center py-4" style="font-size: 16px;">
                    <i class="fa fa-info-circle fa-2x mb-2" style="color: #17a2b8;"></i><br>
                    Henüz verilmiş bir siparişiniz bulunmamaktadır. Lezzetli paketlerimizi incelemek için <a href="/#kutular" style="color: #D34E4E; font-weight: bold; text-decoration: underline;">buraya tıklayın</a>.
                </div>
            @endif
        </div>
    </div>
     
    <div class="d-flex justify-content-center mt-4">
        {{ $orders->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection