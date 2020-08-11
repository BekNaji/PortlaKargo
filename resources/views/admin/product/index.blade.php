

<div class="card">
<div class="card-body">

	<i class="fa fa-list" aria-hidden="true"></i> Ürünler Listesi&#160;&#160;&#160;
	<button id="create" class="btn btn-success "><i class="fa fa-plus" aria-hidden="true"></i></button> &nbsp;
	
	<hr>

	<table class="table table-bordered" id="dataTable">
		<thead>
			<tr>
				<td>#</td>
				<td>Ad</td>
				<td>Adet</td>
				<td>Ücret</td>
				<td>Toplam Ücret</td>
				<td>#</td>
			</tr>
		</thead>
		<tbody>
			@foreach($products as $product)
			<tr>
				<td>{{$loop->iteration}}</td>
				<td>{{$product->name}} </td>
				<td>{{$product->count}} </td>
				<td>${{$product->cost}} </td>
				<td>${{$product->total}} </td>
				<td>
					<button id="edit"

					data-id="{{$product->id}}"
					data-name="{{$product->name}}"
					data-count="{{$product->count}}"
					data-cost="{{$product->cost}}"
					data-total="{{$product->total_cost}}"
					class="btn btn-warning"><i class="fa fa-edit"></i></button>
					<a id="delete" data-id="{{$product->id}}"
					data-name="{{$product->name}}" href="#delete" class="btn btn-danger"><i class="fa fa-trash-alt"></i></a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
</div>

@include('admin.product.deleteModal')
@include('admin.product.createModal')
@include('admin.product.editModal')
@include('admin.product.filterModal')
@include('admin.product.script')
