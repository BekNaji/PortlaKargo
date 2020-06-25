@extends('layouts.web')
@section('content')
<br>
<div class="row">
    <div class="col-md-8 offset-2">
        <div class="card">
            <div class="card-body">
                <h1>İletişim</h1>
                <form>
                    <div class="form-group">
                        <label>Isim</label>
                        <input class="form-control" type="text" name="">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" type="text" name="">
                    </div>
                    <div class="form-group">
                        <label>Telefon</label>
                        <input class="form-control" type="text" name="">
                    </div>
                    <div class="form-group">
                        <label>Konu</label>
                        <input class="form-control" type="text" name="">
                    </div>
                    <div class="form-group">
                        <label>Mesaj</label>
                        <textarea class="form-control"></textarea>
                    </div>
                    <button class="btn btn-primary">Gönder</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection