@extends('layouts.theme.master')

@section('css')
<style>
  .poplr-dish > img{border-radius: inherit;}
  .rih > img{max-width: 50px;}
</style>
@endsection

@section('content')
	<main>
		<nav class="secondary_nav sticky_horizontal">
		    <div class="container">
		        <ul id="secondary_nav">
		        	@foreach($menu as $clist)
		            <li><a class="list-group-item list-group-item-action" href="#section-{{ $clist->id }}">{{ $clist->title }}</a></li>
		            @endforeach
		        </ul>
		    </div>
		    <span></span>
		</nav>
		<!-- /secondary_nav -->

		<div class="bg_gray">
		    <div class="container margin_detail">
		        <div class="row">
		            <div class="col-lg-8 list_menu">
		                @foreach($menu as $key=> $clist)
		                <section id="section-{{ $clist->id }}">
		                    <h4>{{ $clist->title }}</h4>
							{{--
							<div class="table_wrapper">
								<table class="table cart-list menu-gallery">
									<tbody>
										@if($clist->products)
										@foreach($clist->products as $pkey=> $plist)
										<tr>
											<td class="d-md-flex align-items-center">
												<figure><a href="@if($plist->image) {{ asset($plist->image) }} @else {{ asset(config('constants.DEFAULT_MENU_IMAGE'))}} @endif" title="{{ $plist->title }}" data-effect="mfp-zoom-in"><img src="@if($plist->image) {{ asset($plist->image) }} @else {{ asset(config('constants.DEFAULT_MENU_IMAGE'))}} @endif" alt="thumb" class="lazy"></a></figure>
												<div class="flex-md-column">
													<h4>{{ $plist->title }}</h4>
													<p class="mt-2 mb-1"><strong>{{ $plist->price }}</strong></p>
													<p>{{ $plist->description }}</p>
												</div>
											</td>
											<td class="options">
												<div class="dropdown dropdown-options">
													@if(Auth::user())
													  <a class="menu_item modal_dialog" href="#modal-dialog" data-att-id="{{ $plist->id }}" data-att-title="{{ $plist->title }}"><i class="icon_plus_alt2"></i></a>
													@else
													  <a class="menu_item modal_dialog" href="#sign-in-dialog"><i class="icon_plus_alt2"></i></a>
													@endif
												</div>
											</td>
										</tr>
										@endforeach
										@endif
									</tbody>
								</table>
							</div>
							--}}
							
		                    <div class="row">
		                    	@if($clist->products)
		                    	@foreach($clist->products as $pkey=> $plist)
		                        <div class="col-md-6">
									@if(Auth::user())
									  <a class="menu_item modal_dialog" href="#modal-dialog" data-att-id="{{ $plist->id }}" data-att-title="{{ $plist->title }}">
									@else
									  <a class="menu_item modal_dialog" href="#sign-in-dialog">
									@endif
		                                <figure><img src="@if($plist->image) {{ asset($plist->image) }} @else {{ asset(config('constants.DEFAULT_MENU_IMAGE')) }} @endif" data-src="@if($plist->image) {{ asset($plist->image) }} @else {{ asset(config('constants.DEFAULT_MENU_IMAGE')) }} @endif" alt="thumb" class="lazy"></figure>
		                                <h3>{{ $plist->title }}</h3>
		                                <p>{{ $plist->description }}</p>
		                                <strong>{{ $plist->price }}</strong>
		                            </a>
		                        </div>
		                        @endforeach
		                        @endif
		                    </div>
		                </section>
		                @endforeach
		            </div>
		            <!-- /col -->

		            <div class="col-lg-4" id="sidebar_fixed">
		                <div class="box_order mobile_fixed">
		                    <div class="head">
		                        <h3>Order Summary</h3>
		                        <a href="javascript:void(0);" class="close_panel_mobile"><i class="icon_close"></i></a>
		                    </div>
		                    <!-- /head -->
		                    <div class="main">
		                        <ul id="order-list-inner" class="clearfix"></ul>
		                        <ul class="clearfix">
		                            <!--<li>Subtotal<span id="sub_total">0.00</span></li>
		                            <li>Delivery fee<span id="delivery_fee">0.00</span></li>-->
		                            <li class="total">Total<span id="total">0.00</span></li>
		                        </ul>
		                        <div class="btn_1_mobile">
		                            <a href="{{ url('/checkout') }}" class="btn_1 gradient full-width mb_5">Checkout</a>
		                        </div>
		                    </div>
		                </div>
		                <!-- /box_order -->
		                <div class="btn_reserve_fixed"><a href="javascript:void(0);" class="btn_1 gradient full-width">View Basket</a></div>
		            </div>
		        </div>
		        <!-- /row -->
		    </div>
		    <!-- /container -->
		</div>
	</main>
	
	<!-- Modal item order -->
	<div id="modal-dialog" class="zoom-anim-dialog mfp-hide">
		<div class="small-dialog-header">
			<h3 id="modal_dialog-title"></h3>
		</div>
		<div class="content">
			<h5>Quantity</h5>
			<div class="numbers-row">
				<input type="text" value="1" id="qty" class="qty2 form-control" name="quantity">
			</div>
			<!--<h5>Size</h5>
			<ul id="variation-list" class="clearfix">
				<li>
					<label class="container_radio">Medium<span>+ $3.30</span>
						<input type="radio" value="option1" name="options_1">
						<span class="checkmark"></span>
					</label>
				</li>
				<li>
					<label class="container_radio">Large<span>+ $5.30</span>
						<input type="radio" value="option2" name="options_1">
						<span class="checkmark"></span>
					</label>
				</li>
				<li>
					<label class="container_radio">Extra Large<span>+ $8.30</span>
						<input type="radio" value="option3" name="options_1">
						<span class="checkmark"></span>
					</label>
				</li>
			</ul>
			<h5>Extra Ingredients</h5>
			<ul id="add-ons-list" class="clearfix">
				<li>
					<label class="container_check">Extra Tomato<span>+ $4.30</span>
						<input type="checkbox">
						<span class="checkmark"></span>
					</label>
				</li>
				<li>
					<label class="container_check">Extra Peppers<span>+ $2.50</span>
						<input type="checkbox">
						<span class="checkmark"></span>
					</label>
				</li>
				<li>
					<label class="container_check">Extra Ham<span>+ $4.30</span>
						<input type="checkbox">
						<span class="checkmark"></span>
					</label>
				</li>
			</ul>-->
		</div>
		<div class="footer">
			<div class="row small-gutters">
				<div class="col-md-4">
					<button type="reset" class="close-box btn_1 outline full-width mb-mobile">Cancel</button>
				</div>
				<div class="col-md-8">
				<input id="item_id" type="hidden" value="" />
					<button type="reset" class="btn_1 full-width" onclick="addToCart()">Add to cart</button>
				</div>
			</div>
		</div>
	</div>
	<!-- /Modal item order -->
@endsection

@section('js')
<script>
	$(document).ready(function(e) {
		cartList();
	});
</script>
@endsection
