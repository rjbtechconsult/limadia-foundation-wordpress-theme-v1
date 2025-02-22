<section class="divider parallax layer-overlay overlay-light" data-stellar-background-ratio="0.2" data-bg-img="https://picsum.photos/1920/1280">
      <div class="container pt-0 pb-0">
        <div class="row equal-height">
          <div class="col-md-7">
            <div class="display-table-parent pr-90 pl-90">
              <div class="display-table">
                <div class="display-table-cell">
                  <div class="clients text-center pt-30 pb-20 bg-lightest-transparent">
                    <div class="row">
                      <div class="col-xs-6 col-sm-6 col-md-4">
                        <img src="https://picsum.photos/150/120" alt="" width="100" class="mb-10">
                      </div>
                      <div class="col-xs-6 col-sm-6 col-md-4">
                        <img src="https://picsum.photos/150/120" alt="" width="100" class="mb-10">
                      </div>
                      <div class="col-xs-6 col-sm-6 col-md-4">
                        <img src="https://picsum.photos/150/120" alt="" width="100" class="mb-10">
                      </div>
                      <div class="col-xs-6 col-sm-6 col-md-4">
                        <img src="https://picsum.photos/150/120" alt="" width="100" class="mb-10">
                      </div>
                      <div class="col-xs-6 col-sm-6 col-md-4">
                        <img src="https://picsum.photos/150/120" alt="" width="100" class="mb-10">
                      </div>
                      <div class="col-xs-6 col-sm-6 col-md-4">
                        <img src="https://picsum.photos/150/120" alt="" width="100" class="mb-10">
                      </div>
                      <div class="clearfix"></div>
                    </div>
                  </div>                  
                  <div class="mt-30">
                    <h4 class="text-uppercase mb-5">Subscribe to our newsletter</h4>
                    <!-- Mailchimp Subscription Form-->
                    <form id="mailchimp-subscription-form" class="newsletter-form mt-10">
                      <label class="display-block" for="mce-EMAIL"></label>
                      <div class="input-group">
                        <input type="email" id="mce-EMAIL" data-height="43px" class="form-control input-lg" placeholder="Your Email" name="EMAIL" value="">
                        <span class="input-group-btn">
                          <button type="submit" class="btn btn-flat btn-lg btn-colored btn-theme-colored m-0" data-height="43px">Subscribe</button>
                        </span>
                      </div>
                    </form>

                    <!-- Mailchimp Subscription Form Validation-->
                    <script type="text/javascript">
                        jQuery(document).ready(function($) {
                            $('#mailchimp-subscription-form').ajaxChimp({
                                callback: mailChimpCallBack,
                                url: '//thememascot.us9.list-manage.com/subscribe/post?u=a01f440178e35febc8cf4e51f&amp;id=49d6d30e1e'
                            });

                            function mailChimpCallBack(resp) {
                                // Hide any previous response text
                                var $mailchimpform = $('#mailchimp-subscription-form'),
                                    $response = '';
                                $mailchimpform.children(".alert").remove();
                                if (resp.result === 'success') {
                                    $response = '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + resp.msg + '</div>';
                                } else if (resp.result === 'error') {
                                    $response = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + resp.msg + '</div>';
                                }
                                $mailchimpform.prepend($response);
                            }
                        });
                    </script>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-5 bg-light-transparent">
            <div class="pt-50 pb-50 pl-20 pr-20">
              <h4 class="text-uppercase line-bottom mt-0">Our Donors Say</h4>
              <div class="testimonial-carousel owl-nav-top">
                <div class="item">
                  <div class="testimonial-wrapper text-center">
                    <div class="thumb"><img class="img-circle" alt="" src="https://picsum.photos/135/135"></div>
                    <div class="content pt-10">
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum feugiat turpis nec leo pellentesque tincidunt adipiscing elit.</p>
                      <i class="fa fa-quote-right font-36 mt-10 text-gray-lightgray"></i>
                      <h5 class="author text-theme-colored mb-0">Catherine Grace</h5>
                      <h6 class="title text-gray mt-0 mb-15">Designer</h6>
                    </div>
                  </div>
                </div>
                <div class="item">
                  <div class="testimonial-wrapper text-center">
                    <div class="thumb"><img class="img-circle" alt="" src="https://picsum.photos/135/135"></div>
                    <div class="content pt-10">
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum feugiat turpis nec leo pellentesque tincidunt adipiscing elit.</p>
                      <i class="fa fa-quote-right font-36 mt-10 text-gray-lightgray"></i>
                      <h5 class="author text-theme-colored mb-0">Catherine Grace</h5>
                      <h6 class="title text-gray mt-0 mb-15">Designer</h6>
                    </div>
                  </div>
                </div>
                <div class="item">
                  <div class="testimonial-wrapper text-center">
                    <div class="thumb"><img class="img-circle" alt="" src="https://picsum.photos/135/135"></div>
                    <div class="content pt-10">
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum feugiat turpis nec leo pellentesque tincidunt adipiscing elit.</p>
                      <i class="fa fa-quote-right font-36 mt-10 text-gray-lightgray"></i>
                      <h5 class="author text-theme-colored mb-0">Catherine Grace</h5>
                      <h6 class="title text-gray mt-0 mb-15">Designer</h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>