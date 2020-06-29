<!-- The Modal -->
<div class="modal fade" id="filterModal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header bg-dark text-white">
                <h4 class="modal-title">Filter</h4>

                <button type="button" data-dismiss="modal" class="close text-white">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form action="{{route('cargo.filter')}}" method="GET">
                    
                    <div class="form-group">
                        <label>Başalngıç Tarihi</label>
                        <input type="date" name="start" class="form-control" max="{{date('Y-m-d')}}">
                    </div>

                    <div class="form-group">
                        <label>Bitiş Tarihi</label>
                        <input type="date" name="end" class="form-control" max="{{date('Y-m-d')}}">
                    </div>

                    <button type="submit" class="btn btn-success" >Ok</button>
                </form>
            </div>
        </div>
    </div>
</div>

