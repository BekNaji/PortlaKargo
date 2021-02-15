@extends('layouts.admin')
@section('title','Kargo Listesi')
@section('content')
<div class="row">
	<div class="col-md-12">
		<br>
		<div class="card">
			<div class="card-body">
				<div class="row">
                    <div class="col-md-9">
                        <i class="fa fa-list" aria-hidden="true"></i> <span class="mr-4">Kargo Listesi </span>
                        
                        @if(Permission::check('cargo-create'))
                        <a href="{{route('cargo.create')}}" class="btn btn-success "><i class="fa fa-plus" aria-hidden="true"></i></a>
                        &nbsp;
                        @endif


                        @if(Permission::check('cargo-status-change'))
                        <button id="filter" type="button" class="btn btn-info"><i class="fa fa-filter" aria-hidden="true"></i></button>
                        <button id="change" type="button" class="btn btn-warning">Status Değiştir</button>
                        @endif

                        @if(Permission::check('telegram-sms'))
                        <button id="sendMessageTelegram" type="button" class="btn btn-primary">SMS Telegram</button>
                        @endif

                        @if(Permission::check('create-excel'))
                        <button id="manafes" type="button" class="btn btn-info">Excel Hazırla</button>
                        @endif
                        
                    </div>
                    <div class="col-md-3">
                        
                    </div>
			    </div>
                <div id="cargoList">

                </div>
			</div>
		</div>
	</div>
</div>
@include('admin.cargo.deleteModal')
@include('admin.cargo.createModal')
@include('admin.cargo.filterModal')
@include('admin.cargo.excelModal')
@include('admin.cargo.changeStatusModal')
@include('admin.cargo.sendMessageTelegramModal')
@include('admin.cargo.script')

@endsection