<?php
vc_map( array(
    "name"          => __("Sign Up", "js_composer"),
    "weight"        => 1,
    "base"          => "autoshowroom-sign-up",
    'icon'          =>  'tzvc_icon',
    "class"         => "tzElement_extended",
    "description"   => "",
    "category"      => __("TZ AutoShowroom", "js_composer"),
    "params"        => array(
        array(
            "type"          => "textfield",
            "holder"        => "div",
            "class"         => "",
            "admin_label"   => true,
            "heading"       => __("Title", "js_composer"),
            "param_name"    => "autoshowroom_title",
            "description"   => "Define a title for the section",
            "value"         => "",
            "group"         => "General",
        ),

        array(
            "type"          => "textfield",
            "holder"        => "div",
            "class"         => "",
            "admin_label"   => true,
            "heading"       => __("Subtitle", "js_composer"),
            "param_name"    => "autoshowroom_sub_title",
            "description"   => "Define a subtitle for the section",
            "value"         => "",
            "group"         => "General",
        ),
        array(
            "type"          => "attach_image",
            "class"         => "",
            "admin_label"   => true,
            "heading"       => __("Sign Up Image", "js_composer"),
            "param_name"    => "autoshowroom_image",
            "description"   => __("", "js_composer"),
            "group"         => "Image Option",
        ),
        array(
            "type"          => "textfield",
            "holder"        => "div",
            "class"         => "",
            "admin_label"   => true,
            "heading"       => __("Position-right", "js_composer"),
            "param_name"    => "autoshowroom_position_x",
            "description"   => "(px)",
            "value"         => "",
            "group"         => "Image Option",
        ),
        array(
            "type"          => "textfield",
            "holder"        => "div",
            "class"         => "",
            "admin_label"   => true,
            "heading"       => __("Position-top", "js_composer"),
            "param_name"    => "autoshowroom_position_y",
            "description"   => "(px)",
            "value"         => "",
            "group"         => "Image Option",
        ),
        array(
            "type"          => "dropdown",
            "class"         => "",
            "admin_label"   => true,
            "heading"       => __("Css Animation", "js_composer"),
            "param_name"    => "autoshowroom_image_animation",
            "description"   => __("Animation of Image", "js_composer"),
            "value"         => array(
                __("No animation", "js_composer")           => '',
                __("Top to bottom", "js_composer")          => 'top-to-bottom',
                __("Bottom to top", "js_composer")          => 'bottom-to-top',
                __("Left to right", "js_composer")          => 'left-to-right',
                __("Right to left", "js_composer")          => 'right-to-left',
                __("Appear from center", "js_composer")     => 'appear'),
            "group"         => "Image Option",
        ),
        array(
            "type"          => "dropdown",
            "class"         => "",
            "admin_label"   => true,
            "heading"       => __("Css Animation", "js_composer"),
            "param_name"    => "autoshowroom_tz_css_animation",
            "description"   => __("Animation of Element", "js_composer"),
            "value"         => array(
                __("No animation", "js_composer")           => '',
                __("Top to bottom", "js_composer")          => 'top-to-bottom',
                __("Bottom to top", "js_composer")          => 'bottom-to-top',
                __("Left to right", "js_composer")          => 'left-to-right',
                __("Right to left", "js_composer")          => 'right-to-left',
                __("Appear from center", "js_composer")     => 'appear'),
            "group"         => "General",
        ),
    )
));
?>