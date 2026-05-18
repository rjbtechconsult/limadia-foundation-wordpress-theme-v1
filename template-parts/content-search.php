<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Limadia_Entity_Foundation_V1
 */

// Get post type information for user-friendly badge
$post_type = get_post_type();
$post_type_label = '';
$badge_class = 'label-default';

switch ( $post_type ) {
    case 'post':
        $post_type_label = esc_html__( 'Blog Post', 'limadia-entity-foundation-v1' );
        $badge_class = 'label-theme-colored';
        break;
    case 'page':
        $post_type_label = esc_html__( 'Page', 'limadia-entity-foundation-v1' );
        $badge_class = 'bg-dark';
        break;
    case 'causes':
        $post_type_label = esc_html__( 'Cause', 'limadia-entity-foundation-v1' );
        $badge_class = 'label-success';
        break;
    case 'jobs':
        $post_type_label = esc_html__( 'Career', 'limadia-entity-foundation-v1' );
        $badge_class = 'label-warning';
        break;
    default:
        $post_type_label = esc_html( get_post_type_object( $post_type )->labels->singular_name );
        $badge_class = 'label-default';
        break;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post clearfix mb-40 pb-35 border-bottom-1px' ); ?>>
  <div class="entry-header">
    <?php if ( has_post_thumbnail() ) : ?>
      <div class="post-thumb mb-20">
        <a href="<?php the_permalink(); ?>">
          <img src="<?php the_post_thumbnail_url( 'large' ); ?>" alt="<?php the_title_attribute(); ?>" class="img-fullwidth img-responsive border-1px">
        </a>
      </div>
    <?php endif; ?>
    
    <div class="entry-meta mb-10">
      <span class="label <?php echo esc_attr( $badge_class ); ?> text-white font-11 px-10 py-5 mr-10" style="padding: 3px 8px;"><?php echo esc_html( $post_type_label ); ?></span>
      
      <?php if ( 'post' === $post_type ) : ?>
        <ul class="list-inline font-12 display-inline-block" style="display: inline-block;">
          <li><?php esc_html_e( 'posted by', 'limadia-entity-foundation-v1' ); ?> <span class="text-theme-colored"><?php the_author_posts_link(); ?></span></li>
          <li>|</li>
          <li><span class="text-theme-colored"><?php echo get_the_date(); ?></span></li>
        </ul>
      <?php endif; ?>
    </div>
    
    <h3 class="entry-title font-22 mt-0 pt-0 mb-15">
      <a href="<?php the_permalink(); ?>" class="text-black-333 hover-theme-colored"><?php the_title(); ?></a>
    </h3>
  </div>

  <div class="entry-content">
    <div class="text-gray-dimgray font-14 mb-20 line-height-1-6">
      <?php the_excerpt(); ?>
    </div>
    <a class="text-gray font-13 font-weight-600 hover-theme-colored" href="<?php the_permalink(); ?>">
      <i class="fa fa-angle-double-right text-theme-colored mr-5"></i><?php esc_html_e( 'Read more', 'limadia-entity-foundation-v1' ); ?>
    </a>
  </div>
</article>
