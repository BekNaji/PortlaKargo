<!-- The Modal -->
<div class="modal fade" id="sendSmsModal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header bg-dark text-white">
                <h4 class="modal-title">SMS gönder!</h4>

                <button type="button" data-dismiss="modal" class="close text-white">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form action="{{route('customer.send.sms')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                  
                    <input type="hidden" name="ids" id="senderIds">

                    <div class="form-group">
                        <label>Mesaj * 255</label>
                        <textarea name="sms" class="form-control"></textarea>
                    </div>

                    <button type="submit" class="btn btn-success" >Gönder</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" >Iptal</button>
                </form>
            </div>
        </div>
    </div>
</div>

