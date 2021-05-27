<!-- The Modal -->
<div class="modal fade" id="createModal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Alıcı Formu!</h4>

                <button type="button" data-dismiss="modal" class="close text-white">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form action="{{route('receiver.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Ad ve Soyad</label>
                        <input class="form-control" type="text" name="name" required>
                    </div>
                    <div class="form-group">
                        <label>Passport</label>
                        <input class="form-control" type="text" name="passport">
                    </div>

                    <div class="form-group">
                        <label>Telefon 1</label>
                        <input class="form-control" type="number" name="phone" required>
                    </div>

                    <div class="form-group">
                        <label>Telefon 2</label>
                        <input class="form-control" type="number" name="other_phone">
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <textarea name="address" class="form-control"></textarea>
                    </div>

                    <button type="submit" class="btn btn-success" >Kaydet</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" >Iptal</button>
                </form>
            </div>
        </div>
    </div>
</div>

