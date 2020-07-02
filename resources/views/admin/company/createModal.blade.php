<!-- The Modal -->
<div class="modal fade" id="createModal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header bg-dark text-white">
                <h4 class="modal-title">Şirket Oluştur oluştur!</h4>

                <button type="button" data-dismiss="modal" class="close text-white">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form action="{{route('company.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="form-group">
                        <label>Şirket Adı</label>
                        <input class="form-control" type="text" name="name">
                    </div>
                    <div class="form-group">
                        <label>Email </label>
                        <input class="form-control" type="text" name="email">
                    </div>

                    <div class="form-group">
                        <label>Telefon</label>
                        <input class="form-control" type="text" name="phone">
                    </div>

                    <button type="submit" class="btn btn-success" >Kaydet</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" >Iptal</button>
                </form>
            </div>
        </div>
    </div>
</div>

