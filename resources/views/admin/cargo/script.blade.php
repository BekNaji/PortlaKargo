@section('js')
<script type="text/javascript">
$(document).ready(function(){
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