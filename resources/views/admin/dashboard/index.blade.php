@extends('layouts.admin')
@section('title','Portal Anasayfa')

@section('content')
<div class="row">
    <div class="col-md-12">
        <br>
        @if(Auth::user()->role != 'root')
        <div class="card">
            <div class="card-body">
                <i class="fa fa-hashtag" aria-hidden="true"></i> Portal Anasayfa
                <hr>
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-primary text-white mb-4">
                            <div class="card-body">Toplam Kargo Adetı <br>
                                <h2>{{$cargoCount}}</h2>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" 
                                href="{{route('cargo.index')}}">Listeye git</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    @if(Auth::user()->role == 'admin')
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-warning text-white mb-4">
                            <div class="card-body">Toplam Kullanıcı sayısı <br>
                            <h2>{{$userCount}}</h2></div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" 
                                href="{{route('user.index')}}">Listeye git</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-success text-white mb-4">
                            <div class="card-body">Toplam Gönderici sayısı <br><h2>{{$senderCount}}</h2></div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" 
                                href="{{route('customer.index')}}">Listeye git</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-danger text-white mb-4">
                            <div class="card-body">Toplam Alıcı Sayısı
                            <br><h2>{{$receiverCount}}</h2></div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" 
                                href="{{route('receiver.index')}}">Listeye git</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <br>
    <div class="card">
        <div class="card-body">
            <p><b>Yeni Sürüm  Version 5.6</b></p> 
            <ul>
                <li><b>Hata Düzeltildi</b>Teslim edildi statusunde SMS gönderme sorunu çözüldü</li>
                <li><b>Önemlı:</b> Genel Ayarlardan Kargo numara sırasını değiştirme özelliği eklendi! 
                    <b>Örnek:</b> Ben Genel ayarlara gittim ve << Kargo numara >> kısmını 50 yazdım ve kayd ettım. Sonra Yenı Kargo Kaydı oluşturdum oluşturduğum Kargo numarası AB00051 diye devam edecek! 
                </li>
            </ul>
            <hr>
            <p><b>Gelecek olan Yenı sürümde </b></p>
            <ul>
                <li>Kargo Listesi sayfasıda Toplu şekilde Telefona SMS gönderme işlemi yapılabilir olacak</li>
                <li>Göndericiler Listesini excel dosyasına hızlı bir şekilde oluşturulabilir olacak!</li>
            </ul>
            <p>Farklı bir Sorun Çıkarsa benimle +905550156185 telefon numarasından ulaşabilirsiniz!</p>
        </div>
    </div>

    </div>
</div>
<script type="text/javascript">
var ctx = document.getElementById('myChart').getContext('2d');
var chart = new Chart(ctx, {
// The type of chart we want to create
type: 'bar',
// The data for our dataset
data: {
labels: ['Jun','Jul'],
datasets: [{
label: 'Aylık kargo',
data: [4],
backgroundColor: 'rgba(36, 104, 240, 1)',
borderColor: 'rgb(255, 99, 132)',
}],
},
// Configuration options go here
options: {
responsive: false
}
});
</script>
@endsection