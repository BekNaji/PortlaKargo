<!-- The Modal -->
<div class="modal fade" id="filterModal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Filter</h4>

                <button type="button" data-bs-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form action="{{route('cargo.filter')}}" method="GET">
                    
                    <div class="form-group">
                        <label>Başalngıç Tarihi</label>
                        <input type="date" name="start" class="form-control" max="{{date('Y-m-d')}}">
                    </div>

                    <div class="form-group">
                        <label>Bitiş Tarihi</label>
                        <input type="date" name="end" class="form-control" max="{{date('Y-m-d')}}">
                    </div>
                    <div class="form-group">
                        <label>Kargo Kategori</label>
                        <select class="form-control" name="type" >
                            <option selected value="">Hepsi</option>
                            <option value="posta">Posta</option>
                            <option value="cargo">Kargo</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Baza</label>
                        <select class="form-control" name="baza" >
                            <option selected value="">Hepsi</option>
                            <option value="1">Baza-1</option>
                            <option value="2">Baza-2</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Kargo Durumu</label>
                        <select class="form-control" name="status" >
                            <option selected value="all">Hepsi</option>
                            @foreach($statuses as $status)
                            <option value="{{$status->id}}">{{$status->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @if(Auth::user()->role == 'admin')
                    <div class="form-group">
                        <label>Kullanıcılar</label>
                        <select class="form-control" name="user" >
                            <option selected value="all">Hepsi</option>
                            @foreach($users as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                    <button type="submit" class="btn btn-success" >Ok</button>
                </form>
            </div>
        </div>
    </div>
</div>

