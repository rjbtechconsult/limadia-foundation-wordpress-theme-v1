<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Limadia_Entity_Foundation_V1
 */

get_header();
?>

<?php if (have_posts()) : while (have_posts()) : the_post(); 
    $featured_image = get_the_post_thumbnail_url(get_the_ID(), 'full');
?>

<section class="inner-header divider layer-overlay overlay-dark" data-bg-img="http://placehold.it/1920/1280">
    <div class="container pt-30 pb-30">
        <div class="section-content text-center">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center">
                    <h2 class="text-theme-colored font-36"><?php the_title(); ?></h2>
                    <ol class="breadcrumb text-center mt-10 white">
                        <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
                        <li><a href="<?php echo esc_url( home_url( '/insights' ) ); ?>">Insights</a></li>
                        <li class="active"><?php the_title(); ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>      
</section>

<main id="primary" class="site-main">
    <section>
        <div class="container pt-60 pb-60">
            <div class="row">
                <div class="col-md-9">
                    <div class="blog-posts single-post">
                        <article class="post clearfix mb-0">
                            <div class="entry-header">
                                <?php if ($featured_image): ?>
                                <div class="post-thumb thumb mb-30">
                                    <img src="<?php echo esc_url($featured_image); ?>" alt="<?php the_title_attribute(); ?>" class="img-responsive img-fullwidth">
                                </div>
                                <?php endif; ?>
                            </div>
                            <div class="entry-title pt-0">
                                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            </div>
                            <div class="entry-meta">
                                <ul class="list-inline">
                                    <li>Posted: <span class="text-theme-colored"><?php echo get_the_date(); ?></span></li>
                                    <li><i class="fa fa-folder-o text-theme-colored mr-5"></i><span class="text-theme-colored"><?php the_category(', '); ?></span></li>
                                </ul>
                            </div>
                            <div class="entry-content mt-10">
                                <?php the_content(); ?>
                            </div>
                        </article>
                        
                        <?php
                        $share_url   = urlencode( get_permalink() );
                        $share_title = urlencode( get_the_title() );
                        ?>
                        <div class="tagline p-0 pt-20 mt-5">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="share text-right">
                                        <p class="mb-0 mr-10" style="display: inline-block;"><i class="fa fa-share-alt text-theme-colored"></i> Share:</p>
                                        <ul class="styled-icons icon-sm icon-dark icon-theme-colored mt-0" style="display: inline-block; margin-bottom: 0; vertical-align: middle;">
                                            <li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $share_url; ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                            <li><a href="https://twitter.com/intent/tweet?text=<?php echo $share_title; ?>&url=<?php echo $share_url; ?>" target="_blank"><i class="fa" style="font-family: sans-serif; font-style: normal; font-weight: bold;">X</i></a></li>
                                            <li><a href="https://api.whatsapp.com/send?text=<?php echo $share_title; ?>%20<?php echo $share_url; ?>" target="_blank"><i class="fa fa-whatsapp"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="call-to-action border-1px bg-lighter mt-40 mb-30 p-30 pt-40 pb-40 text-center">
                            <h3 class="mt-0">Help Us Make a Difference</h3>
                            <p class="mb-20 text-gray-dimgray font-15">Your contribution helps us continue our mission of providing holistic development for children and healthcare for the elderly in Ghana.</p>
                            <a class="btn btn-colored btn-theme-colored btn-flat ajaxload-popup" href="<?php echo get_template_directory_uri(); ?>/ajax-load/donation-form.html"><i class="fa fa-heart-o text-white mr-5"></i> Donate Today</a>
                        </div>

                        <?php
                        // If comments are open or we have at least one comment, load up the comment template.
                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        endif;
                        ?>
                    </div>
                </div>

                <div class="col-sm-12 col-md-3">
                    <div class="sidebar sidebar-right mt-sm-30">
                        <div class="widget">
                            <h5 class="widget-title line-bottom">Search</h5>
                            <div class="search-form">
                                <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                                    <div class="input-group">
                                        <input type="search" class="form-control search-field" placeholder="Type & Search..." name="s" data-height="37px" />
                                        <span class="input-group-btn">
                                            <button type="submit" class="btn btn-colored btn-theme-colored m-0" data-height="37px"><i class="fa fa-search text-white"></i></button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>
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
                        <div class="widget">
                            <h5 class="widget-title line-bottom">Recent Insights</h5>
                            <div class="latest-posts">
                                <?php
                                $recent_posts = new WP_Query( array(
                                    'posts_per_page'      => 3,
                                    'post_status'         => 'publish',
                                    'ignore_sticky_posts' => true,
                                    'post__not_in'        => array(get_the_ID())
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

<?php endwhile; endif; ?>

<?php get_footer(); ?>
