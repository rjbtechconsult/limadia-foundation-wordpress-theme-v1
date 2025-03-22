<?php get_header();?>


<?php if (have_posts()) : while (have_posts()) : the_post(); 
    $goal = get_post_meta(get_the_ID(), '_cause_goal', true);
    $raised = get_post_meta(get_the_ID(), '_cause_raised', true);
    $goal = floatval($goal);
    $raised = floatval($raised);
    $percentage = ($goal > 0) ? round(($raised / $goal) * 100) : 0;
    $featured_image = get_the_post_thumbnail_url(get_the_ID(), 'full');

?>

 <!-- Section: inner-header 1920/1280 -->
<section class="inner-header divider layer-overlay overlay-dark" data-bg-img="<?php echo esc_url($featured_image); ?>">
    <div class="container pt-30 pb-30">
        <!-- Section Content -->
        <div class="section-content text-center">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 text-center">
            <h2 class="text-theme-colored font-36"><?php the_title(); ?></h2>
            <ol class="breadcrumb text-center mt-10 white">
                <li><a href="/">Home</a></li>
                <li><a href="/causes">Causes</a></li>
                <li class="active"><?php the_title(); ?></li>
            </ol>
            </div>
        </div>
        </div>
    </div>      
</section>

<!-- Divider: Partners & Donors -->
<section>
    <div class="container">
        <div class="row">
        <div class="col-sm-12 col-md-9">
            <div class="upcoming-events media bg-light p-15 pb-60 mb-50 mb-sm-30">
                <?php if ($featured_image): ?>
                    <div class="thumb">
                        <img class="img-fullwidth" src="<?php echo esc_url($featured_image); ?>" alt="<?php the_title(); ?>">
                    </div>
                <?php endif; ?>
                <div class="event-details mt-30">
                    <h4 class="media-heading text-uppercase font-weight-500"><?php the_title(); ?></h4>
                    <?php the_content(); ?>
                </div>
                <div class="">
                        <div class="event-count causes clearfix p-15">
                            <div class="progress-item mt-20 mb-30">
                                <div class="progress mb-30">
                                    <div class="progress-bar" data-percent="<?php echo $percentage; ?>"></div>
                                </div>
                            </div>
                            <ul class="list-inline clearfix">
                                <li class="pull-left pr-0">Raised: $<?php echo get_post_meta(get_the_ID(), '_cause_raised', true); ?></li>
                                <li class="pull-right pr-0"><i class="fa fa-heart-o text-theme-colored"></i> <?php echo get_post_meta(get_the_ID(), '_cause_donors', true); ?> Donors</li>
                            </ul>
                            <div class="mt-10">
                                <ul class="pull-left list-inline mt-20">
                                    <li class="text-theme-colored pr-0">Goal: $<?php echo get_post_meta(get_the_ID(), '_cause_goal', true); ?></li>
                                </ul>
                                <a href="<?php echo get_template_directory_uri(); ?>/ajax-load/donation-form.html" class="btn btn-dark btn-flat btn-sm pull-right mt-15 ajaxload-popup">Donate</a>
                            </div>
                        </div>
                    </div>
            </div>

            <!-- Get other causes in the same category -->
            <?php
                // Get current cause ID
                $current_cause_id = get_the_ID();

                // Get current cause categories
                $terms = wp_get_post_terms($current_cause_id, 'category'); // Use your taxonomy if different

                if (!empty($terms)) {
                    $term_ids = wp_list_pluck($terms, 'term_id'); // Extract category IDs

                    // Query for related causes in the same category
                    $related_causes = new WP_Query(array(
                        'post_type'      => 'cause',
                        'posts_per_page' => 20, // Change as needed
                        'post__not_in'   => array($current_cause_id), // Exclude current cause
                        'tax_query'      => array(
                            array(
                                'taxonomy' => 'category', // Ensure this matches your taxonomy
                                'field'    => 'term_id',
                                'terms'    => $term_ids,
                            ),
                        ),
                    ));
                    
                    if ($related_causes->have_posts()) :?>

                        <h3 class="mt-0 text-gray">Related Causes</h3>
                        <div class="gallery-list-carosel owl-nav-top">
                            <?php while ($related_causes->have_posts()) : $related_causes->the_post(); ?>
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="item">
                                        <a href="<?php the_permalink(); ?>">
                                            <img alt="" src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'thumbnail'); ?>">
                                        </a>
                                    </div>    
                                <?php endif; ?>
                            <?php endwhile; ?>
                        </div>
                        
                <?php
                    endif;
                    wp_reset_postdata(); // Reset query
                }
                ?>            
        </div>
        
        <div class="col-sm-12 col-md-3">
            <div class="sidebar sidebar-right mt-sm-30">
            <!-- <div class="widget">
                <h5 class="widget-title line-bottom">Search box</h5>
                <div class="search-form">
                <form>
                    <div class="input-group">
                    <input type="text" placeholder="Click to Search" class="form-control search-input">
                    <span class="input-group-btn">
                    <button type="submit" class="btn search-button"><i class="fa fa-search"></i></button>
                    </span>
                    </div>
                </form>
                </div>
            </div> -->
            <!-- <div class="widget">
                <h5 class="widget-title line-bottom">Categories</h5>
                <div class="categories">
                <ul class="list list-border angle-double-right">
                    <li><a href="#">Creative<span>(19)</span></a></li>
                    <li><a href="#">Portfolio<span>(21)</span></a></li>
                    <li><a href="#">Fitness<span>(15)</span></a></li>
                    <li><a href="#">Gym<span>(35)</span></a></li>
                    <li><a href="#">Personal<span>(16)</span></a></li>
                </ul>
                </div>
            </div> -->
            <div class="widget">
                <h5 class="widget-title line-bottom">Latest News</h5>
                <div class="latest-posts">
                <article class="post media-post clearfix pb-0 mb-10">
                    <a class="post-thumb" href="#"><img src="https://placehold.it/75x75" alt=""></a>
                    <div class="post-right">
                    <h5 class="post-title mt-0"><a href="#">Sustainable Construction</a></h5>
                    <p>Lorem ipsum dolor sit amet adipisicing elit...</p>
                    </div>
                </article>
                <article class="post media-post clearfix pb-0 mb-10">
                    <a class="post-thumb" href="#"><img src="https://placehold.it/75x75" alt=""></a>
                    <div class="post-right">
                    <h5 class="post-title mt-0"><a href="#">Industrial Coatings</a></h5>
                    <p>Lorem ipsum dolor sit amet adipisicing elit...</p>
                    </div>
                </article>
                <article class="post media-post clearfix pb-0 mb-10">
                    <a class="post-thumb" href="#"><img src="https://placehold.it/75x75" alt=""></a>
                    <div class="post-right">
                    <h5 class="post-title mt-0"><a href="#">Storefront Installations</a></h5>
                    <p>Lorem ipsum dolor sit amet adipisicing elit...</p>
                    </div>
                </article>
                </div>
            </div>
            <!-- <div class="widget">
                <h5 class="widget-title line-bottom">Photos from Flickr</h5>
                <div id="flickr-feed" class="clearfix">
                <script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=9&amp;display=latest&amp;size=s&amp;layout=x&amp;source=user&amp;user=52617155@N08">
                </script>
                </div>
            </div> -->
            </div>
        </div>
        </div>
    </div>
</section>

<?php endwhile; endif; ?>

<?php get_footer();?>