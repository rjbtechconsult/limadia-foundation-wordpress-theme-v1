<section class="inner-header divider layer-overlay overlay-dark" data-bg-img="http://picsum.photos/1920/1280">
    <div class="container pt-30 pb-30">
    <!-- Section Content -->
    <div class="section-content text-center">
        <div class="row"> 
        <div class="col-md-6 col-md-offset-3 text-center">
            <h3 class="text-theme-colored font-36">Causes</h3>
            <ol class="breadcrumb text-center mt-10 white">
            <li><a href="/">Home</a></li>
            <li><a href="/about">About</a></li>
            <li class="active">Causes</li>
            </ol>
        </div>
        </div>
    </div>
    </div>
</section>

<!-- Section: Upcoming Event -->
<section>
    <div class="container">
        <div class="row">
            
            <div class="col-sm-12 col-md-9">

                <?php
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // Get current page
                    $args = array(
                        'post_type'      => 'cause', // Change this to your CPT name
                        'posts_per_page' => 42, // Set how many causes per page
                        'orderby'        => 'date',
                        'order'          => 'DESC',
                        'paged'          => $paged, // Add pagination
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
                            $featured_image = get_the_post_thumbnail_url(get_the_ID(), 'large') ?: 'https://yourwebsite.com/default-image.jpg';


                            ?>
                                <div class="upcoming-events box-hover-effect effect1 media maxwidth400 bg-light mb-20">
                                    <div class="row equal-height">
                                        <div class="col-sm-4 pr-0 pr-sm-15">
                                            <div class="thumb p-15">
                                            <img class="img-fullwidth" src="<?php echo $featured_image;?>" alt="<?php the_title(); ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-4 border-right pl-0 pl-sm-15">
                                            <div class="event-details p-15 mt-20">
                                            <h4 class="media-heading text-uppercase font-weight-500"><?php the_title(); ?></h4>
                                            <p><?php echo $excerpt; ?></p>
                                            <a href="<?php the_permalink(); ?>" class="text-theme-colored">Details <i class="fa fa-angle-double-right"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="event-count causes p-15 mt-15">
                                            <div class="progress-item mt-20 mb-40">
                                                <div class="progress mb-30">
                                                <div class="progress-bar" data-percent="<?php echo $percentage; ?>"></div>
                                                </div>
                                            </div>
                                            <ul class="list-inline clearfix">
                                                <li class="pull-left pr-0">Raised: $<?php echo number_format($raised); ?></li>
                                                <li class="text-theme-colored pull-right pr-0">Goal: $<?php echo number_format($goal); ?></li>
                                            </ul>
                                            <div class="mt-10">
                                                <ul class="pull-left list-inline mt-15">
                                                <li class="pr-0"><i class="fa fa-heart-o text-theme-colored"></i> <?php echo number_format($donors); ?> Donors</li>
                                                </ul>
                                                <a href="<?php echo get_template_directory_uri(); ?>/ajax-load/donation-form.html" class="btn btn-dark btn-flat btn-sm pull-right mt-10 ajaxload-popup">Donate</a>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile;
                            // Pagination
                            custom_pagination($causes_query);
                            wp_reset_postdata();
                    else :
                        echo '<p>No causes found.</p>';
                    endif;
                    ?>
                    
            </div>

            <div class="col-sm-12 col-md-3">
                <div class="sidebar sidebar-right mt-sm-30">
                    <div class="widget">
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
                        </div>
                        <div class="widget">
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
                        </div>
                        <div class="widget">
                        <h5 class="widget-title line-bottom">Latest News</h5>
                        <div class="latest-posts">
                            <article class="post media-post clearfix pb-0 mb-10">
                                <a class="post-thumb" href="#"><img src="https://picsum.photos/75/75" alt=""></a>
                                <div class="post-right">
                                    <h5 class="post-title mt-0"><a href="#">Sustainable Construction</a></h5>
                                    <p>Lorem ipsum dolor sit amet adipisicing elit...</p>
                                </div>
                            </article>

                            <article class="post media-post clearfix pb-0 mb-10">
                                <a class="post-thumb" href="#"><img src="https://picsum.photos/75/75" alt=""></a>
                                <div class="post-right">
                                    <h5 class="post-title mt-0"><a href="#">Industrial Coatings</a></h5>
                                    <p>Lorem ipsum dolor sit amet adipisicing elit...</p>
                                </div>
                            </article>

                            <article class="post media-post clearfix pb-0 mb-10">
                                <a class="post-thumb" href="#"><img src="https://picsum.photos/75/75" alt=""></a>
                                <div class="post-right">
                                    <h5 class="post-title mt-0"><a href="#">Storefront Installations</a></h5>
                                    <p>Lorem ipsum dolor sit amet adipisicing elit...</p>
                                </div>
                            </article>

                            <article class="post media-post clearfix pb-0 mb-10">
                                <a class="post-thumb" href="#"><img src="https://picsum.photos/75/75" alt=""></a>
                                <div class="post-right">
                                    <h5 class="post-title mt-0"><a href="#">Storefront Installations</a></h5>
                                    <p>Lorem ipsum dolor sit amet adipisicing elit...</p>
                                </div>
                            </article>

                            
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>