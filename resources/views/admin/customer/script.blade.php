@section('js')
<script type="text/javascript">
$(document).ready(function(){
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

	$('#selectAll').click(function(){
		if ($(this).prop('checked')) {
            $('.sender').prop('checked', true);
        } else {
            $('.sender').prop('checked', false);
        }
	});

	// show send message modal
	$(document).on('click','#sendSms',function(){
		var id = [];
		$('.sender:checked').each(function(){
			id.push($(this).data('id'));
		});
		if(id.length > 0)
		{
			$('#senderIds').val(id);
			$('#sendSmsModal').modal('show');
		}else
		{
			Swal.fire({
				icon: "warning",
				title: "Seçilmiş öğe bulunamadı!"
			});
		}
		
	});

	// show password scripts
	$(document).on('click','#showPassword',function(){
		if($(this).prop('checked') == true ){
			$('#password').attr('type','text');
		}else{
			$('#password').attr('type','password');
		}
	});

});
</script>
@endsection