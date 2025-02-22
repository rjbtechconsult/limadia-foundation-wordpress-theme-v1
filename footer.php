<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Limadia_Entity_Foundation_V1
 */

?>
</div>
<footer id="footer" class="footer pb-0" data-bg-img="<?php echo get_template_directory_uri(); ?>/images/footer-bg.png" data-bg-color="#25272e">
		<div class="container pb-20">
		<div class="row multi-row-clearfix">
			<div class="col-sm-6 col-md-3">
			<div class="widget dark"> 
				<img alt="logo" src="<?php echo get_template_directory_uri(); ?>/images/logo-wide-white@4x.png" />
				<p class="font-12 mt-10 mb-10">CharityFund is a library of corporate and business templates with predefined web elements which helps you to build your own site.</p>
				<a class="btn btn-default btn-transparent btn-xs btn-flat mt-5" href="#">Read more</a>
				<ul class="styled-icons icon-sm icon-bordered icon-circled clearfix mt-20">
				<li><a href="#"><i class="fa fa-facebook"></i></a></li>
				<li><a href="#"><i class="fa fa-twitter"></i></a></li>
				<li><a href="#"><i class="fa fa-instagram"></i></a></li>
				<li><a href="#"><i class="fa fa-fa fa-linkedin"></i></a></li>
				<li><a href="#"><i class="fa fa-behance"></i></a></li>
				</ul>
			</div>
			</div>
			<div class="col-sm-6 col-md-3">
			<div class="widget dark">
				<h5 class="widget-title line-bottom">Twitter Feed</h5>
				<div class="twitter-feed list-border clearfix" data-username="Envato" data-count="2"></div>
			</div>
			</div>
			<div class="col-sm-6 col-md-3">
			<div class="widget dark">
				<h5 class="widget-title line-bottom">Opening Hours</h5>
				<div class="opening-hours">
				<ul class="list-border">
					<li class="clearfix"> <span><i class="fa fa-clock-o mr-5"></i> Monday -Tuesday :</span>
					<div class="value pull-right"> 9.00 am - 10.00 pm </div>
					</li>
					<li class="clearfix"> <span><i class="fa fa-clock-o mr-5"></i> Wednesday :  </span>
					<div class="value pull-right"> 10.00 am - 8.00 pm </div>
					</li>
					<li class="clearfix"> <span class="text-theme-colored"><i class="fa fa-clock-o mr-5"></i> Thursday : </span>
					<div class="value pull-right text-theme-colored"> 10.00 am - 8.00 pm </div>
					</li>
					<li class="clearfix"> <span><i class="fa fa-clock-o mr-5"></i> Friday :</span>
					<div class="value pull-right"> 10.00 am - 6.00 pm </div>
					</li>
					<li class="clearfix"> <span><i class="fa fa-clock-o mr-5"></i> Saturday : </span>
					<div class="value pull-right"> 2.00 pm - 8.00 pm </div>
					</li>
					<li class="clearfix"> <span><i class="fa fa-clock-o mr-5"></i> Sunday :</span>
					<div class="value pull-right"> <span class="text-highlight bg-theme-colored text-black-333">Colsed</span>  </div>
					</li>
				</ul>
				</div>
			</div>
			</div>
			<div class="col-sm-6 col-md-3">
			<div class="widget dark">
				<h5 class="widget-title line-bottom">Quick Contact</h5>
				<form id="footer_quick_contact_form" name="footer_quick_contact_form" class="quick-contact-form" action="includes/quickcontact.php" method="post">
				<div class="form-group">
					<input id="form_email" name="form_email" class="form-control" type="text" required="" placeholder="Enter Email">
				</div>
				<div class="form-group">
					<textarea id="form_message" name="form_message" class="form-control" required="" placeholder="Enter Message" rows="3"></textarea>
				</div>
				<div class="form-group">
					<input id="form_botcheck" name="form_botcheck" class="form-control" type="hidden" value="" />
					<button type="submit" class="btn btn-default btn-transparent btn-xs btn-flat mt-0" data-loading-text="Please wait...">Send Message</button>
				</div>
				</form>

				<!-- Quick Contact Form Validation-->
				<script type="text/javascript">
					(function($) {
						$("#footer_quick_contact_form").validate({
							submitHandler: function(form) {
							var form_btn = $(form).find('button[type="submit"]');
							var form_result_div = '#form-result';
							$(form_result_div).remove();
							form_btn.before('<div id="form-result" class="alert alert-success" role="alert" style="display: none;"></div>');
							var form_btn_old_msg = form_btn.html();
							form_btn.html(form_btn.prop('disabled', true).data("loading-text"));
							$(form).ajaxSubmit({
								dataType:  'json',
								success: function(data) {
								if( data.status == 'true' ) {
									$(form).find('.form-control').val('');
								}
								form_btn.prop('disabled', false).html(form_btn_old_msg);
								$(form_result_div).html(data.message).fadeIn('slow');
								setTimeout(function(){ $(form_result_div).fadeOut('slow') }, 6000);
								}
							});
							}
						});
					});
				</script>
			</div>
			</div>
		</div>
		</div>
		<div class="container-fluid bg-theme-colored p-20">
		<div class="row text-center">
			<div class="col-md-12">
			<p class="text-white font-11 m-0">Copyright &copy;2015 ThemeMascot. All Rights Reserved</p>
			</div>
		</div>
		</div>
  </footer>
  <a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
</div>
<?php wp_footer(); ?>
</body>
</html>
