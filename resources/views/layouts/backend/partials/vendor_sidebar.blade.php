		<div class="app-sidebar sidebar-shadow">
				<!--<div class="app-header__logo">
					<div class="logo-src"></div>
					<div class="header__pane ml-auto">
						<div>
							<button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar"> <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
								</span>
							</button>
						</div>
					</div>
				</div>
				<div class="app-header__mobile-menu">
					<div>
						<button type="button" class="hamburger hamburger--elastic mobile-toggle-nav"> <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
							</span>
						</button>
					</div>
				</div>
				<div class="app-header__menu"> <span>
                        <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                            <span class="btn-icon-wrapper">
                                <i class="fa fa-ellipsis-v fa-w-6"></i>
                            </span>
					</button>
					</span>
				</div>-->
				<div class="scrollbar-sidebar">
					<div class="app-sidebar__inner">
						<ul class="vertical-nav-menu">
							<li class="app-sidebar__heading">Restaurant ID: {{ Auth::user()->id }}</li>
							<li id="nav-dashboard">
								<li><a href="{{ route('home') }}"> <i class="metismenu-icon pe-7s-graph2"></i>{{trans('sidebar.dashboard')}}</a></li>
								@can('vendor_restaurant-edit')
								<li><a href="{{ route('vendorEdit') }}"> <i class="metismenu-icon pe-7s-graph2"></i> {{trans('sidebar.restaurant_profile')}}</a></li>
								@endcan
							</li>
							
							<li class="app-sidebar__heading">{{trans('sidebar.management')}}</li>
						@can('res_menu-list')
							<li><a href="{{route('products.index') }}"> <i class="metismenu-icon pe-7s-graph"></i>{{trans('sidebar.menu')}}</a></li>
						@endcan
						@can('res_menu_category-list')
							<li><a href="{{ route('menu_categories.index') }}"> <i class="metismenu-icon pe-7s-graph"></i>{{trans('sidebar.menu_category')}}	</a> </li>
						@endcan
						@can('res_coupon-list')
							<li><a href="{{ route('coupons.index') }}"> <i class="metismenu-icon pe-7s-graph"></i>{{trans('sidebar.coupons')}}	</a> </li>
						@endcan
						@can('res_order-list')
							<li><a href="{{ route('orders.index') }}"> <i class="metismenu-icon pe-7s-graph"></i>{{trans('sidebar.orders')}}</a></li>
						@endcan
						@can('variation-list')
							<li><a href="{{ route('variations.index') }}"> <i class="metismenu-icon pe-7s-graph"></i>{{trans('sidebar.variations')}}</a></li>
						@endcan
						@can('addon_group-list')
							<li><a href="{{ route('addon_groups.index') }}"> <i class="metismenu-icon pe-7s-graph"></i>{{trans('sidebar.addon_groups')}}</a></li>
						@endcan
						@can('addon-list')
							<li><a href="{{ route('addons.index') }}"> <i class="metismenu-icon pe-7s-graph"></i>{{trans('sidebar.addons')}}</a></li>
						@endcan
						</ul>
					</div>
				</div>
			</div>