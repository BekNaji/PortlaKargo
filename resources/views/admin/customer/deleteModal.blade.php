<!-- The Modal -->
<div class="modal fade" id="deleteModal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Uyarı!</h4>

                <button type="button" data-dismiss="modal" class="close text-white">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">

                <b id="name"></b> adlı veriyi silmeyı onayliyor musun?
                <br>
                <form action="{{route('customer.delete')}}" method="POST">
                    @csrf
                    <input type="hidden" id="id" name="id" value="">
                    <br>
                    <button type="submit" class="btn btn-danger" >Evet</button>
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal" >Iptal</button>
                </form>
            </div>
        </div>
    </div>
</div>

