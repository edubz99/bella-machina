<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Car_Dealer_Admin class.
 */
class Car_Dealer_Admin {

	/**
	 * __construct function.
	 *
	 * @access public
	 * @return void
	 */
	public function __construct() {

		// Enqueue CSS and JS in admin
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );

		// Use a custom walker for the ACF dropdowns
		add_filter( 'acf/fields/taxonomy/wp_list_categories', array( $this, 'acf_wp_list_categories' ), 10, 2 );

		// Adds a Make column to the Model admin columns
		add_filter( 'manage_edit-model_columns', array( $this, 'manage_edit_model_columns' ) );
		add_filter( 'manage_edit-make_columns', array( $this, 'manage_edit_make_columns' ) );
		add_filter( 'manage_model_custom_column', array( $this, 'manage_model_custom_column' ), 10, 3 );
		add_filter( 'manage_make_custom_column', array( $this, 'manage_make_custom_column' ), 10, 3 );
        add_action('admin_menu', array( $this, 'vehicle_quotes_menu' ));

        add_filter( 'manage_vehicle_posts_columns',array( $this,  'set_custom_edit_vehicle_columns' ));
        add_action( 'manage_vehicle_posts_custom_column' , array( $this, 'custom_vehicle_column'), 10, 2 );

        add_action('wp_ajax_tz_vehicle_quote_delete',array( $this, 'tz_vehicle_quote_delete' ));
        add_action('wp_ajax_nopriv_tz_vehicle_quote_delete',array( $this, 'tz_vehicle_quote_delete' ));

        add_action('wp_ajax_tz_vehicle_quote_status',array( $this, 'tz_vehicle_quote_status' ));
        add_action('wp_ajax_nopriv_tz_vehicle_quote_status',array( $this, 'tz_vehicle_quote_status' ));

		// Add helpful action links to the plugin list
		add_filter( 'plugin_action_links_'. CAR_DEALER_PLUGIN_BASENAME, array( $this, 'plugin_action_links' ) );

		// Sub-Plugin: Easily Add Custom Post Type Archives to the Nav Menus
		include( 'class-car-dealer-menu.php' );

	}
    public function set_custom_edit_vehicle_columns($columns) {
        $date = $columns['date'];
        unset( $columns['date'] );
        unset( $columns['comments'] );
        $columns['vehicle_author'] = __( 'Author', 'progression-car-dealer' );
        $columns['date'] = $date;
        return $columns;
    }
    public function custom_vehicle_column($columns, $post_ID ){
        if ($columns == 'vehicle_author') {
            global $post;
            $author_id = $post->post_author;
            $display_name = get_the_author_meta( 'display_name' , $author_id );
            echo $display_name;
        }
    }
    public function vehicle_quotes_menu() {
        add_submenu_page(
            'edit.php?post_type=vehicle',
            'Quotes',
            'Quotes',
            'manage_options',
            'vehicle-quotes',
            array($this,'vehicle_quotes_submenu_page_callback' ));
    }

    public function vehicle_quotes_submenu_page_callback() {
        global $wpdb;
        $quote_list = $wpdb->get_results("
            SELECT * FROM ".$wpdb->prefix."vehicle_quotes
        ");
	    ?>
        <div class="wrap vehicle-quote"><div id="icon-tools" class="icon32"></div>
        <h2><?php echo esc_html__('Quotes List','progression-car-dealer');?></h2>
            <table cellpadding="0">
                <tr>
                    <th><?php echo esc_html__('No','progression-car-dealer');?></th>
                    <th><?php echo esc_html__('Name','progression-car-dealer');?></th>
                    <th><?php echo esc_html__('Phone Number','progression-car-dealer');?></th>
                    <th><?php echo esc_html__('Email','progression-car-dealer');?></th>
                    <th><?php echo esc_html__('Car Info','progression-car-dealer');?></th>
                    <th><?php echo esc_html__('Message','progression-car-dealer');?></th>
                    <th><?php echo esc_html__('Status','progression-car-dealer');?></th>
                    <th><?php echo esc_html__('Delete','progression-car-dealer');?></th>
                </tr>
            <?php
            if($quote_list){ $d=1;
                foreach ($quote_list as $quote){
                    $quote_options = unserialize($quote->options);
                    $quote_car_values = unserialize($quote->car_values);
                    ?>
                    <tr>
                        <td><?php echo $d;?></td>
                        <td><?php echo $quote->name ;?></td>
                        <td>
                            <?php
                            if($quote_options['cus_phone']){
                                echo $quote_options['cus_phone'];
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            if($quote_options['cus_email']){
                                ?>
                                <a href="mailto:<?php echo $quote_options['cus_email'];?>">
                                    <?php echo $quote_options['cus_email']; ?>
                                </a>
                                <?php
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            if($quote_car_values['vehicle_make']){?>
                                <p><?php esc_html_e('Make: ','progression-car-dealer'); ?>
                                <?php
                                echo "<span>" .$quote_car_values['vehicle_make'] ."</span></p>";
                            }
                            ?>
                            <?php
                            if($quote_car_values['vehicle_model']){?>
                                <p><?php echo esc_html__('Model: ','progression-car-dealer'); ?>
                                <?php
                                echo "<span>" .$quote_car_values['vehicle_model'] ."</span></p>";
                            }
                            ?>
                            <?php
                            if($quote_car_values['vehicle_date']){?>
                                <p><?php echo esc_html__('Year: ','progression-car-dealer'); ?>
                                <?php
                                echo "<span>" .$quote_car_values['vehicle_date'] ."</span></p>";
                            }
                            ?>
                            <?php
                            if($quote_car_values['vehicle_mileage']){?>
                                <p><?php echo esc_html__('Mileage: ','progression-car-dealer'); ?>
                                <?php
                                echo "<span>" .$quote_car_values['vehicle_mileage'] ."</span></p>";
                            }
                            ?>
                        </td>
                        <td><?php echo esc_html($quote->message) ;?></td>
                        <td>
                            <select name="quote_status" class="quotes_status" data-id="<?php echo $quote->id;?>">
                                <option value="0" <?php if($quote->status =='0'){ echo "selected";}?>><?php echo esc_html__('unsolved','progression-car-dealer');?></option>
                                <option value="1" <?php if($quote->status =='1'){ echo "selected";}?> ><?php echo esc_html__('Solved','progression-car-dealer');?> </option>
                            </select>
                        </td>
                        <td><span  data-id="<?php echo $quote->id;?>" class="quote-delete dashicons dashicons-no-alt"></span></td>
                    </tr>
                    <?php $d++;

                }
            }
            ?>
            </table>
        </div>

    <?php
    }


public function tz_vehicle_quote_delete(){
    $quoteID = $_POST['quoteID'];
    global $wpdb;
    $wpdb->delete($wpdb->prefix."vehicle_quotes",array( 'id' => $quoteID));
    echo 'deleted';
    ?>
<?php
    exit();
}
public function tz_vehicle_quote_status(){
    $quoteID = $_POST['quoteID'];
    $status = $_POST['quotes_status'];
    global $wpdb;
    $wpdb->update($wpdb->prefix."vehicle_quotes",array( 'status' => $status),array('id'=>$quoteID));

    echo ' ';
    ?>
<?php
    exit();
}

	/**
	 * Enqueue CSS and JS in admin
	 *
	 * @access public
	 * @return void
	 */
	public function enqueue_admin_scripts() {

		wp_enqueue_style( 'car_dealer_admin_css', CAR_DEALER_PLUGIN_URL . '/assets/css/admin.css', false, CAR_DEALER_VERSION );
		wp_enqueue_script( 'car_dealer_admin_js', CAR_DEALER_PLUGIN_URL . '/assets/js/admin.js', array( 'jquery' ), CAR_DEALER_VERSION, true );
        $admin_url      = admin_url('admin-ajax.php');
        $vehicle_quoteajax_url   = array( 'url' => $admin_url);
        wp_localize_script('car_dealer_admin_js', 'vehicle_quote_ajax', $vehicle_quoteajax_url);
	}

	/**
	 * Use a custom walker for the ACF dropdowns
	 * @param  array $args 		The default dropdown arguments
	 * @param  array $field 	The Car Dealer field
	 * @return array 			Default dropdown args + custom walker
	 */
	public function acf_wp_list_categories( $args, $field ) {
		$args['walker'] = new car_dealer_acf_taxonomy_field_walker( $field );
		return $args;
	}

	/**
	 * Adds a Make column to the Model admin columns
	 * @param  array $columns 	Existing columns
	 * @return array 			Added the Make column
	 */
	public function manage_edit_model_columns( $columns ) {
		$columns['make'] = 'Make';
    	return $columns;
	}
	public function manage_edit_make_columns( $columns ) {
		$columns['vehicle_type'] = 'Vehicle type';
    	return $columns;
	}

	/**
	 * Displays the actual content of the Make column
	 * @param  string $content     	Default content of each cell
	 * @param  string $column_name 	Name of the current column
	 * @param  int $term_id     	The ID of the current term
	 * @return string               Show an admin edit link to the Make
	 */
	public function manage_model_custom_column( $content, $column_name, $term_id ){
		$make = get_field( 'make', 'model_'. $term_id );
        if(is_object($make)){
            if ( $make ) {
                $content .= sprintf( '<a href="%s" title="%s">%s</a>', admin_url( 'edit-tags.php?action=edit&taxonomy=vehicle_type&tag_ID='. $make->term_id .'&post_type=vehicle' ), __( 'Edit assoziated Make', 'progression-car-dealer' ), $make->name );
            } else {
                $content .= '–';
            }
        }else{
            if ( $make ) {
                $term = get_term( $make, 'make' );
                $content .= sprintf( '<a href="%s" title="%s">%s</a>', admin_url( 'edit-tags.php?action=edit&taxonomy=vehicle_type&tag_ID='. $make .'&post_type=vehicle' ), __( 'Edit assoziated Make', 'progression-car-dealer' ), $term->name );
            } else {
                $content .= '–';
            }
        }
	    return $content;
	}
	public function manage_make_custom_column( $content, $column_name, $term_id ){
		$vehicle_type = get_field( 'vehicle_type', 'make_'. $term_id );
		if(is_object($vehicle_type)){
	    if ( $vehicle_type ) {
	    	$content .= sprintf( '<a href="%s" title="%s">%s</a>', admin_url( 'edit-tags.php?action=edit&taxonomy=vehicle_type&tag_ID='. $vehicle_type->term_id .'&post_type=vehicle' ), __( 'Edit assoziated Make', 'progression-car-dealer' ), $vehicle_type->name );
	    } else {
	    	$content .= '–';
	    }
        }else{
            if ( $vehicle_type ) {
                $term = get_term( $vehicle_type, 'vehicle_type' );
                $content .= sprintf( '<a href="%s" title="%s">%s</a>', admin_url( 'edit-tags.php?action=edit&taxonomy=vehicle_type&tag_ID='. $vehicle_type .'&post_type=vehicle' ), __( 'Edit assoziated Make', 'progression-car-dealer' ), $term->name );
            } else {
                $content .= '–';
            }
        }


	    return $content;
	}

	/**
	 * Add helpful action links to the plugin list
	 * @param  array $links Excisting links
	 * @return array        Added link to plugin settings
	 */
	public function plugin_action_links( $links ) {
		$links[] = '<a href="' . admin_url( 'edit.php?post_type=vehicle&page=acf-options-settings' ) . '">' . __( 'Settings', 'progression-car-dealer' ) . '</a>';
		return $links;
	}
}

new Car_Dealer_Admin();


class car_dealer_acf_taxonomy_field_walker extends acf_taxonomy_field_walker
{
    // start_el
    function start_el( &$output, $term, $depth = 0, $args = array(), $current_object_id = 0)
    {
        // vars
        $selected = in_array( $term->term_id, $this->field['value'] );

        if( $this->field['field_type'] == 'checkbox' )
        {
            $output .= '<li><label class="selectit"><input type="checkbox" name="' . $this->field['name'] . '" value="' . $term->term_id . '" ' . ($selected ? 'checked="checked"' : '') . ' /> ' . $term->name . '</label>';
        }
        elseif( $this->field['field_type'] == 'radio' )
        {
            $output .= '<li><label class="selectit"><input type="radio" name="' . $this->field['name'] . '" value="' . $term->term_id . '" ' . ($selected ? 'checked="checkbox"' : '') . ' /> ' . $term->name . '</label>';
        }
        elseif( $this->field['field_type'] == 'select' )
        {
            if ( 'model' == $term->taxonomy ) {
                $make = get_field( 'make', $term );
                if(is_object($make)){
                    $make_attr = 'data-make="'. $make->name .'"';
                }else{
                    $make_term = get_term_by('id',$make,'make');
                    $make_attr ='data-make="'. $make_term->name .'"';
                }
            }
            $indent = str_repeat("&mdash;", $depth);
            $output .= '<option ' . $make_attr . ' value="' . $term->term_id . '" ' . ($selected ? 'selected="selected"' : '') . '>' . $indent . ' ' . $term->name . '</option>';
        }

    }
}