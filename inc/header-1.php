<header class="header" style="display: none;">
		<!-- Top header -->
		<div class="header-top bg-theme-colored sm-text-center">
			<div class="container">
				<div class="row">
				<div class="col-md-8">
					<div class="widget no-border m-0">
					<ul class="list-inline sm-text-center mt-5">
						<li>
						<a href="#" class="text-white">FAQ</a>
						</li>
						<li class="text-white">|</li>
						<li>
						<a href="#" class="text-white">Help Desk</a>
						</li>
						<li class="text-white">|</li>
						<li>
						<a href="#" class="text-white">Support</a>
						</li>
					</ul>
					</div>
				</div>
				<div class="col-md-4">
					<div id="side-panel-trigger" class="side-panel-trigger pull-right sm-pull-none mt-5"><a href="#"><i class="fa fa-bars font-24 text-white"></i></a></div>
					<div class="widget no-border m-0">
					<ul class="styled-icons icon-dark icon-circled icon-theme-colored icon-sm pull-right sm-pull-none sm-text-center mt-sm-15">
						<li><a href="#"><i class="fa fa-facebook text-white"></i></a></li>
						<li><a href="#"><i class="fa fa-twitter text-white"></i></a></li>
						<li><a href="#"><i class="fa fa-google-plus text-white"></i></a></li>
						<li><a href="#"><i class="fa fa-instagram text-white"></i></a></li>
						<li><a href="#"><i class="fa fa-linkedin text-white"></i></a></li>
					</ul>
					</div>
				</div>
				</div>
			</div>
		</div>

		 <!-- Middle header -->
		<div class="header-middle p-0 bg-lightest xs-text-center">
			<div class="container pt-0 pb-0">
				<div class="row">
				<div class="col-xs-12 col-sm-4 col-md-5">
					<div class="widget no-border m-0">
						<a class="menuzord-brand xs-pull-center mb-15" href="javascript:void(0)">
							<img alt="logo" src="<?php echo get_template_directory_uri(); ?>/images/logo-wide@4x.png" />
						</a>
					</div>
				</div>
				<div class="col-xs-12 col-sm-4 col-md-4">
					<div class="widget no-border m-0">
					<div class="mt-10 mb-10 text-right sm-text-center">
						<div class="font-20 text-black-333 text-uppercase mb-5 font-weight-600"><i class="fa fa-phone-square text-theme-colored font-24"></i> +(012) 345 6789</div>
						<a class="font-12 text-gray" href="#">Call us for more details!</a>
					</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-4 col-md-3">
					<div class="widget no-border m-0">
					<div class="mt-10 mb-10 text-right sm-text-center">
						<div class="font-20 text-black-333 text-uppercase mb-5 font-weight-600"><i class="fa fa-envelope text-theme-colored font-24"></i> Mail us today</div>
						<a class="font-12 text-gray" href="#"> info@yourdomain.com</a>
					</div>
					</div>
				</div>
				</div>
			</div>
		</div>

		<!-- Main header -->
		<div class="header-nav">
			<div class="header-nav-wrapper navbar-scrolltofixed bg-light">
				<div class="container">
				<nav id="menuzord" class="menuzord orange bg-light">
					<?php
						wp_nav_menu(array(
							'theme_location'  => 'primary_menu',
							'menu_class'      => 'menuzord-menu',
							'container'       => false,
							'walker'          => new Custom_Walker_Nav_Menu()
						));
					?>
					<ul class="pull-right hidden-sm hidden-xs">
						<li>
							<a class="btn btn-colored btn-flat btn-theme-colored mt-15 ajaxload-popup" href="<?php echo get_template_directory_uri(); ?>/ajax-load/donation-form.html" >Donate Now</a>
						</li>
					</ul>
				</nav>
				</div>
			</div>
		</div>
	</header>