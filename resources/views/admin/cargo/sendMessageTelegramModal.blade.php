<!-- The Modal -->
<div class="modal fade" id="sendMessageTelegramModal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header ">
                <h4 class="modal-title">Kargo durum bilgilendirme !</h4>
                <button type="button" data-bs-dismiss="modal" class="close text-white">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form action="{{route('telegram.send.multiple.message')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="ids" value="" id="cargoIdsforTelegram" class="form-control">
                    <p>Seçmiş olduğunuz kayıtların müşterisine Kargo durumu hakkında bilgilendirme göndermek istiyormusunuz ?</p>
                    <div class="form-goup">
                        <label>Seçim</label>
                        <select class="form-control" name="status">
                            <option value="yes">Evet</option>
                            <option value="no">Hayır</option>
                        </select>
                    </div>
                    <br>
                    <div class="form-group">
                        <label>Özel mesaj ( isteye bağlı )</label>
                        <textarea name="sms" class="form-control"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success" >Evet</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" >Iptal</button>
                    
                    
                </form>
            </div>
        </div>
    </div>
</div>