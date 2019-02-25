@extends('bo_main') 
@section('title', 'Import CSE Catalog') 
@section('admin-active', 'active') 
@section('admin-dropdown-show',
'show') 
@section('cse-active', 'active') 
@section('brand', 'PPMP') 
@section('content')
<!-- 
<h3 style="font-family:Montserrat; padding-top: 0;"> Budget Proposal History &nbsp; </h3> -->
<div class="row" style="padding-left: 30px; padding-right: 20px;">
	<div class="col-lg-12 col-md-12">
		<div class="card">
			<div class="card-body" style="margin-top: 10px; margin-left: 10px; ">
				<p style="font-size: 21px; margin-bottom: 0px; padding-bottom: 0px; bottom: 0;"> IMPORT COMMON SUPPLIES AND EQUIPTMENT CATALOG
					<i class="fas fa-box" style="margin-left: 10px; "></i><br>
					<!-- <span style="font-size: 15px;">Project Procurement Management Plan</span> -->
					<!-- <a href="" data-toggle="modal" data-target="#additem" id="create2"><span class="fas fa-plus fa-xs"></span> </a> -->
				</p><br>

				<!-- <div class="row">
					<div class="col-lg-12"> -->
				<form method="POST" action="{{ route('cse_items.storeByFile') }}" enctype="multipart/form-data">
					@csrf
					{{-- <div class="row" style="padding:0px 30px 5px 30px;">
						<div class="col">
							<div class="form-group">
								<label for="Item Type">Item Type:</label>
								<select name="item_type_id" class="form-control">
									<option selected disabled value="0">--Select Item Type--</option>
									@foreach ($itemTypes as $type)
										<option value="{{ $type->id }}">{{ $type->name }}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div> --}}

					<div class="row" style="padding:0px 30px 5px 30px;">
						<div class="col">
							<div class="form-group">
								<label for="Proposal File">Cse Catalog File:</label>
								<input type="file" class="form-control-file dropify" data-allowed-file-extensions="xlsx xls xml csv" name="catalog_file" />
							</div>
						</div>
					</div><br>

					@include('errors')

					<div style="padding: 10px 0px 20px 300px; width: 60%;" class="text-center">
						<button type="submit" class="btn btn-success btn-block makeppmp">Import Catalog</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
 
@section('scripts')
<script>
	$(document).ready(function(){
		$('.dropify').dropify();
	});

</script>
<!-- <script type="text/javascript">
$('button.makeppmp').click(function(e) {
	e.preventDefault();
	swal({
	  type: 'success',
	  title:'SUCCESS',
	  text: 'Your ppmp was successfully created!',
	  timer: 1500,
	  showCancelButton: false,
	  showConfirmButton: false
	});
	// swal("SUCCESS", "Your ppmp was successfully created", "success");
});
</script> -->
@endsection