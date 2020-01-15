<?php

vc_map( array(
    "name" => __("Counter", "js_composer"),
    "weight" => 14,
    "base" => "autoshowroom-counter",
    "icon" => "tzvc_icon",
    "description" => "",
    "class" => "autoshowroom_counter",
    "category" => __("TZ AutoShowroom", "js_composer"),
    "params" => array(
        array(
            'type'          =>  'dropdown',
            'admin_label'   =>  true,
            'heading'       =>  esc_html__('Counter Style','tz-autoshowroom'),
            'param_name'    =>  'autoshowroom_counter_style',
            'value'         =>  array(
                'Style 1'        =>  'style1',
                'Style 2'        =>  'style2'
            )
        ),
        array(
            'type' => 'iconpicker',
            'heading' => __( 'Icon', 'tz-autoshowroom' ),
            "class"         => "",
            "admin_label"   => true,
            'param_name' => 'autoshowroom_icon',
            'value' => 'fa fa-adjust', // default value to backend editor admin_label
            'settings' => array(
                'emptyIcon' => false,
                // default true, display an "EMPTY" icon?
                'iconsPerPage' => 4000,
                // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
            ),
            'description' => __( 'Select icon from library.', 'tz-autoshowroom' ),
        ),
        array(
            "type"       => "textfield",
            "class"         => "",
            "admin_label" => true,
            "heading"    => __("Count", "js_composer"),
            "param_name" => "autoshowroom_count",
            "value" => "",
        ),
        array(
            "type"       => "textfield",
            "class"         => "",
            "admin_label" => true,
            "heading"    => __("Step Count ", "js_composer"),
            "param_name" => "autoshowroom_count_number",
            "value" => "1",
        ),
        array(
            "type" => "textfield",
            "class" => "",
            "admin_label" => true,
            "heading"    => __("Title", "js_composer"),
            "param_name" => "autoshowroom_title",
            "value" => "",
        ),
        array(
            "type" => "dropdown",
            "class" => "",
            "admin_label" => true,
            "heading"       => __("Css Animation", "js_composer"),
            "param_name"    => "autoshowroom_css_animation",
            "description"   => __("", "js_composer"),
            "value"         => array(
                __("No animation", "js_composer")           => '',
                __("Top to bottom", "js_composer")          => 'top-to-bottom',
                __("Bottom to top", "js_composer")          => 'bottom-to-top',
                __("Left to right", "js_composer")          => 'left-to-right',
                __("Right to left", "js_composer")          => 'right-to-left',
                __("Appear from center", "js_composer")     => 'appear'),
        ),
    )
) );

?>