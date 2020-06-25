<!-- The Modal -->
<div class="modal fade" id="editModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header bg-dark text-white">
                <h4 class="modal-title">Yenı Ürün ekle</h4>

                <button type="button" data-dismiss="modal" class="close text-white">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form action="{{route('product.update')}}" method="POST">
                    @csrf
                    <input type="hidden" name="cargoId" value="{{$cargo->id}}" >
                    <input id="productId" type="hidden" name="id" value="" >
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td>Ürün adı</td>
                                <td>Adet</td>
                                <td>Ücret</td>
                                <td>Toplam Ücret</td>
                            </tr>
                        </thead>
                        <tbody id="product" >
                            <tr class="product" >
                                <td><input id="name" class="form-control name" type="text" name="name"></td>
                                <td><input id="count" class="form-control count" type="text" name="count"></td>

                                <td><input id="cost" class="form-control cost" type="text" name="cost"></td>
                                <td><input id="total" class="form-control total" type="text" name="total"></td>
                                
                            </tr>
                        </tbody>
                    </table>
                    <br><br>
                    
                    

                    <button type="submit" class="btn btn-success" >Güncelle</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" >Iptal</button>
                </form>
            </div>
        </div>
    </div>
</div>

