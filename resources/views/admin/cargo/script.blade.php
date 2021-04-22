@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dayjs/1.10.4/dayjs.min.js" integrity="sha512-0fcCRl828lBlrSCa8QJY51mtNqTcHxabaXVLPgw/jPA5Nutujh6CbTdDgRzl9aSPYW/uuE7c4SffFUQFBAy6lg==" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            function makeTable(datas){
                var html = '';
                html +='<table class="table"><thead><tr>'+
                    '<td><input type="checkbox" id="selectAll"></td>'+
                    '<td><b>#</b></td>'+
                    '<td><b>Kullanıcı</b></td>'+
                    '<td><b>Takip No</b></td>'+
                    '<td><b>Durum</b></td>'+
                    '<td><b>Ödeme</b></td>'+
                    '<td><b>Göderici</b></td>'+
                    '<td><b>Alıcı</b></td>'+
                    '<td><b>Toplam Kg</b></td>'+
                    '<td><b>Kargo Ücreti</b></td>'+
                    '<td><b>Oluşturma Tarih</b></td>'+
                    '<td><b>#</b></td></tr></thead><tbody>';

                $.each(datas,function(index,data){
                    <?php $id = '<script>document.writeln(data.id)</script>'; ?>
                        html +='<tr>'+
                        '<td><input class="cargo" type="checkbox" name="cargo[]" data-id="'+data.id+'"></td>'+
                        '<td>'+ index +'</td>'+
                        '<td>'+ data.user.name+'</td>'+
                        '<td>'+ data.number +'</td>'+
                        '<td>'+ data.cargo_status.name+'</td>'+
                        '<td>'+ getPayType(data.payment_type) +'</td>'+
                        '<td>'+ data.sender.name +'</td>'+
                        '<td>'+ data.receiver.name +'</td>'+
                        '<td>'+ data.total_kg +'</td>'+
                        '<td>'+ data.cargo_price +'</td>'+
                        '<td>'+ dayjs(data.created_at).format("DD-MM-YYYY H:mm") +'</td>'+
                        '<td>'+
                        '<a target="_blank" href="{{route("cargo.print",encrypt($id))}}" ><span class="badge badge-info"><i class="fa fa-print"></i></span></a>'+
                        '<a target="_blank" href="{{route("cargo.show",encrypt($id))}}" ><span class="badge badge-warning"><i class="fa fa-edit"></i></span></a>'+
                        '<a href="#" id="delete" data-id="'+data.id+'" data-name="'+data.number+'" ><span class="badge badge-danger"><i class="fa fa-trash-alt"></i></span></a>'+
                        '</td></tr>';

                });
                html +='</tbody></table>';
                return html;
            }
            function getPayType(v){ return v == 1 ? 'Gönderici' : 'Alıcı';}
            var old_html = $('#search_result').html();
            
            $('#search').keyup(function(){
                var val = $(this).val();
                $.ajax({
                    url:"{{route('cargo.search')}}",
                    type:'GET',
                    data:{key: val},
                    success:function(res)
                    {
                        console.log(res);
                        //var datas = JSON.parse(res);
                        if(val == '')
                        {
                            return $('#search_result').html(old_html);
                        }
                        $('#search_result').html('');
                        $('#search_result').html(res.html);
                        return true;
                    }
                })
            });


            $(document).on('change','#limit',function(){
                let id = $(this).val();

                window.location.replace("{{URL::to('/dashboard/cargo/index?limit=')}}"+id+"");
            });
            // show delete modal
            $(document).on('click','#delete',function(){
                id = $(this).data('id');
                name = $(this).data('name');
                $('#id').val(id);
                $('#name').text(name);
                $('#deleteModal').modal('show');
            });

            // show create modal
            $(document).on('click','#create',function(){
                $('#createModal').modal('show');
            });


            // show filter modal
            $(document).on('click','#filter',function(){
                $('#filterModal').modal('show');
            });

            // show manafes modal
            $(document).on('click','#manafes',function(){
                $('#excelModal').modal('show');
            });

            // show send message modal
            $(document).on('click','#sendMessageTelegram',function(){
                var id = [];
                $('.cargo:checked').each(function(){
                    id.push($(this).data('id'));
                });
                if(id.length > 0)
                {
                    $('#cargoIdsforTelegram').val(id);
                    $('#sendMessageTelegramModal').modal('show');
                }else
                {
                    toastr.warning("Seçilmiş oğe bulunamadı!");
                }

            });

            // show Change Status modal
            $(document).on('click','#change',function(){
                var id = [];
                $('.cargo:checked').each(function(){
                    id.push($(this).data('id'));
                });
                if(id.length > 0)
                {
                    $('#cargoIds').val(id);
                    $('#changeStatusModal').modal('show');
                }else
                {
                    toastr.warning("Seçilmiş oğe bulunamadı!");
                }

            });

            $(document).on('keyup','#sender_passport',function(){
                alert("test");
            });

            $('#selectAll').click(function(){
                if ($(this).prop('checked')) {
                    $('.cargo').prop('checked', true);
                } else {
                    $('.cargo').prop('checked', false);
                }
            });


            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });


    </script>
@endsection
