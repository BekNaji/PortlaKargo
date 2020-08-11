<!-- The Modal -->
<div class="modal fade" id="createModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header bg-dark text-white">
                <h4 class="modal-title">Yenı Ürün ekle</h4>

                <button type="button" data-dismiss="modal" class="close text-white">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form action="{{route('product.store')}}" method="POST">
                    @csrf
                    <input type="hidden" name="cargoId" value="{{$cargo->id}}" >
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

                                <td>
                                    <input class="form-control" type="text" name="name" required>
                                </td>
                                <td>
                                    <input class="form-control count" type="number" name="count" required>
                                </td>

                                <td>
                                    <input class="form-control cost" type="number" name="cost" required step="0.01">
                                </td>
                                <td>
                                    <input class="form-control total" type="text" name="total" readonly>
                                </td>
                                
                            </tr>
                        </tbody>
                    </table>
                    <br><br>
                    
                    

                    <button type="submit" class="btn btn-success" >Kaydet</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" >Iptal</button>
                </form>
            </div>
        </div>
    </div>
</div>

