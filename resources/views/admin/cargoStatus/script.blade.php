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
		var id = $(this).data('id');
		var name = $(this).data('name');
		var type = $(this).data('type');
		var sms = $(this).data('sms');
		var public = $(this).data('public');
		var sms_message = $(this).data('sms_message');
		
		
		$('#edit_id').val(id);
		$('#edit_name').val(name);
		$('#sms_message').val(sms_message);
		//alert(sms);
		if(type == 'personal')
		{
			$("#personal").prop('selected',true);
		}
		if(type == 'kurye')
		{
			$("#kurye").prop('selected',true);
		}
		if(sms == true || sms == 'true')
		{
			$("#send_sms option[value=true]").prop('selected',true)
		}
		if(sms == false || sms == 'false')
		{
			$("#send_sms option[value=false]").prop('selected',true)
		}
		if(public == 1)
		{
			$("#public option[value=1]").prop('selected',true)
		}
		if(public == 0)
		{
			$("#public option[value=0]").prop('selected',true)
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