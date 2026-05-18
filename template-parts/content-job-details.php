<?php
/**
 * Template part for displaying job details content
 *
 * @package Limadia_Entity_Foundation_V1
 */

$location = get_post_meta( get_the_ID(), '_job_location', true );
$type     = get_post_meta( get_the_ID(), '_job_type', true );
$salary   = get_post_meta( get_the_ID(), '_job_salary', true );
$closing  = get_post_meta( get_the_ID(), '_job_closing_date', true );
$status   = get_post_meta( get_the_ID(), '_job_status', true );
$date     = get_the_date();

if (!$status) $status = 'Open';
?>

<!-- Section: inner-header -->
<section class="inner-header divider layer-overlay overlay-dark" data-bg-img="http://placehold.it/1920/1280">
  <div class="container pt-30 pb-30">
    <!-- Section Content -->
    <div class="section-content text-center">
      <div class="row"> 
        <div class="col-md-6 col-md-offset-3 text-center">
          <h2 class="text-theme-colored font-36"><?php the_title(); ?></h2>
          <ol class="breadcrumb text-center mt-10 white">
            <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
            <li><a href="<?php echo esc_url( home_url( '/careers' ) ); ?>">Careers</a></li>
            <li class="active"><?php the_title(); ?></li>
          </ol>
        </div>
      </div>
    </div>
  </div>      
</section>

<section>
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <div class="job-overview bg-lightest p-30 border-1px">
          <h4 class="mt-0 text-theme-colored">Job Overview</h4>
          <hr>
          <dl class="dl-horizontal">
            <dt><i class="fa fa-calendar text-theme-colored mt-5 font-15"></i></dt>
            <dd>
              <h5 class="mt-0 mb-5">Date Posted:</h5>
              <p><?php echo esc_html($date); ?></p>
            </dd>
          </dl>
          <?php if ( $closing ) : ?>
          <dl class="dl-horizontal">
            <dt><i class="fa fa-calendar-times-o text-theme-colored mt-5 font-15"></i></dt>
            <dd>
              <h5 class="mt-0 mb-5">Closing Date:</h5>
              <p><?php echo esc_html(date("F j, Y", strtotime($closing))); ?></p>
            </dd>
          </dl>
          <?php endif; ?>
          <?php if ( $location ) : ?>
          <dl class="dl-horizontal">
            <dt><i class="fa fa-map-marker text-theme-colored mt-5 font-15"></i></dt>
            <dd>
              <h5 class="mt-0 mb-5">Location:</h5>
              <p><?php echo esc_html($location); ?></p>
            </dd>
          </dl>
          <?php endif; ?>
          <dl class="dl-horizontal">
            <dt><i class="fa fa-user text-theme-colored mt-5 font-15"></i></dt>
            <dd>
              <h5 class="mt-0 mb-5">Job Title:</h5>
              <p><?php the_title(); ?></p>
            </dd>
          </dl>
          <?php if ( $type ) : ?>
          <dl class="dl-horizontal">
            <dt><i class="fa fa-clock-o text-theme-colored mt-5 font-15"></i></dt>
            <dd>
              <h5 class="mt-0 mb-5">Job Type:</h5>
              <p><?php echo esc_html($type); ?></p>
            </dd>
          </dl>
          <?php endif; ?>
          <?php if ( $salary ) : ?>
          <dl class="dl-horizontal">
            <dt><i class="fa fa-money text-theme-colored mt-5 font-15"></i></dt>
            <dd>
              <h5 class="mt-0 mb-5">Salary:</h5>
              <p><?php echo esc_html($salary); ?></p>
            </dd>
          </dl>
          <?php endif; ?>
          <?php if ($status == 'Open') : ?>
          <a class="btn btn-dark btn-theme-colored btn-block mt-20" href="#apply-now">Apply Now</a>
          <?php endif; ?>
        </div>
      </div>
      <div class="col-md-8">
        <div class="icon-box mb-0 p-0 text-left">
          <h3 class="icon-box-title mt-0 mb-40 text-left"><?php the_title(); ?></h3>
          <hr>
          <div class="job-content text-left">
            <?php the_content(); ?>
          </div>
          <?php if ($status == 'Open') : ?>
          <div class="mt-30 text-center">
            <a class="btn btn-dark btn-theme-colored btn-lg" href="#apply-now">Apply Now For This Position</a>
          </div>
          <?php endif; ?>


        </div>
      </div>
    </div>
  </div>
</section>

<!-- Section: Application Form -->
<section id="apply-now" class="divider parallax layer-overlay overlay-white-9" data-bg-img="<?php echo get_template_directory_uri(); ?>/images/bg2.jpg">
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2 bg-lightest-transparent p-40 pt-20 border-1px">
        <?php if ($status == 'Open') : ?>
        <h3 class="text-center text-theme-colored mb-30">Apply For This Position</h3>
        <form id="job_apply_form" name="job_apply_form" action="#" method="post" enctype="multipart/form-data">
          <?php wp_nonce_field('submit_job_application', 'job_application_nonce'); ?>
          <input type="hidden" name="action" value="submit_job_application">
          <input type="hidden" name="job_id" value="<?php echo get_the_ID(); ?>">
          <input type="hidden" name="job_position" value="<?php echo esc_attr(get_the_title()); ?>">
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>Name <small>*</small></label>
                <input name="form_name" type="text" placeholder="Enter Name" required="" class="form-control">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Email <small>*</small></label>
                <input name="form_email" class="form-control required email" type="email" placeholder="Enter Email">
              </div>
            </div>
          </div>
          <div class="row">               
            <div class="col-sm-6">
              <div class="form-group">
                <label>Phone <small>*</small></label>
                <input name="form_phone" type="text" placeholder="Enter Phone" required="" class="form-control">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Portfolio/Website</label>
                <input name="form_portfolio" class="form-control" type="text" placeholder="URL">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label>Upload Cover Letter (PDF Only) <small>*</small></label>
            <input name="form_cover_letter" class="file" type="file" required accept=".pdf,application/pdf" data-show-upload="false" data-show-caption="true">
            <small>Maximum upload file size: 5 MB</small>
          </div>
          <div class="form-group">
            <label>Upload C/V (PDF Only) <small>*</small></label>
            <input name="form_attachment" class="file" type="file" required accept=".pdf,application/pdf" data-show-upload="false" data-show-caption="true">
            <small>Maximum upload file size: 5 MB</small>
          </div>
          <div class="form-group text-center">
            <button type="submit" class="btn btn-dark btn-theme-colored btn-lg btn-block mt-20" data-loading-text="Please wait...">Submit Application</button>
          </div>
        </form>
        <?php else : ?>
          <div class="alert alert-danger text-center">
            <h3 class="mt-0">Applications are now Closed</h3>
            <p>We are no longer accepting applications for this position. Thank you for your interest.</p>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

<script type="text/javascript">
  jQuery(document).ready(function($) {
    $('#job_apply_form').on('submit', function(e) {
      e.preventDefault();
      
      var form = $(this);
      var btn = form.find('button[type="submit"]');
      var originalBtnText = btn.text();
      
      btn.prop('disabled', true).text('Sending...');
      
      var formData = new FormData(this);

      $.ajax({
        url: '<?php echo admin_url('admin-ajax.php'); ?>',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
          if (response.success) {
            form.html('<div class="alert alert-success">' + response.data.message + '</div>');
            // Scroll to the success message
            $('html, body').animate({
                scrollTop: form.offset().top - 100
            }, 500);
          } else {
            alert(response.data.message);
            btn.prop('disabled', false).text(originalBtnText);
          }
        },
        error: function(xhr, status, error) {
          console.log('Server Response:', xhr.responseText);
          alert('A server error occurred. Please check the console for details or contact support.');
          btn.prop('disabled', false).text(originalBtnText);
        }
      });
    });
  });
</script>

