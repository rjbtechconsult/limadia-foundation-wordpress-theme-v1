<section id="home" class="divider">
    <div class="container-fluid p-0">
        <div class="rev_slider_wrapper">
            <div class="rev_slider" data-version="5.0">
                <?php
                    // Query for Slide CPT
                    $slides = new WP_Query([
                        'post_type'      => 'slide',
                        'posts_per_page' => -1, // Show all slides
                        'orderby'        => 'date',
                        'order'          => 'DESC',
                    ]);
                ?>
                <?php if ($slides->have_posts()) : ?>
                    <ul>
                        <?php while ($slides->have_posts()) : $slides->the_post(); ?>
                            <?php if (has_post_thumbnail()) : ?>
                                <li class="slide-item" data-index="rs-<?php echo $slides->current_post + 1; ?>" data-transition="random" data-slotamount="7"  data-easein="default" data-easeout="default" data-masterspeed="1000"  data-thumb="<?php  echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>"  data-rotate="0"  data-fstransition="fade" data-fsmasterspeed="1500" data-fsslotamount="7" data-saveperformance="off"  data-title="Intro" data-description="">
                                    <!-- MAIN IMAGE -->
                                    <img src="<?php  echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>"  alt=""  data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-bgparallax="6" data-no-retina>
                                    <!-- LAYERS -->

                                    <!-- LAYER NR. 1 -->
                                    <div class="tp-caption BigBold-Title tp-resizeme rs-parallaxlevel-0 text-uppercase"
                                        id="rs-<?php echo $slides->current_post + 1; ?>-layer-1"

                                        data-x="['left','left','left','left']" 
                                        data-hoffset="['50','50','30','17']" 
                                        data-y="['bottom','bottom','bottom','bottom']" 
                                        data-voffset="['110','110','180','160']" 
                                        data-fontsize="['105','100','70','60']"
                                        data-lineheight="['100','90','60','60']"
                                        data-width="['none','none','none','400']"
                                        data-height="none"
                                        data-whitespace="['nowrap','nowrap','nowrap','normal']"
                                        data-transform_idle="o:1;"
                                        data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:1500;e:Power3.easeInOut;" 
                                        data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" 
                                        data-mask_in="x:0px;y:[100%];" 
                                        data-mask_out="x:inherit;y:inherit;" 
                                        data-start="500" 
                                        data-splitin="none" 
                                        data-splitout="none" 
                                        data-basealign="slide" 
                                        data-responsive_offset="on"
                                        style="z-index: 6; white-space: nowrap;"><span class="text-theme-colored"><?php the_title(); ?></span>
                                    </div>

                                    <!-- LAYER NR. 2 -->
                                    <div class="tp-caption BigBold-SubTitle tp-resizeme rs-parallaxlevel-0"
                                        id="rs-<?php echo $slides->current_post + 1; ?>-layer-2"

                                        data-x="['left','left','left','left']" 
                                        data-hoffset="['55','55','33','20']" 
                                        data-y="['bottom','bottom','bottom','bottom']" 
                                        data-voffset="['40','1','74','58']" 
                                        data-fontsize="['15','15','15','13']"
                                        data-lineheight="['24','24','24','20']"
                                        data-width="['410','410','410','280']"
                                        data-height="['60','100','100','100']"
                                        data-whitespace="normal"
                                        data-transform_idle="o:1;"
                                        data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:1500;e:Power3.easeInOut;" 
                                        data-transform_out="y:50px;opacity:0;s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" 
                                        data-start="650" 
                                        data-splitin="none" 
                                        data-splitout="none" 
                                        data-basealign="slide" 
                                        data-responsive_offset="on"
                                        style="z-index: 7; min-width: 410px; max-width: 410px; max-width: 60px; max-width: 60px; white-space: normal;"><?php echo esc_html(get_post_meta(get_the_ID(), '_slide_subtitle', true)); ?> 
                                    </div>

                                    <!-- LAYER NR. 3 -->
                                    <a 
                                        href="<?php echo get_template_directory_uri(); ?>/ajax-load/donation-form.html"
                                        class="tp-caption btn btn-default btn-transparent btn-flat btn-lg pl-40 pr-40 rs-parallaxlevel-0 ajaxload-popup"
                                        id="rs-<?php echo $slides->current_post + 1; ?>-layer-3"
                                        data-x="['left','left','left','left']" 
                                        data-hoffset="['470','480','30','20']" 
                                        data-y="['bottom','bottom','bottom','bottom']" 
                                        data-voffset="['50','50','30','20']" 
                                        data-width="none"
                                        data-height="none"
                                        data-whitespace="nowrap"
                                        data-transform_idle="o:1;"
                                        data-transform_hover="o:1;rX:0;rY:0;rZ:0;z:0;s:300;e:Power1.easeInOut;"
                                        data-style_hover="c:rgba(255, 255, 255, 1.00);bc:rgba(255, 255, 255, 1.00);cursor:pointer;"
                                        data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:1500;e:Power3.easeInOut;" 
                                        data-transform_out="y:50px;opacity:0;s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" 
                                        data-start="650" 
                                        data-splitin="none" 
                                        data-splitout="none" 
                                        data-actions='[{"event":"click","action":"scrollbelow","offset":"px"}]'
                                        data-basealign="slide" 
                                        data-responsive_offset="on"
                                        style="z-index: 8; white-space: nowrap;border-color:rgba(255, 255, 255, 0.25);outline:none;box-shadow:none;box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;"
                                    >
                                        DONATE NOW 
                                    </a>
                                </li>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    </ul>
                    <?php wp_reset_postdata(); ?>
                <?php endif; ?>
            </div><!-- end .rev_slider -->
        </div>

        <script>
          jQuery(document).ready(function($) {
            $(".rev_slider").revolution({
              sliderType:"standard",
              sliderLayout: "auto",
              dottedOverlay: "none",
              delay: 10000,
              navigation: {
                  keyboardNavigation: "off",
                  keyboard_direction: "horizontal",
                  mouseScrollNavigation: "off",
                  onHoverStop: "off",
                  touch: {
                      touchenabled: "on",
                      swipe_threshold: 75,
                      swipe_min_touches: 1,
                      swipe_direction: "horizontal",
                      drag_block_vertical: false
                  },
                  arrows: {
                      style: "gyges",
                      enable: true,
                      hide_onmobile: false,
                      hide_onleave: true,
                      hide_delay: 200,
                      hide_delay_mobile: 1200,
                      tmp: '',
                      left: {
                          h_align: "left",
                          v_align: "center",
                          h_offset: 0,
                          v_offset: 0
                      },
                      right: {
                          h_align: "right",
                          v_align: "center",
                          h_offset: 0,
                          v_offset: 0
                      }
                  },
                  bullets: {
                    enable:true,
                    hide_onmobile:true,
                    hide_under:960,
                    style:"zeus",
                    hide_onleave:false,
                    direction:"horizontal",
                    h_align:"right",
                    v_align:"bottom",
                    h_offset:80,
                    v_offset:50,
                    space:5,
                    tmp:'<span class="tp-bullet-image"></span><span class="tp-bullet-imageoverlay"></span><span class="tp-bullet-title">{{title}}</span>'
                }
              },
              responsiveLevels: [1240, 1024, 778, 480],
              visibilityLevels: [1240, 1024, 778, 480],
              gridwidth: [1170, 1024, 778, 480],
              gridheight: [550, 768, 960, 720],
              lazyType: "none",
              parallax: {
                  origo: "slidercenter",
                  speed: 1000,
                  levels: [5, 10, 15, 20, 25, 30, 35, 40, 45, 46, 47, 48, 49, 50, 100, 55],
                  type: "scroll"
              },
              shadow: 0,
              spinner: "off",
              stopLoop: "on",
              stopAfterLoops: 0,
              stopAtSlide: -1,
              shuffle: "off",
              autoHeight: "off",
              fullScreenAutoWidth: "off",
              fullScreenAlignForce: "off",
              fullScreenOffsetContainer: "",
              fullScreenOffset: "0",
              hideThumbsOnMobile: "off",
              hideSliderAtLimit: 0,
              hideCaptionAtLimit: 0,
              hideAllCaptionAtLilmit: 0,
              debugMode: false,
              fallbacks: {
                  simplifyAll: "off",
                  nextSlideOnWindowFocus: "off",
                  disableFocusListener: false,
              }
            });
          });
        </script>
    </div>
</section>