<table class="table" style="width:100%">
    <thead>
        <tr>
            <td style="width:50px;"><input type="checkbox" id="selectAll"></td>
            <td><b>#</b></td>
            <td><b>Kategori</b></td>
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
            <td>{{($cargos ->currentpage()-1) * $cargos ->perpage() + $loop->index + 1}}</td>
            <td>{{ $cargo->type ?? '' }}</td>
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
                <a type="submit" target="_blank" 
                    href="{{route('cargo.print',encrypt($cargo->id))}}" >
                    <span class="badge bg-info">
                        <svg class="bi" width="1em" height="1em" fill="currentColor">
                            <use
                                xlink:href="{{asset('admin')}}/assets/vendors/bootstrap-icons/bootstrap-icons.svg#printer-fill" />
                        </svg>
                    </span>
                </a>

                @if(Permission::check('cargo-show'))
                <a type="submit"
                    href="{{route('cargo.show',encrypt($cargo->id))}}" >
                    <span class="badge bg-warning">
                        <svg class="bi" width="1em" height="1em" fill="currentColor">
                            <use
                                xlink:href="{{asset('admin')}}/assets/vendors/bootstrap-icons/bootstrap-icons.svg#pencil-square" />
                        </svg>
                    </span>
                </a>
                @endif

                @if(Permission::check('cargo-delete'))
                <form action="{{route('cargo.delete')}}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{$cargo->id}}">
                    <button class="btn badge bg-danger" type="submit" onclick="return confirm('Eminmisin ?')">
                        <svg class="bi" width="1em" height="1em" fill="currentColor">
                            <use
                                xlink:href="{{asset('admin')}}/assets/vendors/bootstrap-icons/bootstrap-icons.svg#trash-fill" />
                        </svg>
                    </button>
                </form>
                @endif
            </td>
        </tr>
        @endforeach
        @endif
    </tbody>
</table>