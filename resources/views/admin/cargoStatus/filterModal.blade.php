<!-- The Modal -->
<div class="modal fade" id="filterModal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Filter</h4>

                <button type="button" data-dismiss="modal" class="close text-white">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form action="{{route('user.index')}}" method="POST">
                    @csrf
                    
                    <button type="submit" class="btn btn-danger" >Evet</button>
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal" >Iptal</button>
                </form>
            </div>
        </div>
    </div>
</div>

