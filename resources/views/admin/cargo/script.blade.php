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
});
</script>
@endsection