<!-- The Modal -->
<div class="modal fade" id="editModal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
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
                     <div class="form-group">
                        <select class="form-control" name="type" required>
                            <option id="personal" value="personal">Personal</option>
                            <option id="kurye" value="kurye">Kurye</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Bu statuye çekildiğinde SMS göndersin mi?</label>
                        <select id="send_sms" class="form-control" name="send_phone" required>
                            <option id="yes_send" value="true">Evet</option>
                            <option id="no_send" value="false">Hayır</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Bu statuye çekilen tüm kayıtlar kapatılsın mı?</label>
                        <select id="public" class="form-control" name="public_status" required>
                            <option id="yes_close" value="0">Evet</option>
                            <option id="no_close" value="1">Hayır</option>
                        </select>
                    </div>
					
					<div class="form-group">
                        <label>SMS Mesaji</label>
                        <textarea id="sms_message" class="form-control" name="sms_message"></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-success" >Güncelle</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" >Iptal</button>
                </form>
            </div>
        </div>
    </div>
</div>

