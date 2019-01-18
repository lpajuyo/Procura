@extends('bo_main') 

@section('title', 'View PPMP')


@section('content')
<div class="row" >
	<div class="col-lg-12 col-md-12">
		<div class="card">
			<div class="card-body" style="margin-top: 10px; margin-left: 10px; ">
				<p style="font-size: 20px; margin-bottom: 0px; padding-bottom: 0px; bottom: 0;"> CREATE PURCHASE REQUEST
					<i class="fas fa-edit" style="margin-left:10px;"></i>
					<br>
				</p><br>
				
				<div class="row" style="padding: 5px 10px 30px 20px;">
				<div class="col-lg-12">
				<form>

					<div class="row">
						<div class="col-lg-5 col-md-5">
							<div class="form-group">
								<label for="Item">Item:</label>
								<select class="form-control" id="PR Item">
									<option>1</option>
								</select>
							</div>
						</div>

						<div class="col-lg-2">
			               <div class="form-group">
			                  <label for="Quantity">Quantity:</label>
			                  <input name="quantity" value="" type="number" class="form-control" id="Qty">
			               </div>
			            </div>

					    <div class="col-lg-2">
			               <div class="form-group">
			                  <label for="Unit Cost">Unit Cost:</label>
			                  <input name="unitcost" value="" type="text" class="form-control" id="unitcost">
			               </div>
			            </div>

			            <div class="col-lg-2">
			               <div class="form-group">
			                  <label for="Total Price">Total Price</label>
			                  <input name="Total" value="" type="text"  class="form-control" id="total" disabled>
			               </div>
			            </div>
					</div>

					<div class="row">
						<div class="col-lg-5">
							<div class="form-group">
			                    <label for="Description">Item Description:</label>
			                    <textarea class="form-control" id="description" rows="10" style="max-height: 20vh;"></textarea>
			                </div>
						</div>

						<div class="col-lg-6">
						  <div class="form-group">
							<label for="purpose">Purpose:</label>
							<textarea class="form-control" id="purpose" rows="10" style="max-height: 20vh;"></textarea>
						  </div>
						</div>
					</div><br>


					<div class="row" style="margin-left:170px;">
							<div class="col-lg-4">
								<div style="" class="text-center">
									<button type="submit" class="btn btn-info btn-block makeppmp">Add Item</button>
								</div>
							</div>
							<div class="col-lg-4">
								<div style="" class="text-center">
									<a href=""><button type="button" class="btn btn-success btn-block makeppmp">Done</button></a>
								</div>
							</div>	
						</div>

				</form>
				</div>
				</div>

			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="card">
			<div class="card-body" style="margin-top: 10px; margin-left: 10px; ">
				<p style="font-size: 20px; margin-bottom: 0px; padding-bottom: 0px; bottom: 0;"> PURCHASE REQUEST DETAILS
					<i class="fas fa-info-circle" style="margin-left: 10px; "></i><br>
				</p><br>

				<table class="table table-bordered" style="margin: : 0px 50px 20px 40px;" >
						<thead class="text-center text-info">
						<tr style="font-weight: bolder;">
							<td rowspan="2">ITEM</td>
							<td rowspan="2">ITEM DESCRIPTION</td>
							<td rowspan="2">QTY</td>
							<td rowspan="2">UNIT PRICE</td>
							<td rowspan="2">TOTAL PRICE</td>
							<td rowspan="2">PURPOSE</td>
						</tr>
						</thead>
						<tbody style="font-size: 12px;">
						<tr class="text-center" style="line-height: 10px;">
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr><br>
						</tbody>
					</table>
					<br>
			</div>
		</div>
	</div>
</div>
@endsection
