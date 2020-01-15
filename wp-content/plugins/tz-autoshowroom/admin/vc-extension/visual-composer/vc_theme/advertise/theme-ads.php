<?php
/*===============================
Shortocde tz-skill-item
===============================*/

function autoshowroom_ads($atts, $content=null) {
     $autoshowroom_type = $autoshowroom_title = $autoshowroom_bgcolor = $autoshowroom_style = $autoshowroom_height =
     $autoshowroom_image = $autoshowroom_img_size = $autoshowroom_img_alignment = $autoshowroom_css_animation = $autoshowroom_title_link = $autoshowroom_button_title = $autoshowroom_button_link ='';
    extract(shortcode_atts(array(
        'autoshowroom_type' => 'type1',
        'autoshowroom_style' => 'image-text',
        'autoshowroom_height' => '305',
        'autoshowroom_title' => '',
        'autoshowroom_title_link' => '',
        'autoshowroom_button_title' => 'Buy a motorcycles',
        'autoshowroom_button_link' => '#',
        'autoshowroom_bgcolor' => '',
        'autoshowroom_image' => '',
        'autoshowroom_img_size' => 'thumbnail',
        'autoshowroom_img_alignment' => 'left',
        'autoshowroom_css_animation' => '',
    ),$atts));
    ob_start();
    $autoshowroom_class = '';
    if($autoshowroom_style != ''){
        $autoshowroom_class .= 'autoshowroom-ads-'.$autoshowroom_style;
    }

    $autoshowroom_image_url = wp_get_attachment_url($autoshowroom_image);
    $autoshowroom_width_img ='';
    $autoshowroom_height_img ='';
    $autoshowroom_images_info = wp_get_attachment_image_src($autoshowroom_image, $size=$autoshowroom_img_size);

    if(isset($autoshowroom_images_info) && !empty($autoshowroom_images_info)){
        $autoshowroom_width_img = $autoshowroom_images_info[1];
        $autoshowroom_height_img = $autoshowroom_images_info[2];
    }

    $autoshowroom_image_animation = '';
    if($autoshowroom_css_animation != ''){
        wp_enqueue_script( 'waypoints' );
        $autoshowroom_image_animation .= ' wpb_animate_when_almost_visible wpb_' . $autoshowroom_css_animation;
    }

    $autoshowroom_align_class = '';
    if($autoshowroom_img_alignment != ''){
        $autoshowroom_align_class = ' autoshowroom-ads-align-'.$autoshowroom_img_alignment;
    }
    ?>
    <div class="autoshowroom-ads autoshowroom-ads-<?php echo esc_html($autoshowroom_type); ?> <?php echo esc_attr($autoshowroom_class);?>" <?php
    if($autoshowroom_height != ''){
        echo 'style="height:'.$autoshowroom_height.'px"';
    }
    ?>>
        <div class="autoshowroom-ads-image<?php echo esc_attr($autoshowroom_align_class);?>">
            <img class="<?php echo esc_attr($autoshowroom_image_animation);?>" width ="<?php echo esc_attr($autoshowroom_width_img);?>" height ="<?php echo esc_attr($autoshowroom_height_img);?>" src="<?php echo esc_url($autoshowroom_image_url);?>" alt="<?php echo esc_attr($autoshowroom_title);?>"/>
        </div>
        <div class="autoshowroom-ads-bg" <?php
        if($autoshowroom_bgcolor != ''){
            echo 'style="background:'.$autoshowroom_bgcolor.';"';
        }
        ?>></div>
        <div class="autoshowroom-ads-text">
            <div class="autoshowroom-ads-text-box">
                <?php if($autoshowroom_title_link==""){ ?>
                    <h4 class="autoshowrrom-ads-title">
                        <?php echo esc_html($autoshowroom_title);?>
                    </h4>
                <?php } else{ ?>
                    <h4 class="autoshowrrom-ads-title">
                        <a href="<?php echo esc_html($autoshowroom_title_link);?>"><?php echo esc_html($autoshowroom_title);?></a>
                    </h4>
                <?php } ?>

                <p class="autoshowroom-ads-description">
                    <?php echo balanceTags($content);?>
                </p>
                <?php if($autoshowroom_type == 'type2'){ ?>
                    <div class="autoshowroom-button">
                        <a href="<?php echo esc_url($autoshowroom_button_link); ?>"><?php echo esc_html($autoshowroom_button_title); ?></a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php

    return ob_get_clean();
}
add_shortcode('autoshowroom-ads','autoshowroom_ads');
?>
