		<div class="app-sidebar sidebar-shadow">
			<div class="scrollbar-sidebar">
				<div class="app-sidebar__inner">
					<ul class="vertical-nav-menu">
						<li class="app-sidebar__heading">
							<a class="{{ Request::is('backend/dashboard*') ? 'mm-active' : '' }}" href="{{ route('dashboard') }}"><i class="metismenu-icon pe-7s-graph2"></i>{{trans('sidebar.dashboard')}}</a>
						</li>
						
						<li class="app-sidebar__heading">
							<a href="javascript:void(0);"> <i class="metismenu-icon pe-7s-graph"></i> Orders <span class="badge badge-pill badge-danger ml-0 mr-2 nav-order-count">0</span></a> <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i></a>
							<ul>
								<li><a class="{{ Request::is('backend/orders*') ? 'mm-active' : '' }}" href="{{ route('orders.index') }}"> <i class="metismenu-icon pe-7s-graph"></i>{{trans('sidebar.orders')}}</a></li>
							</ul>
						</li>
						
						<li class="app-sidebar__heading">
							<a class="{{ Request::is('backend/outlets*') ? 'mm-active' : '' }}" href="{{ route('outlets.index') }}"> <i class="metismenu-icon pe-7s-graph"></i> Outlets</a>
						</li>
						
						<li class="app-sidebar__heading">
							<a class="{{ Request::is('backend/banners*') ? 'mm-active' : '' }}" href="{{ route('banners.index') }}"> <i class="metismenu-icon pe-7s-graph"></i> Banners</a>
						</li>
						
						<li class="app-sidebar__heading">
							<a class="{{ Request::is('backend/users*') ? 'mm-active' : '' }}" href="{{ route('users.index') }}"> <i class="metismenu-icon pe-7s-graph"></i> Users</a>
						</li>
						
						<li class="app-sidebar__heading">
							<a href="javascript:void(0);"> <i class="metismenu-icon pe-7s-graph"></i> Settings<i class="metismenu-state-icon pe-7s-angle-down caret-left"></i></a>
							<ul>
								<li><a class="{{ Request::is('backend/general-settings*') ? 'mm-active' : '' }}" href="{{ route('general-settings') }}"><i class="metismenu-icon"></i>General Settings</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</div>