<?php

function autoshowroom_condition_vehicle( $atts )
{
    $autoshowroom_vehicle_condition
    = $autoshowroom_vehicle_title
    = $autoshowroom_vehicle_description
    = $autoshowroom_vehicle_description_limit
    = $autoshowroom_vehicle_specifications = $autoshowroom_specifications_values = $tz_size
    = $autoshowroom_vehicle_carousel_number = $autoshowroom_vehicle_carousel_button
    = $autoshowroom_vehicle_carousel_loop = $autoshowroom_vehicle_carousel_margin
    = $autoshowroom_vehicle_carousel_autoplay= $autoshowroom_vehicle_carousel_layout = $autoshowroom_vehicle_carousel_center = $autoshowroom_vehicle_carousel_dots
    = $el_class = '';
    extract(shortcode_atts(array(
        'autoshowroom_vehicle_condition'            =>  'new',
        'autoshowroom_vehicle_title'                =>  'show',
        'autoshowroom_vehicle_description'          =>  'show',
        'autoshowroom_vehicle_description_limit'    =>  '',
        'autoshowroom_vehicle_specifications'       =>  'show',
        'autoshowroom_specifications_values'        =>  '',
        'autoshowroom_vehicle_carousel_layout'      =>  'grid',
        'autoshowroom_vehicle_carousel_center'      =>  'true',
        'tz_size'                                   =>  'large',
        'autoshowroom_vehicle_carousel_number'      =>  5,
        'autoshowroom_vehicle_carousel_button'      =>  'true',
        'autoshowroom_vehicle_carousel_dots'        =>  'false',
        'autoshowroom_vehicle_carousel_loop'        =>  'true',
        'autoshowroom_vehicle_carousel_margin'      =>  30,
        'autoshowroom_vehicle_carousel_autoplay'    =>  'true',
        'el_class'                                  =>  ''
    ), $atts));
    ob_start();
    wp_enqueue_style('autoshowroom-owl-carousel-style');
    wp_enqueue_script('autoshowroom-owl-carousel-script');
    $showmsrp       = ot_get_option('autoshowroom_Detail_show_msrp','yes');
    $content_class = '';
    if($autoshowroom_vehicle_carousel_layout == 'grid'){
        $content_class = 'container';
    } else{
        $content_class = '';
    }
    $query_args = array(
        'post_type'=>'vehicle',
        'post_status'=>'publish',
        'ignore_sticky_posts' => 1,
        'posts_per_page'      => -1,
        'meta_query' => array(
            array(
                'key' => 'condition',
                'value' => $autoshowroom_vehicle_condition,
            ),
        ),
    );
    $vehicles = new WP_Query( $query_args );
    $autoshowroom_specifications_arr = explode(",",$autoshowroom_specifications_values);
    $autoshowroom_speci_total = count($autoshowroom_specifications_arr);
    if ( $vehicles->have_posts() ) : ?>
        <div class="owl-carousel features TZ-Vehicle-Feature <?php echo esc_attr($content_class);?> <?php if( $el_class != '' ) echo esc_attr($el_class); ?>">

            <?php while ( $vehicles->have_posts() ) : $vehicles->the_post();
                ?>
            <div class="item">
                <div class="Vehicle-Feature-Image">
                    <a href="<?php echo get_permalink(); ?>">
                        <?php the_post_thumbnail( $tz_size); ?>
                    </a>
                    <?php
                    $pricesold = get_field('autoshowroom_vehicle_sold',get_the_ID());
                    $pricetext = get_field( 'pricetext',get_the_ID());
                    $pricelink = get_field( 'pricelink',get_the_ID());
                    if($pricesold=='sold'){ ?>
                        <p class="pcd-pricing">
                            <span class="pcd-price"><?php echo esc_html__('SOLD','tz-autoshowroom');?></span>
                        </p>
                        <?php
                    }elseif($pricesold == 'upcoming'){ ?>
                        <p class="pcd-pricing">
                            <span class="pcd-price"><?php echo esc_html__('Upcoming','tz-autoshowroom');?></span>
                        </p>
                        <?php
                    } elseif($pricetext !='') { ?>
                        <p class="pcd-pricing">
                            <?php
                            if($pricelink !=''){ ?>
                            <a class="priceurl" href="<?php echo esc_url($pricelink);?>">
                                <?php }
                                ?>

                                <span class="pcd-price"><?php echo esc_attr($pricetext);?></span>
                                <?php
                                if($pricelink !=''){ ?>
                            </a>
                        <?php }
                        ?>
                        </p>
                        <?php
                    }else
                    {
                        echo balanceTags(tz_autoshowroom_filter_vehicle_price(get_the_ID(),$showmsrp));
                    }
                    ?>
                </div>
                <?php if($autoshowroom_vehicle_title=='show'){ ?>
                    <h4 class="Vehicle-Title">
                        <a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a>
                    </h4>
                <?php } ?>
                <?php
                if($autoshowroom_vehicle_description=='show'){
                    if($autoshowroom_vehicle_description_limit){ ?>
                    <div class="vehicle-feature-des">
                        <p><?php echo substr(strip_tags(get_the_excerpt()), 1, $autoshowroom_vehicle_description_limit);?></p>
                    </div>
                    <?php } else{
                    echo '<p class="vehicle-feature-excerpt">' .  get_the_excerpt() . '</p>';
                    }
                }?>
                <div class="vehicle-specs-<?php echo esc_attr__($autoshowroom_speci_total);?>">
                    <?php echo tz_autoshowroom_get_vehicle_specs(get_the_ID(),$autoshowroom_specifications_arr);?>
                    <div class="clearfix"></div>
                </div>

            </div>
            <?php endwhile; ?>
        </div>

    <?php endif;
    wp_reset_postdata();
    ?>

    <script type="text/javascript" defer="defer">
        jQuery(document).ready(function(){
            jQuery('.features.TZ-Vehicle-Feature').each(function(){
                jQuery(this).parents('.vc_row').addClass('over-hidden');
                jQuery(this).autoshowroom_owlCarousel({
                    loop:<?php echo esc_attr($autoshowroom_vehicle_carousel_loop); ?>,
                    margin:<?php echo esc_attr($autoshowroom_vehicle_carousel_margin); ?>,
                    responsiveClass:true,
                    autoplay:<?php echo esc_attr($autoshowroom_vehicle_carousel_autoplay);?>,
                    dots: <?php echo esc_attr($autoshowroom_vehicle_carousel_dots); ?>,
                    responsive:{
                        0:{
                            items:1,
                            nav:true,
                            center: false
                        },
                        600:{
                            items:1,
                            nav:true,
                            center: false
                        },
                        1024:{
                            items:2,
                            nav:true,
                            center: false
                        },
                        1200:{
                            items:<?php echo esc_attr($autoshowroom_vehicle_carousel_number);?>,
                            nav:<?php echo esc_attr($autoshowroom_vehicle_carousel_button);?>,
                            center: <?php echo esc_attr($autoshowroom_vehicle_carousel_center); ?>
                        }
                    }
                })
            })
        })

    </script>
<?php
    $autoshowroom_condition_vehicle = ob_get_contents();
    ob_end_clean();
    return $autoshowroom_condition_vehicle;
}
add_shortcode('autoshowroom-condition-vehicle', 'autoshowroom_condition_vehicle');

?>