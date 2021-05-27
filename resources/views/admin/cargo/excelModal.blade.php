<!-- The Modal -->
<div class="modal fade" id="excelModal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Excel Hazırla</h4>

                <button type="button" data-bs-dismiss="modal" class="Close">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form action="{{route('cargo.manafes')}}" method="GET">
                    
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
                        <select class="form-control" name="category" >
                            <option selected value="">Hepsi</option>
                            <option value="posta">Posta</option>
                            <option value="cargo">Kargo</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Kargo Durumu</label>
                        <select class="form-control" name="status" >
                            <option selected value="">Hepsi</option>
                            @foreach($statuses as $status)
                            <option value="{{$status->id}}">{{$status->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @if(Auth::user()->role == 'admin')
                    <div class="form-group">
                        <label>Kullanıcılar</label>
                        <select class="form-control" name="user" >
                            <option selected value="">Hepsi</option>
                            @foreach($users as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                    <div class="form-group">
                        <label>Yedek Türü</label>
                        <select class="form-control" name="type" required >
                            
                            <option value="manafes">Manafes</option>
                            <option value="baza">Baza</option>
                            <option value="delivery">Dastafka</option>
                            <option value="kargo">Kargo Harajatlar</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success">Ok</button>
                </form>
            </div>
        </div>
    </div>
</div>

