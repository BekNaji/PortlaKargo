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
	// show password scripts
	$(document).on('click','#showPassword',function(){
		if($(this).prop('checked') == true ){
			$('#password').attr('type','text');
		}else{
			$('#password').attr('type','password');
		}
	});

	// show send message modal
	$(document).on('click','.page_id',function(){
		var id = [];
		$('.page_id:checked').each(function(){
			id.push($(this).data('id'));
		});
		
		$('#permissons_ids').val(id);
	});
});
</script>
@endsection