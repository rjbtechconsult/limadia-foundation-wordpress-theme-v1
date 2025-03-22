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
					<p class="font-12 mt-20 mb-10">Limadia Foundation is a nonprofit dedicated to providing free healthcare, education, and disaster relief to vulnerable communities, ensuring dignity and opportunity for all.</p>
					<a class="text-gray font-12" href="/about"><i class="fa fa-angle-double-right text-theme-colored"></i>Read more</a>
					<!-- <ul class="styled-icons icon-dark mt-20">
						<li><a href="#" data-bg-color="#3B5998"><i class="fa fa-facebook"></i></a></li>
						<li><a href="#" data-bg-color="#02B0E8"><i class="fa fa-twitter"></i></a></li>
						<li><a href="#" data-bg-color="#02B0E8"><i class="fa fa-instagram"></i></a></li>
						<li><a href="#" data-bg-color="#C22E2A"><i class="fa fa-youtube"></i></a></li>
					</ul> -->
				</div>
			</div>
			<div class="col-sm-6 col-md-3">
				<div class="widget dark">
				<h5 class="widget-title line-bottom">Quick Links</h5>
				<ul class="list-border list theme-colored angle-double-right">
					<li><a href="/">Home</a></li>
					<li><a href="/about">About</a></li>
					<li><a href="/causes">Causes</a></li>
					<li><a href="/contact">Contact</a></li>
					<!-- <li><a href="#">Copyright Notice</a></li> -->
				</ul>
				</div>
			</div>
			
			<div class="col-sm-6 col-md-6">
				<div class="widget dark">
					<h5 class="widget-title line-bottom">Quick Contact</h5>
					<ul class="list-border">
						<li><a href="tel:+2330551213475">+233-05512-13475</a></li>
						<li><a href="mailto:info@limadiafoundation.com">info@limadiafoundation.com</a></li>
						<li><a href="#" class="lineheight-20">Plot number 37, Achiase Nwansamire, Near Zion Primary Sch, Nkawie, Atwima- Nwabiagya, Kumasi, Ghana.</a></li>
					</ul>
					<p class="text-white mb-5 mt-15">Subscribe to our newsletter</p>
					<form id="footer-mailchimp-subscription-form" class="newsletter-form mt-10">
						<label class="display-block" for="mce-EMAIL"></label>
						<div class="input-group">
						<input type="email" value="" name="EMAIL" placeholder="Your Email"  class="form-control" data-height="37px" id="mce-EMAIL">
						<span class="input-group-btn">
							<button type="submit" class="btn btn-colored btn-theme-colored m-0"><i class="fa fa-paper-plane-o text-white"></i></button>
						</span>
						</div>
					</form>
					<!-- Mailchimp Subscription Form Validation-->
					<script type="text/javascript">
						$('#footer-mailchimp-subscription-form').ajaxChimp({
							callback: mailChimpCallBack,
							url: '//thememascot.us9.list-manage.com/subscribe/post?u=a01f440178e35febc8cf4e51f&amp;id=49d6d30e1e'
						});

						function mailChimpCallBack(resp) {
							// Hide any previous response text
							var $mailchimpform = $('#footer-mailchimp-subscription-form'),
								$response = '';
							$mailchimpform.children(".alert").remove();
							if (resp.result === 'success') {
								$response = '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + resp.msg + '</div>';
							} else if (resp.result === 'error') {
								$response = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + resp.msg + '</div>';
							}
							$mailchimpform.prepend($response);
						}
					</script>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid bg-theme-colored p-20">
		<div class="row text-center">
			<div class="col-md-12">
				<p class="text-white font-11 m-0">Copyright &copy;<?php echo date("Y");?> Limadia Entity Foundation. All Rights Reserved</p>
			</div>
		</div>
	</div>
</footer>

<a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
</div>
<?php wp_footer(); ?>
</body>
</html>
