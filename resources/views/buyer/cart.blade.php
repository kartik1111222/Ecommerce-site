@extends('buyer.layouts.master')
@section('content')


<!-- Shoping Cart -->
<form class="bg0 p-t-75 p-b-85">
	<div class="container">
		<div class="row">
			<div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
				<div class="m-l-25 m-r--38 m-lr-0-xl">
					<div class="wrap-table-shopping-cart">

						<table class="table-shopping-cart">
							<tr class="table_head">
								<th class="column-1">Product</th>
								<th class="column-2"></th>
								<th class="column-3">Price</th>
								<th class="column-4">Quantity</th>
								<th class="column-5">Total</th>
								<th class="column-5">Action</th>
							</tr>
							@php
							$subtotal = 0;
							@endphp

							@foreach($items as $item)

							@php
							$subtotal = $subtotal + $item->total_price
							@endphp

							@php( $image = explode(",",$item->image->images) )
							<tr class="table_row">
								<td class="column-1">
									<div class="how-itemcart1">
										<img src="{{asset('assets/images/items/'.$image[0])}}" alt="IMG">
									</div>
								</td>
								<td class="column-2">{{$item->item->name}}</td>
								<td class="column-3">{{$item->item->price}} ₹</td>
								<td class="column-4">

									<input type="hidden" class="form-control" id="item_id" value="{{$item->item->id}}">

									<input type="hidden" id="price" value="{{$item->item->price}}">
									<!-- <input type="hidden" value="{{$item->price}}" id="total_price{{$item->id}}"> -->

									<div class="wrap-num-product flex-w m-l-auto m-r-0">
										<div id="decrement_btn" class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
											<i class="fs-16 zmdi zmdi-minus"></i>
										</div>

										<input class="mtext-104 cl3 txt-center num-product" type="number" name="quantity" value="{{$item->product_qty}}" id="qty">


										<div id="increment_btn" class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
											<i class="fs-16 zmdi zmdi-plus"></i>
										</div>
									</div>
								</td>
								<td class="column-5">₹ {{$item->total_price}}</td>
								<td class="column-6">
									<button onclick="deleteProduct({{$item->id}})" class="btn btn-danger">Remove</button>
								</td>
							</tr>
							@endforeach
						</table>

					</div>

					<div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
						<div class="flex-w flex-m m-r-20 m-tb-5">


						</div>

						<div class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
							Update Cart
						</div>
					</div>
				</div>
			</div>

			<div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
				<div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
					<h4 class="mtext-109 cl2 p-b-30">
						Cart Totals
					</h4>

					<div class="flex-w flex-t bor12 p-b-13">
						<div class="size-208">
							<span class="stext-110 cl2">
								Subtotal:
							</span>
						</div>

						<div class="size-209">
							<span class="mtext-110 cl2">
								₹ {{$subtotal}}
							</span>
						</div>
					</div>

					<div class="flex-w flex-t bor12 p-t-15 p-b-30">
						<div class="size-208 w-full-ssm">
							<span class="stext-110 cl2">
								Shipping:
							</span>
						</div>

						<div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
							<p class="stext-111 cl6 p-t-2">
								There are no shipping methods available. Please double check your address, or contact us if you need any help.
							</p>

							<div class="p-t-15">
								<span class="stext-112 cl8">
									Calculate Shipping
								</span>

								<div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
									<select class="js-select2" name="time">
										<option>Select a country...</option>
										<option>USA</option>
										<option>UK</option>
									</select>
									<div class="dropDownSelect2"></div>
								</div>

								<div class="bor8 bg0 m-b-12">
									<input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="state" placeholder="State /  country">
								</div>

								<div class="bor8 bg0 m-b-22">
									<input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="postcode" placeholder="Postcode / Zip">
								</div>

								<div class="flex-w">
									<div class="flex-c-m stext-101 cl2 size-115 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer">
										Update Totals
									</div>
								</div>

							</div>
						</div>
					</div>

					<div class="flex-w flex-t p-t-27 p-b-33">
						<div class="size-208">
							<span class="mtext-101 cl2">
								Total:
							</span>
						</div>

						<div class="size-209 p-t-1">
							<span class="mtext-110 cl2">
								₹ {{$subtotal}}
							</span>
						</div>
					</div>

					<button class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
						Proceed to Checkout
					</button>
				</div>
			</div>
		</div>
	</div>
</form>
@endsection

@push('scripts')
<script>
	$("#increment_btn , #decrement_btn").click(function() {

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		event.preventDefault();
		var item_id = $("#item_id").val();
		var price = $("#price").val();
		var quantity = $("#qty").val();

		var url = "{{route('buyer.update_cart')}}";


		$.ajax({
			url: url,
			type: 'POST',
			data: {
				id: item_id,
				price: price,
				quantity: quantity
			},
			dataType: 'json',
			success: function(response) {
				window.location.reload();
			}
		})
	});
</script>

<script>
	function deleteProduct($id) {
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		event.preventDefault();

		var url = "{{route('buyer.cart_item_delete',['_id_'])}}";
		var delete_url = url.replace(['_id_'], $id);

		$.ajax({
			url: delete_url,
			type: 'DELETE',
			dataType: 'json',
			success: function(response) {
				
				window.location.reload();
			}
		})
	}
</script>


@endpush