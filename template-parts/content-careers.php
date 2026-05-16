<?php
/**
 * Template part for displaying careers page content
 *
 * @package Limadia_Entity_Foundation_V1
 */
?>

<!-- Section: inner-header -->
<section class="inner-header divider layer-overlay overlay-dark" data-bg-img="http://placehold.it/1920/1280">
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

<!-- Section: Benefits/Culture -->
<section class="bg-white">
  <div class="container pt-80 pb-30">
    <div class="section-title text-center">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <h2 class="mt-0 line-height-1">Why Join <span class="text-theme-colored">Limadia Entity Foundation?</span></h2>
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

<!-- Section: Job List -->
<section style="background-color: #f7f8fa;">
  <div class="container pt-30 pb-80">
    <div class="row">
      <div class="col-md-12">
        <div class="section-title text-center mb-40">
          <div class="row">
            <div class="col-md-8 col-md-offset-2">
              <h2 class="mt-0 line-height-1">Open <span class="text-theme-colored">Positions</span></h2>
            </div>
          </div>
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
            while ( $job_query->have_posts() ) : $job_query->the_post();
                $location = get_post_meta( get_the_ID(), '_job_location', true );
                $type     = get_post_meta( get_the_ID(), '_job_type', true );
                $closing  = get_post_meta( get_the_ID(), '_job_closing_date', true );
                ?>
                <!-- Job Card - Full Width -->
                <div class="job-item mb-20">
                  <div class="row">
                    <div class="col-sm-8 col-md-9">
                      <div class="job-details">
                        <h3 class="job-title mt-0 mb-10"><a href="<?php the_permalink(); ?>" class="text-black"><?php the_title(); ?></a></h3>
                        <ul class="list-inline font-14 mb-10">
                          <?php if ( $location ) : ?>
                            <li class="mr-20"><i class="fa fa-map-marker text-theme-colored"></i> <?php echo esc_html($location); ?></li>
                          <?php endif; ?>
                          <?php if ( $type ) : ?>
                            <li class="mr-20"><i class="fa fa-clock-o text-theme-colored"></i> <?php echo esc_html($type); ?></li>
                          <?php endif; ?>
                          <?php if ( $closing ) : ?>
                            <li class="mr-20"><i class="fa fa-calendar-times-o text-theme-colored"></i> Closes: <?php echo esc_html(date("M j, Y", strtotime($closing))); ?></li>
                          <?php endif; ?>
                        </ul>
                        <div class="job-excerpt text-gray">
                          <?php echo wp_trim_words(get_the_excerpt(), 25, '...'); ?>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-4 col-md-3 text-right sm-text-left mt-sm-20">
                      <a class="btn btn-theme-colored btn-flat btn-sm mt-10" href="<?php the_permalink(); ?>">View Details & Apply</a>
                    </div>
                  </div>
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
