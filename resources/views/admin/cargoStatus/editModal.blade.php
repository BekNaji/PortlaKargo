<!-- The Modal -->
<div class="modal fade" id="editModal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header bg-dark text-white">
                <h4 class="modal-title">Statusu Güncelle!</h4>

                <button type="button" data-dismiss="modal" class="close text-white">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form action="{{route('status.cargo.update')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input id="edit_id" type="hidden" name="id" value="">
                    <div class="form-group">
                        <label>Status Adı</label>
                        <input value="" id="edit_name" class="form-control" type="text" name="name">
                    </div>
                    <button type="submit" class="btn btn-success" >Güncelle</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" >Iptal</button>
                </form>
            </div>
        </div>
    </div>
</div>

