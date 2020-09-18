@extends('layouts.delivery')
@section('title','Teslimat')
@section('content')

<div class="card">
    
    <div class="card-body">
        <h3>Teslimat</h3><hr>
        @if(session('sms_code') == 200)
        <p class="border border-warning p-3">
        Sms gönderildi!
        </p>
        @elseif(session('sms_code') == 400)
        <p class="border border-warning p-3">
        Sms gönderilemedi! İstemci hatası (Numara girilmemiş, mesaj girilmemiş, başlık geçersiz)
        </p>
        @elseif(session('sms_code') == 401)
        <p class="border border-warning p-3">
        Sms gönderilemedi! API Key Hatalı!
        </p>
        @elseif(session('sms_code') == 402 )
        <p class="border border-warning p-3">
        Sms gönderilemedi! Yetersiz kredi!
        </p>
        @elseif(session('sms_code') == 403 )
        <p class="border border-warning p-3">
        Sms gönderilemedi! Yapmak istediğiniz işlem için yetkiniz yok!
        </p>
        @elseif(session('sms_code') == 406)
        <p class="border border-warning p-3">
        Sms gönderilemedi! Verilen numaraya SMS atılamıyor!
        </p>
        @elseif(session('sms_code') == 414)
        <p class="border border-warning p-3">
        Sms gönderilemedi! Nedenı: Bakiye yeterlı değil!
        </p>
        @elseif(session('sms_code') == 407 )
        <p class="border border-warning p-3">
        Sms gönderilemedi! Hesap aktif değil!
        </p>
        @elseif(session('sms_code') == 413)
        <p class="border border-warning p-3">
        Sms gönderilemedi! Mesaj metni izin verilen boyuttan daha büyüktür (İngilizce karakterli sms için 612 karakter, Türkçe karakterli sms için 268 karakterdir.)!
        </p>
        @elseif(session('sms_code') == 414)
        <p class="border border-warning p-3">
        Sms gönderilemedi! Nedenı: Bakiye yeterlı değil!
        </p>
        @endif
        <p><b>Kargo Takip numaryi giriniz!</b></p>
        <form method="GET" action="{{route('delivery.edit')}}">
            <div class="form-group">
                <label>Takip no</label>
                <input class="form-control" type="text" name="number" required>
            </div>
            <button class="btn btn-primary">Ok</button>
        </form>
    </div>
</div>

@endsection
