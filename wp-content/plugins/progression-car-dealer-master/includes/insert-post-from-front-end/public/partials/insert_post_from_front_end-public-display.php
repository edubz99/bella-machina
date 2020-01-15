<?php
$show_condition='show';
?>
<div class="container">
    <form method="post" action="" name="insert_vehicle" id="insert_vehicle" enctype="multipart/form-data">
        <?php wp_nonce_field('inser_post_from_front', 'verify_insert_post'); ?>
        <div class="form-group">
            <label for="title"><?php echo esc_html__('Title:','progression-car-dealer') ?></label>
            <input type="text" class="form-control" id="title" placeholder="Enter title" name="title">
        </div>
        <div class="excerpt">
            <textarea name="car_excerpt" rows="5" placeholder="Excerpt"></textarea>
        </div>
        <div class="form-group special-group">
              <label for="title"><?php echo esc_html__('Description:','progression-car-dealer') ?></label>
            <?php
            $content = '';
            $editor_id = 'mycustomeditor';
            $settings = array( 'media_buttons' => false );
            wp_editor($content, $editor_id,$settings);
            ?>
        </div>
        <div class="row group-input">
            <div class="vehicle-info col-md-3">
                <label><?php echo esc_html__('Vehicle Type','progression-car-dealer') ?></label>
                <?php
                $taxonomies = 'vehicle_type';
                $vehicle_makes = get_terms( $taxonomies,array('hide_empty' => false) );
                if($vehicle_makes ){
                    ?>
                    <select name="vehicle_type" class="submit-vehicle-type" required>
                        <option value=""><?php echo esc_html__('None','progression-car-dealer') ?></option>
                        <?php
                        foreach ($vehicle_makes as $cat){
                            ?>
                            <option data-type="<?php echo esc_attr($cat->slug);?>" value="<?php echo esc_attr($cat->slug);?>"><?php echo esc_attr($cat->name); ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <?php
                }
                ?>
            </div>

            <div class="vehicle-info col-md-3">
                <label><?php echo esc_html__('Make','progression-car-dealer') ?></label>
                <?php
                $taxonomies = 'make';
                $vehicle_makes = get_terms( $taxonomies,array('hide_empty' => false)  );
                if($vehicle_makes ){
                    ?>
                    <select name="make" class="submit-vehicle-make" required>
                        <option value=""><?php echo esc_html__('None','progression-car-dealer') ?></option>
                        <?php
                        foreach ($vehicle_makes as $make){
                            $id = $make->term_id;
                            $type_vehicle = get_field( 'vehicle_type', 'make_'. $id );
                            $car_type='';
                            if($type_vehicle){
                                if(is_object($type_vehicle)){
                                    $car_type = $type_vehicle->slug;
                                }else{
                                    $term = get_term( $type_vehicle, 'vehicle_type' );
                                    $car_type =$term->slug;
                                }
                            }
                            ?>
                            <option data-type ="<?php echo esc_attr($car_type);?>" data-make="<?php echo esc_attr($make->slug);?>" value="<?php echo esc_attr($make->slug);?>"><?php echo esc_attr($make->name); ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <?php
                }
                ?>
            </div>
            <div class="vehicle-info col-md-3">
                <label><?php echo esc_html__('Model','progression-car-dealer') ?></label>
                <?php
                $taxonomies = 'model';
                $vehicle_makes = get_terms( $taxonomies,array('hide_empty' => false)  );
                if($vehicle_makes ){
                    ?>
                    <select name="model" class="submit-vehicle-model" required>
                        <option value=""><?php echo esc_html__('None','progression-car-dealer') ?></option>
                        <?php
                        foreach ($vehicle_makes as $cat){
                            $id = $cat->term_id;
                            $make_vehicle = get_field( 'make', 'model_'. $id );
                            $car_type='';
                            if($make_vehicle){
                                if(is_object($make_vehicle)){
                                    $car_type = $make_vehicle->slug;
                                }else{
                                    $term = get_term( $make_vehicle, 'make' );
                                    $car_type =$term->slug;
                                }
                            }
                            ?>
                            <option data-make="<?php echo esc_attr($car_type);?>" value="<?php echo esc_attr($cat->slug);?>"><?php echo esc_attr($cat->name); ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <?php
                }
                ?>
            </div>
            <div class="vehicle-info vehicle-price col-md-3">

                <label><?php echo esc_html__('Price','progression-car-dealer');?></label>
                <input type="number" placeholder="Example: 50000" name="vehicle_price"/>

            </div>
        </div>

        <div class="vehicle-spec">
            <div class="vehicle-info vehicle-price">
                <label><?php echo esc_html__('Price text','progression-car-dealer');?></label>
                <input type="text" placeholder="Example: Contact" name="vehicle_price_text"/>
            </div>
            <?php
            global $car_dealer;
            if ( is_plugin_active( 'progression-car-dealer-master/progression-car-dealer.php' ) ) {
                $fields = $car_dealer->fields->get_registered_fields('specs');
                arsort($fields);
                foreach ( $fields as $k => $field ) {
                    $label =  $field['label'];
                    $name  = $field['name'];
                    $fieldtype = $field['type'];

                    if ( 'number' === $fieldtype ) {

                        $field_html = '';

                        $step 			= str_replace(',', '.', $field['step']);
                        $query_var 		= get_query_var( $field['name'] );

                        $field_html .= '<p class="field field-'. $field['name'] .' fieldtype-'. $fieldtype .'"><label title="'. $field['instructions'] .'"><b>'. $field['label'] .': </b><br></label>';

                        if ( $field['prepend'] ) {
                            $field_html .= '<span class="pcd-unit_prepend"> '. $field['prepend'] . ' </span>';
                        }

                        $field_html .= '<input name="'. $field['name'] .'" type="number"/> ';

                        if ( $field['append'] ) {
                            $field_html .= '<span class="pcd-unit_append"> '. $field['append'] . ' </span>';
                        }
                        $field_html .= '</p>';
                        echo $field_html;

                    }
                    if ( 'radio' === $fieldtype || 'checkbox' === $fieldtype ) {

                        $field_html = '';

                        $field_html .= '<p class="field field-'. $field['name'] .' fieldtype-'. $fieldtype .'"><label title="'. $field['instructions'] .'"><b>'. $field['label'] .': </b></label><br>';
                        $d=1;
                        foreach ( $field['choices'] as $choice_value => $choice_label ) {
                            if($d==1) {
                                $field_html .= '<label class="choice choice-' . $choice_value . '">                            
					            <input type="radio" name="' . $field['name'] . '" value="' . $choice_value . '" required><label class="input-style"></label><span class="check"></span> ' . $choice_label . ' </label><br>';
                            }else{
                                $field_html .= '<label class="choice choice-' . $choice_value . '">                            
					            <input type="radio" name="' . $field['name'] . '" value="' . $choice_value . '"><label class="input-style"></label><span class="check"></span> ' . $choice_label . ' </label><br>';
                            }
                            $d++;
                        }
                        $field_html .= '</p>';
                    echo $field_html;

                    }

                }
            }
            ?>
            <div class="clearfix"></div>
        </div>

        <div class="row features-bottom">
            <div class="vehicle-feature col-md-4">
                <label for="file"><?php echo esc_html__('Featured Image:','progression-car-dealer') ?></label>
                <input id="uploadFile" placeholder="<?php echo esc_html__('No file choosen','progression-car-dealer') ?>" disabled="disabled" />
                <div class="fileUpload">
                    <span><?php echo esc_html__('Choose file','progression-car-dealer') ?></span>
                    <input id="uploadBtn" type="file" class="required" id="featuredimage" name="feature_image" accept="image/*">
                </div>
                </label>
            </div>
            <div class="form-group col-md-4">
                <label for="file"><?php echo esc_html__('Car Brochure','progression-car-dealer') ?></label>
                <input id="uploadFile" placeholder="<?php echo esc_html__('No file choosen','progression-car-dealer') ?>" disabled="disabled" />
                <div class="fileUpload">
                    <span><?php echo esc_html__('Choose file','progression-car-dealer') ?></span>
                    <input id="uploadBtn" type="file" class="form-control" id="brochure" name="brochure">
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="file"><?php echo esc_html__('Gallery','progression-car-dealer') ?></label>
                <input id="uploadFile" placeholder="<?php echo esc_html__('No file choosen','progression-car-dealer') ?>" disabled="disabled" />
                <div class="fileUpload">
                    <span><?php echo esc_html__('Choose file','progression-car-dealer') ?></span>
                    <input id="uploadFile" type="file" id="gallery" name="gallery[]" accept="image/*" multiple>
                </div>
            </div>

        </div>

        <button type="submit" class="btn btn-default" id="submitpost" ><?php echo esc_html__('Submit','progression-car-dealer') ?></button>
    </form>
</div>
<script>
    document.getElementById("uploadBtn").onchange = function () {
        document.getElementById("uploadFile").value = this.value;
    };
</script>