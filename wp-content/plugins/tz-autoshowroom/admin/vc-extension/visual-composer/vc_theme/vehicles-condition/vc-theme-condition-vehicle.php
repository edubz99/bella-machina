<?php
    vc_map( array(
        'name'      =>  'Condition Vehicle',
        'base'      =>  'autoshowroom-condition-vehicle',
        'icon'      =>  'tzvc_icon',
        'weight'    => 1,
        'category'  =>  'TZ AutoShowroom',
        'params'    =>  array(
            array(
                'type'          =>  'dropdown',
                'holder'        =>  '',
                'admin_label'   =>  false,
                'heading'       =>  esc_html__('Vehicle Title','tz-autoshowroom'),
                'param_name'    =>  'autoshowroom_vehicle_title',
                'value'         =>  array(
                    'Show'          =>  'show',
                    'Hide'          =>  'hide'
                )
            ),
            array(
                'type'          =>  'dropdown',
                'holder'        =>  '',
                'admin_label'   =>  false,
                'heading'       =>  esc_html__('Condition','tz-autoshowroom'),
                'param_name'    =>  'autoshowroom_vehicle_condition',
                'value'         =>  array(
                    'New'                           =>  'new',
                    'Used'                          =>  'used',
                    'Certified Pre-Owned'           =>  'preowned'
                )
            ),
            array(
                'type'          =>  'dropdown',
                'holder'        =>  '',
                'admin_label'   =>  false,
                'heading'       =>  esc_html__('Vehicle Description','tz-autoshowroom'),
                'param_name'    =>  'autoshowroom_vehicle_description',
                'value'         =>  array(
                    'Show'          =>  'show',
                    'Hide'          =>  'hide'
                ),
            ),
            array(
                'type'          =>  'textfield',
                'holder'        =>  '',
                'heading'       =>  esc_html__('Limit Description','tz-autoshowroom'),
                'admin_label'   =>  false,
                'param_name'    =>  'autoshowroom_vehicle_description_limit',
                'value'         =>  80,
            ),
            array(
                'type'          =>  'dropdown',
                'holder'        =>  '',
                'admin_label'   =>  false,
                'heading'       =>  esc_html__('Vehicle Specifications','tz-autoshowroom'),
                'param_name'    =>  'autoshowroom_vehicle_specifications',
                'value'         =>  array(
                    'Show'          =>  'show',
                    'Hide'          =>  'hide'
                ),
            ),
            array(
                'type'          =>  'checkbox',
                'holder'        =>  '',
                'admin_label'   =>  false,
                'heading'       =>  esc_html__('Choose Specifications','tz-autoshowroom'),
                "dependency"    => Array('element' => "autoshowroom_vehicle_specifications", 'value' => 'show'),
                'param_name'    =>  'autoshowroom_specifications_values',
                'value'         =>  autoshowroom_get_fields()
            ),
            array(
                "type"       => "textfield",
                "class" => "",
                "admin_label" => true,
                "heading"    => esc_html__("Image Size", "tz-autoshowroom"),
                "param_name" => "tz_size",
                "description"   => esc_html__("Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use \"large\" size.", "aventura-plugin"),
                "value" => "",
            ),
            array(
                'type'          =>  'dropdown',
                'holder'        =>  '',
                'admin_label'   =>  false,
                'group'         =>  esc_html__('Slider Option','tz-autoshowroom'),
                'heading'       =>  esc_html__('Slider Layout','tz-autoshowroom'),
                'param_name'    =>  'autoshowroom_vehicle_carousel_layout',
                'value'         =>  array(
                    'In Grid'          =>  'grid',
                    'Full With'        =>  'full'
                )
            ),
            array(
                'type'          =>  'dropdown',
                'holder'        =>  '',
                'admin_label'   =>  false,
                'group'         =>  esc_html__('Slider Option','tz-autoshowroom'),
                'heading'       =>  esc_html__('Center','tz-autoshowroom'),
                'param_name'    =>  'autoshowroom_vehicle_carousel_center',
                'value'         =>  array(
                    'Show'           =>  'true',
                    'Hide'          =>  'false',
                )
            ),
            array(
                'type'          =>  'textfield',
                'holder'        =>  '',
                'group'         =>  esc_html__('Slider Option','tz-autoshowroom'),
                'heading'       =>  esc_html__('Number items','tz-autoshowroom'),
                'admin_label'   =>  false,
                'param_name'    =>  'autoshowroom_vehicle_carousel_number',
                'value'         =>  5
            ),
            array(
                'type'          =>  'textfield',
                'holder'        =>  '',
                'group'         =>  esc_html__('Slider Option','tz-autoshowroom'),
                'heading'       =>  esc_html__('Margin items','tz-autoshowroom'),
                'admin_label'   =>  false,
                'param_name'    =>  'autoshowroom_vehicle_carousel_margin',
                'value'         =>  30
            ),
            array(
                'type'          =>  'dropdown',
                'holder'        =>  '',
                'group'         =>  esc_html__('Slider Option','tz-autoshowroom'),
                'admin_label'   =>  false,
                'heading'       =>  esc_html__('Next/Preview','tz-autoshowroom'),
                'param_name'    =>  'autoshowroom_vehicle_carousel_button',
                'value'         =>  array(
                    'Show'          =>  'true',
                    'Hide'          =>  'false'
                )
            ),
            array(
                'type'          =>  'dropdown',
                'holder'        =>  '',
                'admin_label'   =>  false,
                'group'         =>  esc_html__('Slider Option','tz-autoshowroom'),
                'heading'       =>  esc_html__('Dots','tz-autoshowroom'),
                'param_name'    =>  'autoshowroom_vehicle_carousel_dots',
                'value'         =>  array(
                    'Hide'           =>  'false',
                    'Show'           =>  'true'
                )
            ),
            array(
                'type'          =>  'dropdown',
                'holder'        =>  '',
                'group'         =>  esc_html__('Slider Option','tz-autoshowroom'),
                'admin_label'   =>  false,
                'heading'       =>  esc_html__('Loop','tz-autoshowroom'),
                'param_name'    =>  'autoshowroom_vehicle_carousel_loop',
                'value'         =>  array(
                    'Yes'          =>  'true',
                    'No'           =>  'false'
                )
            ),
            array(
                'type'          =>  'dropdown',
                'holder'        =>  '',
                'group'         =>  esc_html__('Slider Option','tz-autoshowroom'),
                'admin_label'   =>  false,
                'heading'       =>  esc_html__('AutoPlay','tz-autoshowroom'),
                'param_name'    =>  'autoshowroom_vehicle_carousel_autoplay',
                'value'         =>  array(
                    'Yes'          =>  'true',
                    'No'           =>  'false'
                )
            ),
            array(
                'type'        => 'textfield',
                'param_name'  => 'el_class',
                'heading'     => esc_html__( 'Extra class name', 'tz-autoshowroom' ),
            ),

        )
    ) );
?>