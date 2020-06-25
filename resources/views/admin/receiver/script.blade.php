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

	$(document).on('keyup','#passport',function(){
		var key = $(this).val();
		$.ajax({
			url:'{{route('receiver.get')}}',
			method:'GET',
			data:{data:key},
			success:function(data)
			{
				if(data != '')
				{
					$('#result').html('<a href="#" class="list-group-item list-group-item-action">'+data[0].name+'</a>');
					$(document).on('click','#result',function()
					{
						$("#id").val(data[0].id);
						$("#name").val(data[0].name);
						$("#surname").val(data[0].surname);
						$("#phone").val(data[0].phone);
						$("#email").val(data[0].email);
						$("#country").val(data[0].country);
						$("#city").val(data[0].city);
						$("#address").val(data[0].address);
						$('#result').hide();
					});
					
				}

			}
		});
	});
});
</script>
@endsection