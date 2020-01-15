<?php
global $autoshowroom_quote_type;
$args = array(
    "autoshowroom_quote_type"                               => "type1",
    "autoshowroom_center_mode"                              => "true",
    "autoshowroom_number_item_des_center"                   => "3",
    "autoshowroom_number_item_tablet_landscape_center"      => "3",
    "autoshowroom_number_item_tablet_portrait_center"       => "3",
    "autoshowroom_number_item_mobile_center"                => "1",
    "autoshowroom_number_item_des"                          => "5",
    "autoshowroom_number_item_tablet_landscape"             => "5",
    "autoshowroom_number_item_tablet_portrait"              => "3",
    "autoshowroom_number_item_mobile"                       => "1",
    "autoshowroom_css_animation"                            => "",
);

$html = "";

extract(shortcode_atts($args, $atts));

wp_enqueue_style( 'autoshowroom-slick' );
wp_enqueue_script( 'autoshowroom-slick' );

$autoshowroom_quote_class = '';

if($autoshowroom_css_animation != ''){
    wp_enqueue_script( 'waypoints' );
    $tzinteriart_team_class .= ' wpb_animate_when_almost_visible wpb_' . $autoshowroom_css_animation;
}
?>
<div class="container">
<div class="autoshowroom-quote <?php echo esc_attr($autoshowroom_quote_type); ?> au_<?php echo esc_attr($autoshowroom_number_item_des); ?> number-item-<?php echo esc_attr($autoshowroom_number_item_des_center); ?> <?php echo esc_attr($autoshowroom_quote_class);?>">
    <?php
    echo do_shortcode($content);
    ?>
</div>
</div>
<script type="text/javascript">
    jQuery(document).ready(function(){
        "use strict";
        jQuery(".autoshowroom-quote").each(function(){
            jQuery(this).slick({
                centerMode: <?php echo esc_attr($autoshowroom_center_mode);?>,
                centerPadding: '0px',
                slidesToShow: <?php if($autoshowroom_center_mode == 'true'){ echo esc_attr($autoshowroom_number_item_des_center);}else{echo esc_attr($autoshowroom_number_item_des);}?>,
                autoplay:false,
                autoplaySpeed:3000,
                arrows:false,
                dots:true,
                infinite:true,
                focusOnSelect: true,
                adaptiveHeight: true,
                responsive: [
                    {
                        breakpoint: 1199,
                        settings: {
                            arrows: false,
                            centerMode: true,
                            centerPadding: '0px',
                            slidesToShow: <?php if($autoshowroom_center_mode == 'true'){ echo esc_attr($autoshowroom_number_item_tablet_landscape_center);}else{echo esc_attr($autoshowroom_number_item_tablet_landscape);}?>
                        }
                    },
                    {
                        breakpoint: 992,
                        settings: {
                            arrows: false,
                            centerMode: true,
                            centerPadding: '0px',
                            slidesToShow: <?php if($autoshowroom_center_mode == 'true'){ echo esc_attr($autoshowroom_number_item_tablet_portrait_center);}else{echo esc_attr($autoshowroom_number_item_tablet_portrait);}?>
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            arrows: false,
                            centerMode: true,
                            centerPadding: '0px',
                            slidesToShow: <?php if($autoshowroom_center_mode == 'true'){ echo esc_attr($autoshowroom_number_item_tablet_portrait_center);}else{echo esc_attr($autoshowroom_number_item_tablet_portrait);}?>
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            arrows: false,
                            centerMode: true,
                            centerPadding: '0px',
                            slidesToShow: <?php if($autoshowroom_center_mode == 'true'){ echo esc_attr($autoshowroom_number_item_mobile_center);}else{echo esc_attr($autoshowroom_number_item_mobile_center);}?>
                        }
                    }
                ]
            });
        });

    });
</script><!--end script recent-project -->