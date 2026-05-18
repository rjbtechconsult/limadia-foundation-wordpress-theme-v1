<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Limadia_Entity_Foundation_V1
 */

get_header();
?>

<!-- Section: inner-header -->
<section class="inner-header divider layer-overlay overlay-dark" data-bg-img="<?php echo esc_url( get_template_directory_uri() . '/images/bg1.jpg' ); ?>">
  <div class="container pt-30 pb-30">
    <!-- Section Content -->
    <div class="section-content text-center">
      <div class="row"> 
        <div class="col-md-6 col-md-offset-3 text-center">
          <h2 class="text-theme-colored font-36">404 Error</h2>
          <ol class="breadcrumb text-center mt-10 white">
            <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
            <li class="active">Page Not Found</li>
          </ol>
        </div>
      </div>
    </div>
  </div>      
</section>

<main id="primary" class="site-main">
  <section class="bg-white">
    <div class="container pt-80 pb-80">
      <div class="row">
        <div class="col-md-8 col-md-offset-2 text-center">
          <h1 class="text-theme-colored font-150 line-height-1em mt-0 mb-10"><i class="fa fa-exclamation-triangle text-gray-silver mr-10"></i>404</h1>
          <h2 class="mt-0 font-30 font-weight-600 text-black-333"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'limadia-entity-foundation-v1' ); ?></h2>
          <p class="font-16 text-gray-dimgray mt-15 mb-30"><?php esc_html_e( 'The page you are looking for might have been removed, had its name changed, or is temporarily unavailable. Try searching below or return to our homepage.', 'limadia-entity-foundation-v1' ); ?></p>
          
          <div class="search-form-404 mt-30 mb-40 maxwidth500 center-block">
            <form role="search" method="get" class="search-form form-inline" action="<?php echo esc_url( home_url( '/' ) ); ?>">
              <div class="input-group">
                <input type="search" class="form-control search-field" placeholder="<?php esc_attr_e( 'Search our site...', 'limadia-entity-foundation-v1' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php esc_attr_e( 'Search for:', 'limadia-entity-foundation-v1' ); ?>" data-height="37px" />
                <span class="input-group-btn">
                  <button type="submit" class="btn btn-colored btn-theme-colored m-0" data-height="37px"><i class="fa fa-search text-white"></i></button>
                </span>
              </div>
            </form>
          </div>

          <div class="row mt-50">
            <div class="col-md-12">
              <h4 class="text-black font-18 font-weight-600 mb-20"><?php esc_html_e( 'Or Visit Our Popular Pages', 'limadia-entity-foundation-v1' ); ?></h4>
              <div class="row">
                <div class="col-xs-6 col-sm-3 mb-sm-20">
                  <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-block btn-default btn-flat p-20 font-16 font-weight-600 text-black-333">
                    <i class="fa fa-home text-theme-colored display-block font-28 mb-10"></i> <?php esc_html_e( 'Home', 'limadia-entity-foundation-v1' ); ?>
                  </a>
                </div>
                <div class="col-xs-6 col-sm-3 mb-sm-20">
                  <a href="<?php echo esc_url( home_url( '/about' ) ); ?>" class="btn btn-block btn-default btn-flat p-20 font-16 font-weight-600 text-black-333">
                    <i class="fa fa-info-circle text-theme-colored display-block font-28 mb-10"></i> <?php esc_html_e( 'About Us', 'limadia-entity-foundation-v1' ); ?>
                  </a>
                </div>
                <div class="col-xs-6 col-sm-3 mb-sm-20">
                  <a href="<?php echo esc_url( home_url( '/causes' ) ); ?>" class="btn btn-block btn-default btn-flat p-20 font-16 font-weight-600 text-black-333">
                    <i class="fa fa-heart text-theme-colored display-block font-28 mb-10"></i> <?php esc_html_e( 'Our Causes', 'limadia-entity-foundation-v1' ); ?>
                  </a>
                </div>
                <div class="col-xs-6 col-sm-3 mb-sm-20">
                  <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn btn-block btn-default btn-flat p-20 font-16 font-weight-600 text-black-333">
                    <i class="fa fa-envelope text-theme-colored display-block font-28 mb-10"></i> <?php esc_html_e( 'Contact Us', 'limadia-entity-foundation-v1' ); ?>
                  </a>
                </div>
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

