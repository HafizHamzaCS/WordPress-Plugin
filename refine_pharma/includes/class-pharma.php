<?php

/**
 * The file that defines the core plugin class
 *
 */
class Pharma {

	public function __construct() {

	add_filter('woocommerce_locate_template', array( $this,'refine_pharma_register'));
	add_filter('woocommerce_locate_template', array( $this,'refine_pharma_localization'));
	add_action("wp_ajax_nopriv_patient_form_data", array($this,'patient_form_data'));
	add_action("wp_ajax_patient_form_data",        array($this,'patient_form_data'));
	register_activation_hook(__FILE__, array( $this,'refine_patient_table'));
	// Disables the block editor from managing widgets in the Gutenberg plugin.
	add_filter( 'gutenberg_use_widgets_block_editor', '__return_false' );
	// Disables the block editor from managing widgets.
	add_filter( 'use_widgets_block_editor', '__return_false' );

	$this->load_dependencies();
		
	}

	public function load_dependencies() {
	
	if ( is_admin() ) {
	    // we are in admin mode
	    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-pharma-admin.php';
	}	
    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-pharma-public.php';
	//=============refine pharma registration form ==================================
    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/registration_form.php';
    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/admin_menu.php';
	}
	//=================================================================
	//=============  template overriding   ==========================
	//===============================================================
	function refine_pharma_register($template){
	    $basename = basename($template);
	    if ($basename == 'form-login.php') {
	        $template = trailingslashit(plugin_dir_path(dirname(__FILE__))) . 'includes/form-login.php';
	    }
	    return $template;
	}
	//==========================================================
	//================template overriding  =================
	//==========================================================
	function refine_pharma_localization($template){
	    $basename = basename($template);
	    if ($basename == 'proceed-to-checkout-button.php') {
	        $template = trailingslashit(plugin_dir_path(dirname(__FILE__))) . 'includes/proceed-to-checkout-button.php';
	    }
	    return $template;
	}
	//=====================================================================
	//============= redirect user to home page after submit the form ======
	//=====================================================================
	// add_filter('user_register', 'register_redirect');
	// //add_filter('wp_login', 'login_redirect');
	// function register_redirect($redirect_to) {
	//     wp_redirect( home_url() );
	//     exit();
	// }
	//===============================================================================
	//=============custom table for patinet form ====================================
	//===============================================================================
	function refine_patient_table(){
	    global $wpdb;
	    $charset_collate = $wpdb->get_charset_collate();
	    $sql = "create table IF NOT EXISTS {$wpdb->prefix}patient_detail(
	            id int NOT NULL AUTO_INCREMENT,
	            patient_name varchar(25),
	            patient_dob varchar(25),
	            patient_address1 varchar(50),
	            patient_address2 varchar(50),
	            patient_city varchar(25),
	            patient_country varchar(25),
	            patient_postcode varchar(25),
	            created_by bigint,
	            PRIMARY KEY  (id)
	            ) $charset_collate;";
	    $wpdb->query($sql);
	}
	//===============================================================================
	//============= patient form submit with ajax call     ==========================
	//===============================================================================

	function patient_form_data(){
	    global $wpdb;
	    $table = 'wp_patient_detail';
	    print_r($_POST['patient_data']);
	    $insert_query =  $wpdb->insert($table, $_POST['patient_data']);
	    wp_send_json($insert_query);
	    exit();
	}
	// //=====================================================================
	// //============= redirect user to home page after submit the form ======
	// //=====================================================================
	// // add_filter('user_register', 'register_redirect');
	// // //add_filter('wp_login', 'login_redirect');
	// // function register_redirect($redirect_to) {
	// //     wp_redirect( home_url() );
	// //     exit();
	// // }

}

$pharma = new Pharma(); 

	