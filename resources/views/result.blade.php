@extends('layouts.app')
@section('content')

    <div class="col-md-10 offset-md-1">
        <a href="/" class="btn btn-success">Bosh sahifa</a>
        <div class="card" style="margin-top:15px">
            <div class="card-body">
                <div class="row">
                    @if ($cargo->sender->name ?? '' != '')
                        <div class="col-md-4">
                            <b>Yuboruvchi:</b>
                            {{ substr($cargo->sender->name ?? '', 0, 2) }}***
                            {{ substr($cargo->sender->surname ?? '', 0, 2) }}***
                        </div>
                    @endif
                    @if ($cargo->receiver->name ?? '' != '')
                        <div class="col-md-4">
                            <b>Oluvchi:</b>
                            {{ substr($cargo->receiver->name ?? '', 0, 2) }}***
                            {{ substr($cargo->receiver->surname ?? '', 0, 2) }}***
                        </div>
                    @endif
                    <div class="col-md-4">
                        <b>Kargo raqami:</b> {{ $cargo->number ?? '' }}
                    </div>
                </div>
            </div>
        </div>
        <div class="card" id="result">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td>*</td>
                            <td>Status</td>
                            <td>Sanasi va Vaqti</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cargoLogs as $cargoLog)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $cargoLog->cargoStatus->name }}</td>
                                <td>{{ date('d-m-Y h:i',strtotime($cargoLog->created_at)) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        $(document).ready(function(){
            $(window).scrollTop( $('body').height() );
        });
       
    </script>
@endsection
