<div>
    <input wire:keyup="search" wire:model="key" type="text" class="form-control mb-3" placeholder="Ara - Ad | Telefon | Takip No">
    @if(!empty($result))
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Takıp No</th>
                <th>Gönderıcı</th>
                <th>Alıcı</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($result as $item)
            
                <tr>
                    <td><a href="{{route('cargo.show',encrypt($item->id))}}">{{$loop->iteration}}</a></td>
                    <td><a href="{{route('cargo.show',encrypt($item->id))}}">{{$item->number}}</a></td>
                    <td><a href="{{route('cargo.show',encrypt($item->id))}}">{{$item->sender->name}}</a></td>
                    <td><a href="{{route('cargo.show',encrypt($item->id))}}">{{$item->receiver->name}}</a></td>
                </tr>
        
            @endforeach
            
        </tbody>
    </table>
    @endif
</div>
