<?php
/**
 * Template part for displaying careers page content
 *
 * @package Limadia_Entity_Foundation_V1
 */
?>

<!-- Section: inner-header -->
<section class="inner-header divider layer-overlay overlay-dark" data-bg-img="<?php echo get_template_directory_uri(); ?>/images/bg1.jpg">
  <div class="container pt-30 pb-30">
    <!-- Section Content -->
    <div class="section-content text-center">
      <div class="row"> 
        <div class="col-md-6 col-md-offset-3 text-center">
          <h2 class="text-theme-colored font-36">Careers</h2>
          <ol class="breadcrumb text-center mt-10 white">
            <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
            <li class="active">Careers</li>
          </ol>
        </div>
      </div>
    </div>
  </div>      
</section>

<!-- Section: Job List -->
<section>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="heading-line-bottom mt-0 mb-30">
          <h4 class="heading-title">Open Positions</h4>
        </div>
        
        <?php
        $args = array(
            'post_type'      => 'job',
            'posts_per_page' => -1,
            'status'         => 'publish',
            'meta_query'     => array(
                'relation' => 'OR',
                array(
                    'key'     => '_job_status',
                    'value'   => 'Open',
                    'compare' => '='
                ),
                array(
                    'key'     => '_job_status',
                    'compare' => 'NOT EXISTS'
                )
            )
        );
        $job_query = new WP_Query( $args );

        if ( $job_query->have_posts() ) :
            $count = 0;
            while ( $job_query->have_posts() ) : $job_query->the_post();
                $location = get_post_meta( get_the_ID(), '_job_location', true );
                $type     = get_post_meta( get_the_ID(), '_job_type', true );
                $closing  = get_post_meta( get_the_ID(), '_job_closing_date', true );
                $count++;
                $margin_top = ($count > 1) ? 'mt-80' : '';
                ?>
                <!-- Job <?php the_ID(); ?> -->
                <div class="icon-box <?php echo esc_attr($margin_top); ?> mb-0 p-0">
                  <a href="<?php the_permalink(); ?>" class="icon icon-gray pull-left mb-0 mr-10">
                    <?php if ( has_post_thumbnail() ) : ?>
                      <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'thumbnail'); ?>" alt="<?php the_title(); ?>" style="width: 50px; height: 50px; object-fit: cover;">
                    <?php else : ?>
                      <i class="pe-7s-users"></i>
                    <?php endif; ?>
                  </a>
                  <h3 class="icon-box-title pt-15 mt-0 mb-40"><?php the_title(); ?></h3>
                  <hr>
                  <div class="text-gray"><?php the_excerpt(); ?></div>
                  <div class="mt-15">
                    <?php if ( $location ) : ?>
                      <span class="text-theme-colored font-weight-600 mr-20"><i class="fa fa-map-marker"></i> <?php echo esc_html($location); ?></span>
                    <?php endif; ?>
                    <?php if ( $type ) : ?>
                      <span class="text-theme-colored font-weight-600 mr-20"><i class="fa fa-clock-o"></i> <?php echo esc_html($type); ?></span>
                    <?php endif; ?>
                    <?php if ( $closing ) : ?>
                      <span class="text-theme-colored font-weight-600 mr-20"><i class="fa fa-calendar-times-o"></i> Closes: <?php echo esc_html(date("M j, Y", strtotime($closing))); ?></span>
                    <?php endif; ?>
                  </div>

                  <a class="btn btn-dark btn-sm mt-20" href="<?php the_permalink(); ?>">Apply Now</a>
                </div>
                <?php
            endwhile;
            wp_reset_postdata();
        else :
            ?>
            <div class="alert alert-info">
              <?php _e('Currently, there are no open positions. Please check back later.', 'limadia-entity-foundation-v1'); ?>
            </div>
            <?php
        endif;
        ?>


      </div>
    </div>
  </div>
</section>

<!-- Section: Benefits/Culture -->
<section class="bg-lightest">
  <div class="container pb-80">
    <div class="section-title text-center">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <h2 class="mt-0 line-height-1">Why Join <span class="text-theme-colored">Limadia Foundation?</span></h2>
          <p>Join a team of passionate individuals dedicated to making a real difference in the world.</p>
        </div>
      </div>
    </div>
    <div class="section-content">
      <div class="row">
        <div class="col-md-4">
          <div class="icon-box iconbox-theme-colored text-center">
            <a class="icon icon-bordered icon-circled icon-xl">
              <i class="fa fa-heartbeat font-48"></i>
            </a>
            <h4 class="icon-box-title">Meaningful Work</h4>
            <p>Every day, your work directly impacts the lives of those in need, providing hope and support where it's needed most.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="icon-box iconbox-theme-colored text-center">
            <a class="icon icon-bordered icon-circled icon-xl">
              <i class="fa fa-users font-48"></i>
            </a>
            <h4 class="icon-box-title">Collaborative Team</h4>
            <p>Work alongside experts and volunteers who share your commitment to humanitarian aid and community development.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="icon-box iconbox-theme-colored text-center">
            <a class="icon icon-bordered icon-circled icon-xl">
              <i class="fa fa-line-chart font-48"></i>
            </a>
            <h4 class="icon-box-title">Growth Opportunities</h4>
            <p>We invest in our people through training and development programs to help you grow personally and professionally.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
