<!-- The Modal -->
<div class="modal fade" id="createModal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Yenı Status oluştur!</h4>

                <button type="button" data-bs-dismiss="modal" class="close text-white">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form action="{{route('status.cargo.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Status Adı</label>
                        <input class="form-control" type="text" name="name" required>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="type" required>
                            <option value="" selected>Seç</option>
                            <option value="personal">Personal</option>
                            <option value="kurye">Kurye</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Bu statuye çekildiğinde SMS göndersin mi?</label>
                        <select class="form-control" name="send_phone" required>
                            <option value="" selected>Seç</option>
                            <option id="yes_send" value="true">Evet</option>
                            <option id="no_send" value="false">Hayır</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Bu statuye çekilen tüm kayıtlar kapatılsın mı?</label>
                        <select class="form-control" name="public_status" required>
                            <option value="" selected>Seç</option>
                            <option  value="0">Evet</option>
                            <option  value="1">Hayır</option>
                        </select>
                    </div>
					<div class="form-group">
                        <label>SMS Mesaji</label>
                        <textarea class="form-control" name="sms_message"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success" >Kaydet</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" >Iptal</button>
                </form>
            </div>
        </div>
    </div>
</div>

