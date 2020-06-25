@extends('layouts.web')
@section('content')
<div class="advance-search">
    <form action="{{route('search')}}" method="GET" >
        <div class="row h-100 justify-content-center" style="padding-top:160px;">
           
            <div class="col-lg-6 col-md-12">
                <div class="block d-flex">
                    <input name="key" type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" id="search" placeholder="Kargo Takip No" required>
                    <!-- Search Button -->
                    <button type="submit" class="btn btn-primary">Ara</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection