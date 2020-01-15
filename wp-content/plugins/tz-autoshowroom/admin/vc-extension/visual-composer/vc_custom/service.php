<?php

$args = array(
    "tz_number_item_desk"                   => "3",
    "tz_number_item_tablet_landscape"       => "3",
    "tz_number_item_tablet_portrait"        => "1",
    "tz_number_item_mobile"                 => "1",
    "tz_auto_option"                        => "",
    "tz_loop_option"                        => "",
    "tz_nav_option"                         => "",
    "tz_dots_option"                        => "",
    "tz_css_animation"                      => "",
);

$html = "";

extract(shortcode_atts($args, $atts));

wp_enqueue_style( 'owl.carousel');
wp_enqueue_script('owl.carousel');

if($tz_css_animation != ''){
    wp_enqueue_script( 'waypoints' );
    $tzautoshowromm_class .= ' wpb_animate_when_almost_visible wpb_' . $tz_css_animation;
}

$autoshowroom_slideid = rand(0,10000);

?>
<div class="tzElement_viewService <?php echo esc_attr($tzautoshowromm_class);?>">
    <div class="tzView_Service_Slide">
        <?php
       echo do_shortcode($content);
      // var_dump($content);
        ?>
    </div>
</div>

<script type="text/javascript" defer="defer">
    jQuery(document).ready(function(){
        jQuery('.tzView_Service_Slide').each(function(){
            jQuery(this).autoshowroom_owlCarousel({
                loop:<?php if($tz_loop_option == true){ echo 'true';}else{ echo 'false';}?>,
                margin: 10,
                navText : ["<i class=\"fas fa-caret-left\"></i>","<i class=\"fas fa-caret-right\"></i>"],
                rewindNav : true,
                responsiveClass:true,
                autoplay:<?php if($tz_auto_option == true){ echo 'true';}else{ echo 'false';}?>,
                ltl:true,
                responsive:{
                    0:{
                        items:<?php if($tz_number_item_mobile != ''){ echo esc_attr($tz_number_item_mobile);} else{ echo '1';}?>,
                        nav:true,
                        center: false
                    },
                    600:{
                        items:<?php if($tz_number_item_tablet_portrait != ''){ echo esc_attr($tz_number_item_tablet_portrait);} else{ echo '1';}?>,
                        nav:true,
                        center: false
                    },
                    1024:{
                        items:<?php if($tz_number_item_tablet_landscape != ''){ echo esc_attr($tz_number_item_tablet_landscape);} else{ echo '3';}?>,
                        nav:true,
                        center: false
                    },
                    1200:{
                        items:<?php if($tz_number_item_desk != ''){ echo esc_attr($tz_number_item_desk);} else{ echo '3';}?>,
                        nav:true,
                        center: false
                    }
                }

            })

        })
    })
</script>






