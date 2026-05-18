<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Limadia_Entity_Foundation_V1
 */

get_header();
?>

<!-- Section: inner-header -->
<section class="inner-header divider layer-overlay overlay-dark" data-bg-img="<?php echo esc_url( get_template_directory_uri() . '/images/bg1.jpg' ); ?>">
  <div class="container pt-35 pb-35">
    <!-- Section Content -->
    <div class="section-content text-center">
      <div class="row"> 
        <div class="col-md-6 col-md-offset-3 text-center">
          <h2 class="text-theme-colored font-36"><?php esc_html_e( 'Search Results', 'limadia-entity-foundation-v1' ); ?></h2>
          <ol class="breadcrumb text-center mt-10 white">
            <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'limadia-entity-foundation-v1' ); ?></a></li>
            <li class="active"><?php printf( esc_html__( 'Search: "%s"', 'limadia-entity-foundation-v1' ), get_search_query() ); ?></li>
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
        
        <?php if ( have_posts() ) : ?>
          
          <!-- Content Area -->
          <div class="col-md-9">
            <div class="blog-posts">
              <div class="row list-dashed">
                <?php
                /* Start the Loop */
                while ( have_posts() ) :
                  the_post();
                  get_template_part( 'template-parts/content', 'search' );
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
                    /* Remove border from nested icon spans inside standard pagination buttons */
                    .pagination.theme-colored li a span {
                        border: none !important;
                        background: transparent !important;
                        padding: 0 !important;
                        margin: 0 !important;
                    }
                  </style>
                  <?php
                  $links = paginate_links( array(
                      'prev_text' => '<span aria-hidden="true">&laquo;</span>',
                      'next_text' => '<span aria-hidden="true">&raquo;</span>',
                      'type'      => 'array'
                  ) );
                  if ( $links ) {
                      echo '<nav><ul class="pagination theme-colored m-0">';
                      foreach ( $links as $link ) {
                          $active = strpos( $link, 'current' ) !== false ? 'class="active"' : '';
                          // Clean up WordPress' custom page-numbers class from outputting
                          $link = str_replace( 'page-numbers', '', $link );
                          echo "<li $active>$link</li>";
                      }
                      echo '</ul></nav>';
                  }
                  ?>
                </div>
              </div>
              
            </div>
          </div>
          
        <?php else : ?>
          
          <!-- No Results Content Area -->
          <div class="col-md-9">
            <div class="text-center pt-40 pb-40">
              <i class="fa fa-search text-gray-light font-72 mb-20"></i>
              <h3 class="font-24 font-weight-600 text-black-333 mt-0"><?php esc_html_e( 'No Results Found', 'limadia-entity-foundation-v1' ); ?></h3>
              <p class="font-16 text-gray-dimgray mt-10 mb-30 maxwidth500 center-block">
                <?php esc_html_e( 'We couldn\'t find anything matching your search keywords. Please try again with different terms.', 'limadia-entity-foundation-v1' ); ?>
              </p>
              
              <div class="search-form-404 maxwidth500 center-block">
                <form role="search" method="get" class="search-form form-inline" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                  <div class="input-group">
                    <input type="search" class="form-control search-field" placeholder="<?php esc_attr_e( 'Search our site...', 'limadia-entity-foundation-v1' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php esc_attr_e( 'Search for:', 'limadia-entity-foundation-v1' ); ?>" data-height="37px" />
                    <span class="input-group-btn">
                      <button type="submit" class="btn btn-colored btn-theme-colored m-0" data-height="37px"><i class="fa fa-search text-white"></i></button>
                    </span>
                  </div>
                </form>
              </div>
            </div>
          </div>
          
        <?php endif; ?>

        <!-- Sidebar Area -->
        <div class="col-sm-12 col-md-3">
          <div class="sidebar sidebar-right mt-sm-30">
            
            <!-- Widget: Search -->
            <div class="widget">
              <h5 class="widget-title line-bottom"><?php esc_html_e( 'Search Again', 'limadia-entity-foundation-v1' ); ?></h5>
              <div class="search-form">
                <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                  <div class="input-group">
                    <input type="search" class="form-control search-field" placeholder="<?php esc_attr_e( 'Type & Search...', 'limadia-entity-foundation-v1' ); ?>" value="<?php echo get_search_query(); ?>" name="s" data-height="37px" />
                    <span class="input-group-btn">
                      <button type="submit" class="btn btn-colored btn-theme-colored m-0" data-height="37px"><i class="fa fa-search text-white"></i></button>
                    </span>
                  </div>
                </form>
              </div>
            </div>
            
            <!-- Widget: Categories -->
            <div class="widget">
              <h5 class="widget-title line-bottom"><?php esc_html_e( 'Categories', 'limadia-entity-foundation-v1' ); ?></h5>
              <div class="categories">
                <ul class="list list-border angle-double-right">
                  <?php
                  $categories = get_categories( array(
                      'orderby' => 'name',
                      'parent'  => 0,
                      'number'  => 6
                  ) );
                  foreach ( $categories as $category ) {
                      echo '<li><a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->name ) . ' <span>(' . $category->count . ')</span></a></li>';
                  }
                  ?>
                </ul>
              </div>
            </div>
            
            <!-- Widget: Latest Posts -->
            <div class="widget">
              <h5 class="widget-title line-bottom"><?php esc_html_e( 'Recent Posts', 'limadia-entity-foundation-v1' ); ?></h5>
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
