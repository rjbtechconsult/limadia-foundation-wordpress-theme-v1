<?php
/**
 * Template Name: Insights
 *
 * @package Limadia_Entity_Foundation_V1
 */

get_header();
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
            <li class="active"><?php the_title(); ?></li>
          </ol>
        </div>
      </div>
    </div>
  </div>      
</section>

<main id="primary" class="site-main">
  <section class="bg-white">
    <div class="container pt-60 pb-60">
      <div class="row">
        
        <!-- Content Area -->
        <div class="col-md-9">
          <div class="blog-posts">
            <div class="row list-dashed">
              <?php
              $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
              $insights_query = new WP_Query( array(
                  'post_type'      => 'post',
                  'posts_per_page' => 10,
                  'paged'          => $paged,
              ) );

              if ( $insights_query->have_posts() ) :
                while ( $insights_query->have_posts() ) : $insights_query->the_post();
                ?>
                <article class="post clearfix mb-30 bg-lighter">
                  <div class="entry-header">
                    <?php if ( has_post_thumbnail() ) : ?>
                    <div class="post-thumb thumb">
                      <img src="<?php the_post_thumbnail_url( 'large' ); ?>" alt="<?php the_title_attribute(); ?>" class="img-responsive img-fullwidth">
                    </div>
                    <?php endif; ?>
                  </div>
                  <div class="entry-content p-20 pr-10">
                    <div class="entry-meta media mt-0 no-bg no-border">
                      <div class="entry-date media-left text-center flip bg-theme-colored pt-5 pr-15 pb-5 pl-15">
                        <ul>
                          <li class="font-16 text-white font-weight-600 border-bottom"><?php echo get_the_date('d'); ?></li>
                          <li class="font-12 text-white text-uppercase"><?php echo get_the_date('M'); ?></li>
                        </ul>
                      </div>
                      <div class="media-body pl-15">
                        <div class="event-content pull-left flip">
                          <h4 class="entry-title text-uppercase m-0 mt-5"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                          <span class="mb-10 text-gray-darkgray mr-10 font-13"><i class="fa fa-calendar-o mr-5 text-theme-colored"></i> <?php echo get_the_date(); ?></span>
                          <span class="mb-10 text-gray-darkgray mr-10 font-13"><i class="fa fa-folder-o mr-5 text-theme-colored"></i> <?php the_category(', '); ?></span>
                        </div>
                      </div>
                    </div>
                    <p class="mt-10"><?php echo wp_trim_words( get_the_excerpt(), 30, '...' ); ?></p>
                    <a href="<?php the_permalink(); ?>" class="btn-read-more">Read more</a>
                    <div class="clearfix"></div>
                  </div>
                </article>
                <?php
                endwhile;
                ?>
            </div>
            
            <!-- Pagination -->
            <div class="row mt-30">
              <div class="col-md-12">
                <style>
                  .pagination.theme-colored li.active > a,
                  .pagination.theme-colored li.active > span,
                  .pagination.theme-colored li.active > a:hover,
                  .pagination.theme-colored li.active > span:hover,
                  .pagination.theme-colored li.active > a:focus,
                  .pagination.theme-colored li.active > span:focus {
                      background-color: #FA7920 !important;
                      border-color: #FA7920 !important;
                      color: #fff !important;
                  }
                  .pagination.theme-colored li > a,
                  .pagination.theme-colored li > span {
                      color: #FA7920;
                      border: 1px solid #ddd;
                  }
                  .pagination.theme-colored li > a:hover,
                  .pagination.theme-colored li > span:hover {
                      background-color: #FA7920 !important;
                      border-color: #FA7920 !important;
                      color: #fff !important;
                  }
                </style>
                <?php
                $links = paginate_links( array(
                    'total'     => $insights_query->max_num_pages,
                    'current'   => $paged,
                    'prev_text' => '<span aria-hidden="true">&laquo;</span>',
                    'next_text' => '<span aria-hidden="true">&raquo;</span>',
                    'type'      => 'array'
                ) );
                if ( $links ) {
                    echo '<nav><ul class="pagination theme-colored m-0">';
                    foreach ( $links as $link ) {
                        $active = strpos( $link, 'current' ) !== false ? 'class="active"' : '';
                        $link = str_replace( 'page-numbers', '', $link );
                        echo "<li $active>$link</li>";
                    }
                    echo '</ul></nav>';
                }
                ?>
              </div>
            </div>
            <?php
              wp_reset_postdata();
            else :
            ?>
            <div class="text-center pt-40 pb-40">
              <i class="fa fa-newspaper-o text-gray-light font-72 mb-20"></i>
              <h3 class="font-24 font-weight-600 text-black-333 mt-0">No Insights Yet</h3>
              <p class="font-16 text-gray-dimgray mt-10 mb-30 maxwidth500 center-block">Check back later for news and articles.</p>
            </div>
            <?php endif; ?>
          </div>
        </div>

        <!-- Sidebar Area -->
        <div class="col-sm-12 col-md-3">
          <div class="sidebar sidebar-right mt-sm-30">
            
            <!-- Widget: Search -->
            <div class="widget">
              <h5 class="widget-title line-bottom">Search</h5>
              <div class="search-form">
                <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                  <div class="input-group">
                    <input type="search" class="form-control search-field" placeholder="Type & Search..." value="<?php echo get_search_query(); ?>" name="s" data-height="37px" />
                    <span class="input-group-btn">
                      <button type="submit" class="btn btn-colored btn-theme-colored m-0" data-height="37px"><i class="fa fa-search text-white"></i></button>
                    </span>
                  </div>
                </form>
              </div>
            </div>
            
            <!-- Widget: Categories -->
            <div class="widget">
              <h5 class="widget-title line-bottom">Categories</h5>
              <div class="categories">
                <ul class="list list-border angle-double-right">
                  <?php
                  $categories = get_categories( array(
                      'orderby' => 'name',
                      'parent'  => 0,
                      'number'  => 6
                  ) );
                  if ($categories) {
                    foreach ( $categories as $category ) {
                        echo '<li><a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->name ) . ' <span>(' . $category->count . ')</span></a></li>';
                    }
                  } else {
                    echo '<li><a href="#">No categories found</a></li>';
                  }
                  ?>
                </ul>
              </div>
            </div>
            
            <!-- Widget: Latest Posts -->
            <div class="widget">
              <h5 class="widget-title line-bottom">Recent Insights</h5>
              <div class="latest-posts">
                <?php
                $recent_posts = new WP_Query( array(
                    'posts_per_page'      => 3,
                    'post_status'         => 'publish',
                    'ignore_sticky_posts' => true
                ) );
                if ( $recent_posts->have_posts() ) :
                    while ( $recent_posts->have_posts() ) : $recent_posts->the_post();
                        ?>
                        <article class="post media-post clearfix pb-0 mb-10">
                          <?php if ( has_post_thumbnail() ) : ?>
                            <a class="post-thumb" href="<?php the_permalink(); ?>"><img src="<?php the_post_thumbnail_url( array( 75, 75 ) ); ?>" alt="<?php the_title_attribute(); ?>"></a>
                          <?php endif; ?>
                          <div class="post-right">
                            <h5 class="post-title mt-0"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                            <p class="font-12 text-gray"><?php echo get_the_date(); ?></p>
                          </div>
                        </article>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                else:
                    echo '<p>No recent posts.</p>';
                endif;
                ?>
              </div>
            </div>

          </div>
        </div>

      </div>
    </div>
  </section>
</main>

<?php
get_footer();
