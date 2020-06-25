<!-- The Modal -->
<div class="modal fade" id="createModal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header bg-dark text-white">
                <h4 class="modal-title">Kargo formu !</h4>

                <button type="button" data-dismiss="modal" class="close text-white">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form action="{{route('cargo.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Toplam KG</label>
                        <input step="0.01" class="form-control" type="number" name="total_kg" required >
                    </div>
                    <div class="form-group">
                        <label>Kargo Durumu</label>
                        <select class="form-control" name="status" required>
                            <option selected>Seç</option>
                            @foreach($statuses as $status)
                            <option value="{{$status->id}}">{{$status->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Ödeme Türü</label>
                        <select class="form-control" name="payment_type" required>
                            <option selected disabled>Seç</option>
                            <option value="1">Gönderıcı Öder</option>
                            <option value="2">Alıcı Öder</option>
                        </select>
                    </div>

                    
                    
                    <button type="submit" class="btn btn-success" >Devam et</button>
                </form>
            </div>
        </div>
    </div>
</div>

