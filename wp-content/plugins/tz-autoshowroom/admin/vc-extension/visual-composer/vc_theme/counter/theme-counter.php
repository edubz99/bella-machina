<?php
/*
 * Element tz-counter
 * */

function autoshowroom_counter($atts) {
    $autoshowroom_counter_style = $autoshowroom_icon = $autoshowroom_count_number=$autoshowroom_count = $autoshowroom_title = $autoshowroom_css_animation = '';
    extract(shortcode_atts(array(
        'autoshowroom_counter_style' => 'style1',
        'autoshowroom_icon' => 'fa fa-adjust',
        'autoshowroom_count' => '',
        'autoshowroom_count_number' => '1',
        'autoshowroom_title' => '',
        'autoshowroom_css_animation' => '',
    ),$atts));
    ob_start();

    wp_enqueue_script('autoshowroom-counter');

    $autoshowroom_counter_class = '';

    if($autoshowroom_css_animation != ''){
        wp_enqueue_script( 'waypoints' );
        $autoshowroom_counter_class .= ' wpb_animate_when_almost_visible wpb_' . $autoshowroom_css_animation;
    }
    ?>
    <?php if($autoshowroom_counter_style == 'style1'){ ?>
        <div data-number ="<?php echo $autoshowroom_count_number;?>" class="autoshowroom-counter autoshowroom-counter-<?php echo esc_attr($autoshowroom_counter_class);?>">
            <div class="autoshowroom-counter-box">
                <?php
                if($autoshowroom_icon != ''){
                    ?>
                    <div class="autoshowroom-counter-icon">
                        <i class="fa <?php echo esc_attr($autoshowroom_icon);?>"></i>
                    </div>
                    <?php
                }
                ?>

                <span class="autoshowroom-counter-number stat-count"><?php echo esc_html($autoshowroom_count);?></span>

            </div>
            <h3 class="autoshowroom-counter-title"><?php echo esc_html($autoshowroom_title);?></h3>
        </div>
    <?php }elseif ($autoshowroom_counter_style == 'style2') { ?>
        <div  data-number ="<?php echo $autoshowroom_count_number;?>"  class="autoshowroom-counter autoshowroom-counter-<?php echo esc_html($autoshowroom_counter_style); echo esc_attr($autoshowroom_counter_class);?>">
            <?php
            if($autoshowroom_icon != ''){
                ?>
                <div class="autoshowroom-counter-icon">
                    <i class="fa <?php echo esc_attr($autoshowroom_icon);?>"></i>
                </div>
                <?php
            }
            ?>
            <div class="autoshowroom-counter-content">
                <span class="autoshowroom-counter-number stat-count"><?php echo esc_html($autoshowroom_count);?></span>
                <h3 class="autoshowroom-counter-title"><?php echo esc_html($autoshowroom_title);?></h3>
            </div>
        </div>
        <?php
    }
    ?>

<?php
    return ob_get_clean();
}
add_shortcode('autoshowroom-counter','autoshowroom_counter');
?>