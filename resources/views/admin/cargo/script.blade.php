@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dayjs/1.10.4/dayjs.min.js" integrity="sha512-0fcCRl828lBlrSCa8QJY51mtNqTcHxabaXVLPgw/jPA5Nutujh6CbTdDgRzl9aSPYW/uuE7c4SffFUQFBAy6lg==" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            var old_html = $('#search_result').html();
            var old_count = $('#cargo_count').text();
            $('#search').keyup(function(){
                var val = $(this).val();
                $.ajax({
                    url:"{{route('cargo.search')}}",
                    type:'GET',
                    data:{key: val},
                    success:function(res)
                    {
                        if(val == ''){
                            $('#cargo_count').text(old_count);
                            return $('#search_result').html(old_html);
                        }
                        $('#cargo_count').text(res.count);
                        $('#search_result').html(res.html);
                        return true;
                    }
                })
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
                    Swal.fire({
                        icon: "warning",
                        title: "Seçilmiş oğe bulunamadı!"
                    });
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
                    Swal.fire({
                        icon: "warning",
                        title: "Seçilmiş oğe bulunamadı!"
                    });
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
