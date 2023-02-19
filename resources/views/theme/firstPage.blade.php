@extends('layouts.theme.master')

@section('content')
	<main>
        <div class="hero_single version_1">
            <div class="opacity-mask">
                <div class="container">
                    <div class="row align-items-center justify-content-lg-start">
                        <div class="col-12 col-lg-8 col-xl-6">
                            <h1>Delivery or Takeaway Food</h1>
                            <p>The best restaurants at the best price</p>
                            <form method="get" action="javascript:void(0);">
                                <div class="row no-gutters custom-search-input">
                                    <div class="col-lg-10">
                                        <div class="form-group">
                                            <input class="form-control no_border_r" type="text" name="s" id="autocomplete" placeholder="Category, Item Name...">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <button class="btn_1 gradient" type="submit">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
						<div class="col-12 col-xl-6">
							<div class="hero-banner-img">
								<img src="{{ asset('themeAssets/img/web-main-img.svg') }}" alt="hero banner" class="img-fluid"/>
							</div>
						</div>
                    </div>
                    <!-- /row -->
                </div>
            </div>
            <div class="wave hero"></div>
        </div>
        <!-- /hero_single -->
		
		@if($top_categories)
        <!--<div class="container margin_30_60">
            <div class="main_title center">
                <span><em></em></span>
                <h2>Popular Categories</h2>
                <p>Cum doctus civibus efficiantur in imperdiet deterruisset</p>
            </div>
            <div class="owl-carousel owl-theme categories_carousel">
                @foreach($top_categories as $clist)
				<div class="item_version_2">
                    <a href="{{ url('menu') }}">
                        <figure>
                            <span>98</span>
                            <img src="{{ asset('themeAssets/img/location_list_1.jpg') }}" data-src="{{ asset('themeAssets/img/location_list_1.jpg') }}" alt="{{ $clist->title }}" class="owl-lazy" width="350" height="450">
                            <div class="info">
                                <h3>{{ $clist->title }}</h3>
                            </div>
                        </figure>
                    </a>
                </div>
				@endforeach
            </div>
        </div>-->
		@endif
        <!-- /container -->

        <div class="bg_gray">
            <div class="container margin_60_40">
                <div class="main_title">
                    <span><em></em></span>
                    <h2>Top Menu List</h2>
                    <a href="{{ url('/menu') }}">View All &rarr;</a>
                </div>
				@if($top_list)
                <div class="row add_bottom_25">
                    @foreach($top_list as $tlist)
					<div class="col-lg-6">
                        <div class="list_home">
                            <ul>
                                <li>
                                    <a href="{{ url('menu') }}">
                                        <figure>
                                            <img src="@if($tlist->image) {{ asset($tlist->image) }} @else {{ asset(config('constants.DEFAULT_MENU_IMAGE'))}} @endif" data-src="@if($tlist->image) {{ asset($tlist->image) }} @else {{ asset(config('constants.DEFAULT_MENU_IMAGE'))}} @endif" alt="{{ $tlist->title }}" class="lazy" width="350" height="233">
                                        </figure>
                                        <!--<div class="score"><strong>9.5</strong></div>-->
                                        <!--<em>Italian</em>-->
                                        <h3>{{ $tlist->title }}</h3>
                                        <small>{{ $tlist->description }}</small>
                                        <!--<ul>
                                            <li><span class="ribbon off">-30%</span></li>
                                            <li>Average price {{ $tlist->price }}</li>
                                        </ul>-->
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
					@endforeach
                </div>
                @endif
				<!-- /row -->
				
                <div class="banner lazy" data-bg="url({{ asset('themeAssets/img/banner_bg_desktop.jpg') }})">
                    <div class="wrapper d-flex align-items-center opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.3)">
                        <div>
                            <h3>We Deliver to your Place</h3>
                            <p>Enjoy a tasty food in minutes!</p>
                            <a href="{{ url('menu') }}" class="btn_1 gradient">Start Now!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /bg_gray -->

        <div class="shape_element_2">
            <div class="container margin_60_0">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="box_how">
                                    <figure><img src="{{asset('themeAssets/img/easily-order.svg')}}" data-src="{{asset('themeAssets/img/easily-order.svg')}}" alt="" width="150" height="167" class="lazy"></figure>
                                    <h3>Easly Order</h3>
                                    <p>Faucibus ante, in porttitor tellus blandit et. Phasellus tincidunt metus lectus sollicitudin.</p>
                                </div>
                                <div class="box_how">
                                    <figure><img src="{{asset('themeAssets/img/quick-delivery.svg')}}" data-src="{{asset('themeAssets/img/quick-delivery.svg')}}" alt="" width="130" height="145" class="lazy"></figure>
                                    <h3>Quick Delivery</h3>
                                    <p>Maecenas pulvinar, risus in facilisis dignissim, quam nisi hendrerit nulla, id vestibulum.</p>
                                </div>
                            </div>
                            <div class="col-lg-6 align-self-center">
                                <div class="box_how">
                                    <figure><img src="{{asset('themeAssets/img/enjoy-food.svg')}}" data-src="{{asset('themeAssets/img/enjoy-food.svg')}}" alt="" width="150" height="132" class="lazy"></figure>
                                    <h3>Enjoy Food</h3>
                                    <p>Morbi convallis bibendum urna ut viverra. Maecenas quis consequat libero, a feugiat eros.</p>
                                </div>
                            </div>
                        </div>
                        <p class="text-center mt-3 d-block d-lg-none"><a href="{{ url('/register') }}" class="btn_1 medium gradient pulse_bt mt-2">Register Now!</a></p>
                    </div>
                    <div class="col-lg-5 offset-lg-1 align-self-center">
                        <div class="intro_txt">
                            <div class="main_title">
                                <span><em></em></span>
                                <h2>Start Ordering Now</h2>
                            </div>
                            <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed imperdiet libero id nisi euismod, sed porta est consectetur deserunt.</p>
                            <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                            <p><a href="{{ url('/menu') }}" class="btn_1 medium gradient pulse_bt mt-2">Order Now</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- /main -->
@endsection

@section('js')
<script>
  
</script>
@endsection
