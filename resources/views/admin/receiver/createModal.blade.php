<!-- The Modal -->
<div class="modal fade" id="createModal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header bg-dark text-white">
                <h4 class="modal-title">Alıcı Formu!</h4>

                <button type="button" data-dismiss="modal" class="close text-white">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form action="{{route('receiver.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Adı</label>
                        <input class="form-control" type="text" name="name" required>
                    </div>

                    <div class="form-group">
                        <label>Soyad</label>
                        <input class="form-control" type="text" name="surname" required>
                    </div>

                    <div class="form-group">
                        <label>Passport</label>
                        <input class="form-control" type="text" name="passport">
                    </div>


                    <div class="form-group">
                        <label>Telefon</label>
                        <input class="form-control" type="text" name="phone" required>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" type="email" name="email">
                    </div>

                    <div class="form-group">
                        <label>Ülke</label>
                        <input class="form-control" type="text" name="country" required>
                    </div>

                    <div class="form-group">
                        <label>Şehir</label>
                        <input class="form-control" type="text" name="city" required>
                    </div>

                    <div class="form-group">
                        <label>Address</label>
                        <textarea name="address" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Passport Resmi</label>
                        <input type="file" name="passport_image">
                    </div>
                    <button type="submit" class="btn btn-success" >Kaydet</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" >Iptal</button>
                </form>
            </div>
        </div>
    </div>
</div>

