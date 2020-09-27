@extends('layouts.admin')
@section('title','Kullanıcı Ayarları')
@section('content')
<div class="row">
	<div class="col-md-12">
		<a class="btn btn-primary " href="{{route('page.index')}}">Geri git</a>
		<br><br>
		@if ($errors->any())
				<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
				@endforeach
				</ul>
				</div>

				@endif
		<div class="card">
			<div class="card-body">
				<form action="{{route('page.update')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input value="{{$page->id}}" type="hidden" name="id">
                    <div class="form-group">
                        <label>Name</label>
                        <input value="{{$page->name ?? ''}}" class="form-control" type="text" name="name" required>
                    </div>
                    <div class="form-group">
                        <label>Title</label>
                        <input  value="{{$page->title}}" class="form-control" type="text" name="title" required>
                    </div>
                    <button type="submit" class="btn btn-success" >Kaydet</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" >Iptal</button>
                </form>
				
			</div>
		</div>
	</div>
</div>
@endsection