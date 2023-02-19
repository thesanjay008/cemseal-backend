		<div class="app-header header-shadow">
			<div class="app-header__logo">
				<a class="logo-hdr" href="{{ url('/') }}" target="_blank"><img style="max-width: 140px; max-height: 35px;" src="{{asset('adminAssets/images/logo.png')}}"></a>
				<div class="header__pane ml-auto">
					<div>
						<button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar"><span class="hamburger-box"><span class="hamburger-inner"></span></span></button>
					</div>
				</div>
			</div>
			<div class="app-header__mobile-menu">
				<div>
					<button type="button" class="hamburger hamburger--elastic mobile-toggle-nav"> <span class="hamburger-box"><span class="hamburger-inner"></span></span></button>
				</div>
			</div>
			<div class="app-header__menu">
				<span>
					<button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
						<span class="btn-icon-wrapper"><i class="fa fa-ellipsis-v fa-w-6"></i></span>
					</button>
				</span>
			</div>
			<div class="app-header__content">
				<div class="app-header-left">
					<!--<div class="search-wrapper">
						<div class="input-holder">
							<input type="text" class="search-input" placeholder="Type to search">
							<button class="search-icon"><span></span></button>
						</div>
						<button class="close"></button>
					</div>-->
					
				</div>
				<div class="app-header-right">
					<div class="header-dots">
						<div class="dropdown">
							<!--<button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="p-0 mr-2 btn btn-link">
								<span class="icon-wrapper icon-wrapper-alt rounded-circle">
									<span class="icon-wrapper-bg bg-danger"></span>
									<i class="icon text-danger icon-anim-pulse ion-android-notifications"></i>
									<span class="badge badge-dot badge-dot-sm badge-danger">Notifications</span>
								</span>
							</button>
							<div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu-xl rm-pointers dropdown-menu dropdown-menu-right">
								<div class="dropdown-menu-header mb-0">
									<div class="dropdown-menu-header-inner bg-deep-blue">
										<div class="menu-header-image opacity-1" style="background-image: url('assets/images/dropdown-header/city3.jpg');"></div>
										<div class="menu-header-content text-dark">
											<h5 class="menu-header-title">Notifications</h5>
										</div>
									</div>
								</div>
								<div class="tab-content">
									<div class="tab-pane active" id="tab-messages-header" role="tabpanel">
										<div class="scroll-area-sm">
											<div class="scrollbar-container">
												<div class="p-3">
													<div class="notifications-box">
														<div class="vertical-time-simple vertical-without-time vertical-timeline vertical-timeline--one-column">
															<div class="vertical-timeline-item dot-danger vertical-timeline-element">
																<div><span class="vertical-timeline-element-icon bounce-in"></span>
																	<div class="vertical-timeline-element-content bounce-in">
																		<h4 class="timeline-title">All Hands Meeting</h4>
																		<span class="vertical-timeline-element-date"></span>
																	</div>
																</div>
															</div>
															<div class="vertical-timeline-item dot-warning vertical-timeline-element">
																<div> <span class="vertical-timeline-element-icon bounce-in"></span>
																	<div class="vertical-timeline-element-content bounce-in">
																		<p>Yet another one, at <span class="text-success">15:00 PM</span>
																		</p> <span class="vertical-timeline-element-date"></span>
																	</div>
																</div>
															</div>
															<div class="vertical-timeline-item dot-success vertical-timeline-element">
																<div><span class="vertical-timeline-element-icon bounce-in"></span>
																	<div class="vertical-timeline-element-content bounce-in">
																		<h4 class="timeline-title">Build the production release
                                                                            <span class="badge badge-danger ml-2">NEW</span>
                                                                        </h4>
																		<span class="vertical-timeline-element-date"></span>
																	</div>
																</div>
															</div>
															<div class="vertical-timeline-item dot-primary vertical-timeline-element">
																<div> <span class="vertical-timeline-element-icon bounce-in"></span>
																	<div class="vertical-timeline-element-content bounce-in">
																		<h4 class="timeline-title">You have new Notification
                                                                            <p class="mt-2">Lorem ipsom dolor sit amet...</p>
                                                                            <p>Lorem ipsom dolor sit amet...</p>
                                                                        </h4>
																		<span class="vertical-timeline-element-date"></span>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<ul class="nav flex-column">
									<li class="nav-item-divider nav-item"></li>
									<li class="nav-item-btn text-center nav-item">
										<button class="btn-shadow btn-wide btn-pill btn btn-focus btn-sm">Mark as Read All</button>
									</li>
								</ul>
							</div>-->
						</div>
						
						<!-- Language Line -->
						<!--<div class="dropdown">
							<button type="button" data-toggle="dropdown" class="p-0 mr-2 btn btn-link"> <span class="icon-wrapper icon-wrapper-alt rounded-circle">
                                    <span class="icon-wrapper-bg bg-focus"></span>
									<span class="language-icon opacity-8 flag large DE"></span>
								</span>
							</button>
							<div tabindex="-1" role="menu" aria-hidden="true" class="rm-pointers dropdown-menu dropdown-menu-right">
								<div class="dropdown-menu-header">
									<div class="dropdown-menu-header-inner pt-4 pb-4 bg-focus">
										<div class="menu-header-image opacity-05" style="background-image: url('{{asset('public/adminAssets/images/dropdown-header/city2.jpg')}}');"></div>
										<div class="menu-header-content text-center text-white">
											<h6 class="menu-header-subtitle mt-0"> Choose Language</h6>
										</div>
									</div>
								</div>
								<h6 tabindex="-1" class="dropdown-header"> Popular Languages</h6>
								<button type="button" tabindex="0" class="dropdown-item"> <span class="mr-3 opacity-8 flag large US"></span> USA</button>
								<button type="button" tabindex="0" class="dropdown-item"> <span class="mr-3 opacity-8 flag large IN"></span> India</button>
								<button type="button" tabindex="0" class="dropdown-item"> <span class="mr-3 opacity-8 flag large FR"></span> France</button>
								<button type="button" tabindex="0" class="dropdown-item"> <span class="mr-3 opacity-8 flag large ES"></span>Spain</button>
							</div>
						</div>-->
					</div>
					
					<div class="header-btn-lg pr-0">
						<div class="widget-content p-0">
							<div class="widget-content-wrapper">
								<div class="widget-content-left">
									<div class="btn-group">
										<a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
											<img width="42" class="rounded-circle" src="@if(Auth::user()->profile_image) {{ asset(Auth::user()->profile_image) }} @else {{ asset(config('constants.DEFAULT_USER_IMAGE')) }} @endif" alt=""> <i class="fa fa-angle-down ml-2 opacity-8"></i>
										</a>
										<div tabindex="-1" role="menu" aria-hidden="true" class="rm-pointers dropdown-menu-lg dropdown-menu dropdown-menu-right">
											<div class="dropdown-menu-header">
												<div class="dropdown-menu-header-inner bg-info">
													<div class="menu-header-image opacity-2" style="background-image: url('{{asset('adminAssets/images/dropdown-header/city3.jpg')}}');"></div>
													<div class="menu-header-content text-left">
														<div class="widget-content p-0">
															<div class="widget-content-wrapper">
																<div class="widget-content-left mr-3">
																	<img width="42" class="rounded-circle" src="{{ asset(config('constants.DEFAULT_USER_IMAGE')) }}" alt="">
																</div>
																<div class="widget-content-left">
																	<div class="widget-heading">{{ Auth::user()->name }}</div>
																	<!-- <div class="widget-subheading opacity-8">A short profile description</div> -->
																</div>
																<div class="widget-content-right mr-2">
																	<a class="btn-pill btn-shadow btn-shine btn btn-focus" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
																	<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
																		@csrf
																	</form>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="scroll-area-xs" style="height: 180px;">
												<div class="scrollbar-container ps">
													<ul class="nav flex-column">
														<li class="nav-item-header nav-item">Profile</li>
														<li class="nav-item"><a href="{{ route('change_password') }}" class="nav-link">Change Password</a></li>
														<li class="nav-item"><a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a></li>
														
														<!--<li class="nav-item-header nav-item">Settings</li>
														<li class="nav-item"><a href="javascript:void(0);" class="nav-link">General Settings</a></li>
														<li class="nav-item"> <a href="javascript:void(0);" class="nav-link">Theme Options</a></li>-->
													</ul>
												</div>
											</div>
											<!--<ul class="nav flex-column">
												<li class="nav-item-divider mb-0 nav-item"></li>
											</ul>
											<div class="grid-menu grid-menu-2col">
												<div class="no-gutters row">
													<div class="col-sm-6">
														<button class="btn-icon-vertical btn-transition btn-transition-alt pt-2 pb-2 btn btn-outline-warning"> <i class="pe-7s-chat icon-gradient bg-amy-crisp btn-icon-wrapper mb-2"></i> Message Inbox</button>
													</div>
													<div class="col-sm-6">
														<button class="btn-icon-vertical btn-transition btn-transition-alt pt-2 pb-2 btn btn-outline-danger"> <i class="pe-7s-ticket icon-gradient bg-love-kiss btn-icon-wrapper mb-2"></i>
															<b>Support Tickets</b>
														</button>
													</div>
												</div>
											</div>-->
										</div>
									</div>
								</div>
								<div class="widget-content-left  ml-3 header-user-info">
									<div class="widget-heading">{{Auth::user()->name}}</div>
									<div class="widget-subheading">{{Auth::user()->user_type}}</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>