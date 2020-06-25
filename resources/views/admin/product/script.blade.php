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

	$(document).on('click','#edit',function(){
		id 			= $(this).data('id');
		name 		= $(this).data('name');
		count 		= $(this).data('count');
		cost 		= $(this).data('cost');
		total = $(this).data('total');
		$('#id').val(id);
		$('.name').val(name);
		$('#count').val(count);
		$('#cost').val(cost);
		$('#total').val(count*cost);
		$('#editModal').modal('show');
	});

	// show create modal
	$(document).on('click','#create',function(){
		$('#createModal').modal('show');
	});
	$(document).on('keyup','.cost',function(){
		var count = $('.count').val();
		var price = $('.cost').val();
		$('.total').val(count*price);
	});

	$(document).on('keyup','#cost',function(){
		var count = $('#count').val();
		var price = $('#cost').val();
		$('#total').val(count*price);
	});
	$(document).on('keyup','#count',function(){
		var count = $('#count').val();
		var price = $('#cost').val();
		$('#total').val(count*price);
	});


	/*$(document).on('click','#add',function(){
		event.preventDefault();
		var i = 1;
		$('#product').append('<tr id=row'+i+'><td><input class="form-control" type="text" name="name"></td><td><input class="form-control count" type="text" name="count"></td><td><input class="form-control cost" type="text" name="cost"></td><td><button data-id="'+i+'" class="btn btn-danger" id="remove">x</button></td></tr>');
		i++;
	});

	$(document).on('click','#remove',function(event){
		event.preventDefault();
		var row = $(this).data('id');
		$('#row'+row+'').remove();
	});
 */


		

	
});
</script>
@endsection