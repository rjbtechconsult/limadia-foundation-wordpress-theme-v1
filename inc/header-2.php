 <header class="header">
		<div class="header-top bg-deep sm-text-center">
			<div class="container">
				<div class="row">
					<div class="col-md-3">
						<div class="widget no-border m-0">
						<ul class="styled-icons icon-sm sm-text-center">
							<li><a href="#"><i class="fa fa-facebook"></i></a></li>
							<li><a href="#"><i class="fa fa-twitter"></i></a></li>
							<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
						</ul>
						</div>
					</div>
					<div class="col-md-9">
						<div class="widget no-border m-0">
						<ul class="list-inline pull-right sm-pull-none sm-text-center mt-5">
							<li class="m-0 pl-10 pr-10"> <i class="fa fa-phone text-theme-colored"></i> <a class="text-gray" href="#">123-456-789</a> </li>
							<li class="m-0 pl-10 pr-10"> <i class="fa fa-clock-o text-theme-colored"></i> Mon-Fri 8:00 to 2:00 </li>
							<li class="m-0 pl-10 pr-10"> <i class="fa fa-envelope-o text-theme-colored"></i> <a class="text-gray" href="#">contact@yourdomain.com</a> </li>
							<li class="sm-display-block mt-sm-10 mb-sm-10">
							<a class="btn btn-colored btn-flat btn-theme-colored ajaxload-popup" href="<?php echo get_template_directory_uri(); ?>/ajax-load/donation-form.html" >Donate Now</a>

							</li>
						</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="header-nav">
			<div class="header-nav-wrapper navbar-scrolltofixed bg-lightest">
				<div class="container">
					<nav id="menuzord-right" class="menuzord orange bg-lightest">
						<a class="menuzord-brand" href="javascript:void(0)">
							<img src="<?php echo get_template_directory_uri(); ?>/images/logo-wide@4x.png" alt="">
						</a>
						<div id="side-panel-trigger" class="side-panel-trigger">
							<a href="#">
								<i class="fa fa-bars font-24 text-gray"></i>
							</a>
						</div>
						<?php
							wp_nav_menu(array(
								'theme_location'  => 'primary_menu',
								'menu_class'      => 'menuzord-menu',
								'container'       => false,
								'walker'          => new Custom_Walker_Nav_Menu()
							));
						?>
					</nav>
				</div>
			</div>
		</div>
  	</header>