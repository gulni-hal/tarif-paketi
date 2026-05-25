@extends('layouts.app')
@section('title', 'Admin Paneli')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-3">
            <div class="list-group shadow-sm">
                <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action active">Özet</a>
                <a href="{{ route('admin.orders') }}" class="list-group-item list-group-item-action">Sipariş Yönetimi</a>
                <a href="{{ route('admin.products') }}" class="list-group-item list-group-item-action">Ürün Yönetimi</a>
                <a href="{{ route('admin.users') }}" class="list-group-item list-group-item-action">Kullanıcı Yönetimi</a>
                <a href="{{ route('admin.messages') }}" class="list-group-item list-group-item-action">Gelen Mesajlar</a>
            </div>
        </div>

        <div class="col-md-9">
            <h3 class="mb-4" style="color: #4b4b4b;">Yönetim Paneli Özeti</h3>
            
            <div class="row mt-2">
                <div class="col-md-4">
                    <div class="card text-white mb-3 shadow-sm border-0" style="background: linear-gradient(45deg, #17a2b8, #1fc8e3); border-radius: 12px;">
                        <div class="card-body text-center py-4">
                            <i class="fa fa-shopping-basket fa-2x mb-2 opacity-50"></i>
                            <h6 class="card-title text-white font-weight-bold">Toplam Sipariş</h6>
                            <h2 class="card-text text-white font-weight-bold mb-0">{{ $totalOrders }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white mb-3 shadow-sm border-0" style="background: linear-gradient(45deg, #6c757d, #8d97a0); border-radius: 12px;">
                        <div class="card-body text-center py-4">
                            <i class="fa fa-users fa-2x mb-2 opacity-50"></i>
                            <h6 class="card-title text-white font-weight-bold">Kayıtlı Kullanıcı</h6>
                            <h2 class="card-text text-white font-weight-bold mb-0">{{ $totalUsers }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white mb-3 shadow-sm border-0" style="background: linear-gradient(45deg, #D34E4E, #f06a6a); border-radius: 12px;">
                        <div class="card-body text-center py-4">
                            <i class="fa fa-cutlery fa-2x mb-2 opacity-50"></i>
                            <h6 class="card-title text-white font-weight-bold">Toplam Ürün (Kutu)</h6>
                            <h2 class="card-text text-white font-weight-bold mb-0">{{ $totalProducts }}</h2>
                        </div>
                    </div>
                </div>
            </div>

            <h4 class="mt-4 mb-3" style="color: #4b4b4b; border-bottom: 2px solid #eee; padding-bottom: 10px;">Son 7 Günün İstatistikleri</h4>
            
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm border-0" style="border-radius: 12px;">
                        <div class="card-body">
                            <h6 class="font-weight-bold text-center" style="color: #6c757d;">Yeni Üye Kayıtları</h6>
                            <canvas id="usersChart" height="200"></canvas>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm border-0" style="border-radius: 12px;">
                        <div class="card-body">
                            <h6 class="font-weight-bold text-center" style="color: #6c757d;">Gelen İletişim Mesajları</h6>
                            <canvas id="messagesChart" height="200"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mb-4">
                    <div class="card shadow-sm border-0" style="border-radius: 12px;">
                        <div class="card-body">
                            <h6 class="font-weight-bold text-center" style="color: #6c757d;">Ürünlere Yapılan Yorumlar</h6>
                            <canvas id="reviewsChart" height="100"></canvas>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Controller'dan gelen verileri JavaScript'e aktarıyoruz
    const labels = {!! json_encode($chartDates) !!};
    const userCounts = {!! json_encode($userCounts) !!};
    const messageCounts = {!! json_encode($messageCounts) !!};
    const reviewCounts = {!! json_encode($reviewCounts) !!};

    // 1. Yeni Üyeler Grafiği (Çizgi Grafik)
    const ctxUsers = document.getElementById('usersChart').getContext('2d');
    new Chart(ctxUsers, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Yeni Kullanıcı',
                data: userCounts,
                borderColor: '#17a2b8',
                backgroundColor: 'rgba(23, 162, 184, 0.2)',
                borderWidth: 2,
                fill: true,
                tension: 0.3 // Çizgiyi yumuşatır
            }]
        },
        options: {
            responsive: true,
            scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
        }
    });

    // 2. Gelen Mesajlar Grafiği (Bar Grafik)
    const ctxMessages = document.getElementById('messagesChart').getContext('2d');
    new Chart(ctxMessages, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Gelen Mesaj',
                data: messageCounts,
                backgroundColor: '#D34E4E',
                borderRadius: 4
            }]
        },
        options: {
            responsive: true,
            scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
        }
    });

    // 3. Yorumlar Grafiği (Çizgi Grafik)
    const ctxReviews = document.getElementById('reviewsChart').getContext('2d');
    new Chart(ctxReviews, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Yapılan Yorum',
                data: reviewCounts,
                borderColor: '#fbb710',
                backgroundColor: 'rgba(251, 183, 16, 0.2)',
                borderWidth: 2,
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
        }
    });
</script>
@endsection