<table class="table" style="width:100%">
    <thead>
    <tr>
        <td style="width:50px;"><input type="checkbox" id="selectAll"></td>
        <td><b>#</b></td>
        <td><b>Kullanıcı</b></td>
        <td><b>Takip No</b></td>
        <td><b>Durum</b></td>
        <td><b>Ödeme</b></td>
        <td><b>Göderici</b></td>
        <td><b>Alıcı</b></td>
        <td><b>Toplam Kg</b></td>
        <td><b>Kargo Ücreti</b></td>
        <td><b>Oluşturma Tarih</b></td>
        <td><b>#</b></td>
    </tr>
    </thead>
    <tbody>
    @if($cargos)
        @foreach($cargos as $cargo)
            <tr>
                <td><input class="cargo" type="checkbox" name="cargo[]" data-id="{{$cargo->id}}"></td>
                <td>{{$loop->iteration}}</td>
                <td>{{ $cargo->user->name ?? ''}}</td>
                <td>{{$cargo->number ?? ''}}</td>
                <td>{{$cargo->cargoStatus->name ?? ''}}</td>
                <td>@if($cargo->payment_type== 1)Göderici Öder @elseif($cargo->payment_type ==2) Alıcı Öder @endif</td>
                <td>{{$cargo->sender->name ?? ''}}</td>
                <td>{{$cargo->receiver->name ?? ''}}</td>
                <td>{{$cargo->total_kg ?? ''}}KG</td>
                <td>{{$cargo->cargo_price ?? '$0.0'}}</td>
                <td>{{date('d-m-Y H:i',strtotime($cargo->created_at))}}</td>
                <td>
                    <a type="submit" target="_blank" href="{{route('cargo.print',encrypt($cargo->id))}}" ><span class="badge badge-info"><i class="fa fa-print"></i></span></a>
                    <a type="submit" href="{{route('cargo.show',encrypt($cargo->id))}}" ><span class="badge badge-warning"><i class="fa fa-edit"></i></span></a>
                    <a id="delete" data-id="{{$cargo->id}}" data-name="{{$cargo->number}}" href="#delete"><span class="badge badge-danger"><i class="fa fa-trash-alt "></i></span></a>
                </td>
            </tr>
        @endforeach
        @else
        <center>No Data</center>
    @endif
    </tbody>
</table>
