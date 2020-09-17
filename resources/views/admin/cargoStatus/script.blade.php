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
	// edit modal
	$(document).on('click','#edit',function(){
		id = $(this).data('id');
		name = $(this).data('name');
		type = $(this).data('type');
		sms = $(this).data('sms');
		$('#edit_id').val(id);
		$('#edit_name').val(name);
		//alert(sms);
		if(type == 'personal')
		{
			$("#personal").prop('selected',true);
		}
		if(type == 'kurye')
		{
			$("#kurye").prop('selected',true);
		}
		if(sms == true)
		{
			$('#yes_send').prop('selected',true)
		}
		if(sms == false)
		{
			$('#no_send').prop('selected',true)
		}
		$('#editModal').modal('show');
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
});
</script>
@endsection