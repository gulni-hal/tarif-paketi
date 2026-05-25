@extends('layouts.app')
@section('title', 'Kullanıcı Yönetimi')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-3">
            <div class="list-group">
                <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action">Özet</a>
                <a href="{{ route('admin.orders') }}" class="list-group-item list-group-item-action">Sipariş Yönetimi</a>
                <a href="{{ route('admin.products') }}" class="list-group-item list-group-item-action">Ürün Yönetimi</a>
                <a href="{{ route('admin.users') }}" class="list-group-item list-group-item-action active">Kullanıcı Yönetimi</a>
                <a href="{{ route('admin.messages') }}" class="list-group-item list-group-item-action">Gelen Mesajlar</a>
            </div>
        </div>

        <div class="col-md-9">
            <h3>Sistemdeki Tüm Kullanıcılar</h3>
            
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger">{{ $errors->first() }}</div>
            @endif

             <div class="table-responsive shadow-sm" style="border-radius: 10px; background: #fff;">
             <table class="table table-bordered text-center align-middle mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Ad Soyad</th>
                        <th>E-Posta</th>
                        <th>Bakiye</th>
                        <th>Yetki / Durum</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td class="align-middle">{{ $user->id }}</td>
                        <td class="align-middle">{{ $user->name }}</td>
                        <td class="align-middle">{{ $user->email }}</td>
                        <td class="align-middle" style="color: #D34E4E; font-weight: bold;">{{ $user->balance }} TL</td>
                        <td class="align-middle">
                            @if($user->role == 'admin')
                                <span class="badge badge-primary">Yönetici</span>
                            @else
                                <span class="badge badge-secondary">Müşteri</span>
                            @endif
                            <br>
                            @if($user->is_active)
                                <span class="badge badge-success mt-1">Aktif</span>
                            @else
                                <span class="badge badge-danger mt-1">Dondurulmuş</span>
                            @endif
                        </td>
                        <td class="align-middle">
                            @if($user->id !== Auth::id()) 
                                <div class="d-flex justify-content-center align-items-center">
                                    <form action="{{ route('admin.user.toggle', $user->id) }}" method="POST" class="m-0 mr-1">
                                        @csrf
                                        @if($user->is_active)
                                            <button type="submit" class="btn btn-sm btn-warning" title="Hesabı Dondur"><i class="fa fa-pause"></i></button>
                                        @else
                                            <button type="submit" class="btn btn-sm btn-success" title="Hesabı Aktifleştir"><i class="fa fa-play"></i></button>
                                        @endif
                                    </form>

                                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteUserModal{{ $user->id }}" title="Kullanıcıyı Sil">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            @else
                                <span class="text-muted" style="font-size: 12px;">Yetkisiz</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
</div>
            
            <div class="d-flex justify-content-center mt-4">
                {{ $users->links('pagination::bootstrap-4') }}
            </div>

        </div>
    </div>
</div>

@foreach($users as $user)
    @if($user->id !== Auth::id())
    <div class="modal fade" id="deleteUserModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteUserModalLabel{{ $user->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="border-radius: 12px; overflow: hidden; border: none; box-shadow: 0 5px 25px rgba(0,0,0,0.2);">
                
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteUserModalLabel{{ $user->id }}">
                        <i class="fa fa-exclamation-triangle"></i> Kullanıcı Silme Onayı
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Kapat">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="modal-body p-4 text-left">
                    <p class="mb-1" style="font-size: 16px; color: #333;">
                        <strong>{{ $user->name }}</strong> ({{ $user->email }}) isimli kullanıcıyı sistemden kalıcı olarak silmek istediğinize emin misiniz?
                    </p>
                    <small class="text-danger">* Bu işlem geri alınamaz. Kullanıcıya ait geçmiş sipariş ve yorum kayıtları etkilenebilir.</small>
                </div>
                
                <div class="modal-footer bg-light border-0">
                    <button type="button" class="btn btn-sm btn-secondary px-3" data-dismiss="modal">Vazgeç</button>
                    
                    <form action="{{ route('admin.user.delete', $user->id) }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger px-4">Evet, Sil</button>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
    @endif
@endforeach

@endsection