<!-- The Modal -->
<div class="modal fade" id="changeStatusModal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header bg-dark text-white">
                <h4 class="modal-title">Kargo durumunu değiştir !</h4>

                <button type="button" data-dismiss="modal" class="close text-white">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form action="{{route('cargo.change.status')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="ids" value="" id="cargoIds" class="form-control">
                    <div class="form-group">
                        <label>Kargo Durumu</label>
                        <select class="form-control" name="status" required>
                            <option selected>Seç</option>
                            @foreach($statuses as $status)
                            <option value="{{$status->id}}">{{$status->name}}</option>
                            @endforeach
                        </select>
                    </div>

                   

                    
                    
                    <button type="submit" class="btn btn-success" >Devam et</button>
                </form>
            </div>
        </div>
    </div>
</div>

