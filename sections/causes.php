<section> 
      <div class="container pb-80">
        <div class="section-title text-center">
          <div class="row">
            <div class="col-md-8 col-md-offset-2">
              <h3 class="text-uppercase mt-0">Our Causes</h3>
              <div class="title-icon">
                <i class="flaticon-charity-hand-holding-a-heart"></i>
              </div>
              <p>
                Together, we can bring hope and lasting change. <br> Join us in transforming lives today!
              </p>
            </div>
          </div>
        </div>
        <div class="row mtli-row-clearfix">
          <?php
              // $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // Get current page
              $args = array(
                  'post_type'      => 'cause', // Change this to your CPT name
                  'posts_per_page' => 3, // Set how many causes per page
                  'orderby'        => 'date',
                  'order'          => 'DESC',
                  // 'paged'          => $paged, // Add pagination
              );

              $causes_query = new WP_Query($args);

              if ($causes_query->have_posts()) :
                  while ($causes_query->have_posts()) : $causes_query->the_post();

                      // Get meta fields
                      $goal    = (float) get_post_meta(get_the_ID(), '_cause_goal', true)?:0;
                      $raised  = (float) get_post_meta(get_the_ID(), '_cause_raised', true)?:0;
                      $donors  = (int) get_post_meta(get_the_ID(), '_cause_donors', true)?:0;
                      $excerpt = get_the_excerpt();
                      $categories = get_the_terms(get_the_ID(), 'category');
                      $category = !empty($categories) ? esc_html($categories[0]->name) : 'Uncategorized';
                      $percentage = ($goal > 0) ? round(($raised / $goal) * 100) : 00;
                      $featured_image = get_the_post_thumbnail_url(get_the_ID()) ?: '';


          ?>
            <div class="col-sm-6 col-md-4 col-lg-4">
              <div class="causes bg-lighter box-hover-effect effect1 maxwidth500 mb-sm-30 overflow-visible">
                <div class="thumb">
                  <img class="img-fullwidth" alt="<?php the_title(); ?>" src="<?php echo esc_url($featured_image);?>">
                </div>
                <div class="progress-item mt-0">
                  <div class="progress mb-0">
                    <div class="progress-bar" data-percent="<?php echo $percentage; ?>"></div>
                  </div>
                </div>
                <div class="causes-details clearfix border-bottom p-15 pt-10">
                  <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                  <p><?php echo $excerpt; ?></p>
                  <ul class="list-inline clearfix mt-20">
                    <li class="pull-left pr-0">Raised: $<?php echo number_format($raised); ?></li>
                    <li class="text-theme-colored pull-right pr-0">Goal: $<?php echo number_format($goal); ?></li>
                  </ul>
                  <div class="mt-10">
                    <a class="btn btn-dark btn-theme-colored btn-flat btn-sm pull-left mt-10 ajaxload-popup" href="<?php echo get_template_directory_uri(); ?>/ajax-load/donation-form.html">Donate</a>
                    <div class="pull-right mt-15">
                      <i class="fa fa-heart-o text-theme-colored"></i> <?php echo number_format($donors); ?> Donors
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php 
            endwhile;
            wp_reset_postdata();
            endif;
          ?>
        </div>
      </div>
    </section>