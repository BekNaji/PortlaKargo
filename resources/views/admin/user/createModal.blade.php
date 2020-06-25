<!-- The Modal -->
<div class="modal fade" id="createModal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header bg-dark text-white">
                <h4 class="modal-title">Yenı kullanıcı oluştur!</h4>

                <button type="button" data-dismiss="modal" class="close text-white">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form action="{{route('user.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Kullanıcı Tam adı</label>
                        <input class="form-control" type="text" name="name">
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input  class="form-control" type="text" name="email">
                    </div>

                    <div class="form-group">
                        <label>Parola</label>
                        <input id="password" class="form-control" type="password" name="password">
                        <input type="checkbox" name="show" id="showPassword"> Parolayı göster
                    </div>
                    <div class="form-group">
                        <label>Resim</label><br>
                        <input type="file" name="image" >
                    </div>
                    <button type="submit" class="btn btn-success" >Kaydet</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" >Iptal</button>
                </form>
            </div>
        </div>
    </div>
</div>

