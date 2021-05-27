<!-- The Modal -->
<div class="modal fade" id="createModal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Yenı kullanıcı oluştur!</h4>

                <button type="button" data-bs-dismiss="modal" class="close text-white">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form action="{{route('customer.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                  

                    <div class="form-group">
                        <label>Adı ve Soyad</label>
                        <input class="form-control" type="text" name="name" required>
                    </div>

                    <div class="form-group">
                        <label>Telefon ÖRNEK: 05550156185</label>
                        <input class="form-control" type="number" name="phone" required>
                    </div>

                    <button type="submit" class="btn btn-success" >Kaydet</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" >Iptal</button>
                </form>
            </div>
        </div>
    </div>
</div>

