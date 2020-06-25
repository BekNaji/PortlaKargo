@extends('layouts.admin')

@section('content')
<div class="row">
	<div class="col-md-6 offset-3">
		
		<a class="btn btn-primary " href="{{route('cargo.index')}}">Geri git</a> 
		<br><br>
		<div class="card">
			<div class="card-body">
				<i class="fa fa-hashtag" aria-hidden="true"></i> Kargo Bilgilerini düzenle 
				<hr>
                 <form action="{{route('cargo.update')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{$cargo->id}}">
                    <div class="form-group">
                        <label>Takip NO</label>
                        <input class="form-control" type="text" value="{{$cargo->number}}" readonly>
                    </div>
                    <div class="form-group">
                        <label>Topla kg</label>
                        <input class="form-control" type="number" step="0.01" name="total_kg" value="{{$cargo->total_kg}}">
                    </div>
                    <div class="form-group">
                        <label>Kargo Durumu</label>
                        <select class="form-control" name="status">
                            <option >Seç</option>
                            @foreach($statuses as $status)
                            <option 
                            value="{{$status->id}}"
                            @if($cargo->status == $status->id)
                            selected 
                            @endif
                            >{{$status->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Ödeme Türü</label>
                        <select class="form-control" name="payment_type">
                            <option selected>Seç</option>
                            <option 
                            value="1"{{($cargo->payment_type == 1)?'selected':''}}>Gönderıcı Öder
                            </option>
                            <option value="2"
                            {{($cargo->payment_type == 2)?'selected':''}}>
                            Alıcı Öder</option>
                        </select>
                    </div>

                    
                    
                    <button type="submit" class="btn btn-success" >Devam et</button>
                </form>
			</div>
		</div>
	</div>
</div>

@endsection