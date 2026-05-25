@extends('layouts.app')
@section('title', 'Gelen Mesajlar')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-3">
            <div class="list-group">
                <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action">Özet</a>
                <a href="{{ route('admin.orders') }}" class="list-group-item list-group-item-action">Sipariş Yönetimi</a>
                <a href="{{ route('admin.products') }}" class="list-group-item list-group-item-action">Ürün Yönetimi</a>
                <a href="{{ route('admin.users') }}" class="list-group-item list-group-item-action">Kullanıcı Yönetimi</a>
                <a href="{{ route('admin.messages') }}" class="list-group-item list-group-item-action active">Gelen Mesajlar</a>
            </div>
        </div>

        <div class="col-md-9">
            <h3>İletişim Formu Gelen Kutusu</h3>
            
            @if(session('success'))
                <div class="alert alert-success mt-2">{{ session('success') }}</div>
            @endif

            @if($messages->count() > 0)
                @foreach($messages as $msg)
                <div class="card mb-3 shadow-sm" style="border-left: 4px solid #CE7E5A;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title text-dark mb-1">Konu: {{ $msg->subject }}</h5>
                            <small class="text-muted">{{ $msg->created_at->format('d.m.Y H:i') }}</small>
                        </div>
                        <h6 class="card-subtitle mb-2 text-muted" style="font-size: 13px;">
                            Gönderen: <b>{{ $msg->name }}</b> ({{ $msg->email }})
                        </h6>
                        <p class="card-text text-secondary mt-3" style="background: #fdfdfd; padding: 15px; border-radius: 5px; border: 1px solid #f1f1f1;">
                            {{ $msg->message }}
                        </p>
                        
                        <div class="text-right">
                            <button type="button" class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#deleteMessageModal{{ $msg->id }}">
                                <i class="fa fa-trash"></i> Mesajı Sil
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
                
                <div class="d-flex justify-content-center mt-4">
                    {{ $messages->links('pagination::bootstrap-4') }}
                </div>

            @else
                <div class="alert alert-info mt-3">Gelen kutunuz boş, henüz hiç mesaj alınmadı.</div>
            @endif
        </div>
    </div>
</div>

@foreach($messages as $msg)
<div class="modal fade" id="deleteMessageModal{{ $msg->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteMessageModalLabel{{ $msg->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 12px; overflow: hidden; border: none; box-shadow: 0 5px 25px rgba(0,0,0,0.2);">
            
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteMessageModalLabel{{ $msg->id }}">
                    <i class="fa fa-exclamation-triangle"></i> Mesajı Silme Onayı
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Kapat">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body p-4 text-left">
                <p class="mb-0" style="font-size: 16px; color: #333;">
                    <strong>{{ $msg->name }}</strong> tarafından gönderilen bu mesajı kalıcı olarak silmek istediğinize emin misiniz?
                </p>
            </div>
            
            <div class="modal-footer bg-light border-0">
                <button type="button" class="btn btn-sm btn-secondary px-3" data-dismiss="modal">Vazgeç</button>
                
                <form action="{{ route('admin.message.delete', $msg->id) }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-danger px-4">Evet, Sil</button>
                </form>
            </div>
            
        </div>
    </div>
</div>
@endforeach

@endsection