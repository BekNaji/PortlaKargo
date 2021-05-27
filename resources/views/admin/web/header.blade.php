@extends('layouts.admin')
@section('title','Profil Ayarları')

@section('content')
<div class="row">
	<div class="col-md-12">
		<br>
		
		<div class="card">
			<div class="card-body">
				{{ __('Web Header')}}
				<hr>
				<div class="row">
                    <div class="col-md-12">
                        <form action="{{route('web.header.store')}}">
                            @csrf
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" name="title" value="{{old('title') ?? $web->title}}">
                                @error('title')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" class="form-control" name="description" value="{{old('description') ?? $web->description}}">
                                @error('description')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">{{ __('Save')}}</button>
                        </form>
                    </div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
@section('js')

@endsection