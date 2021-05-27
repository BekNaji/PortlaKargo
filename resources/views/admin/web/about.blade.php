@extends('layouts.admin')
@section('title','Website Ayarları')
@section('css')
<link rel="stylesheet" href="{{asset('admin')}}/assets/vendors/summernote/summernote-lite.min.css">
@endsection
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="card mt-3">
			<div class="card-body">
				{{ __('Web About')}}
				<hr>
				<div class="row">
                    <div class="col-md-12">
                        <form id="form" method="POST" action="{{route('web.about.store')}}" enctype="multipart/form-data" >
                            @csrf
                            @if ($web->image)
                                <img src="{{asset($web->image)}}" width="200">
                            @endif
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" class="form-control" name="image">
                                @error('image')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea id="editor" style="min-height: 100px" name="description" style="min-height: 100px">
                                {{$web->description ?? ''}}
                                </textarea>
                                @error('description')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <button id="submit" type="submit" class="btn btn-primary">{{ __('Save')}}</button>
                        </form>
                    </div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
@section('js')
<script src="{{asset('admin')}}/assets/vendors/summernote/summernote-lite.min.js"></script>

<script>
$('#editor').summernote({
    height: null,                 // set editor height
    minHeight: 200,             // set minimum height of editor
    maxHeight: null,             // set maximum height of editor
    focus: true,
    toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']]]
          //['insert', ['link', 'picture', 'video']],
          //['view', ['fullscreen', 'codeview', 'help']]
});
</script> 
@endsection
