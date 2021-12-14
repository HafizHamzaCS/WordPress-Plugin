<?php 

class Pharma_Admin{
	// class instance
	static $instance;

	// customer WP_List_Table object
	public $customers_obj;

	// class constructor

	public function __construct(){

        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_style' ));
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_script' ));
		add_action('init', array($this,'refine_custom_post_type'));

		add_action( 'wp_ajax_nopriv_refine_form_function', array( $this,'refine_form_function' ));
		add_action( 'wp_ajax_refine_form_function', array($this,'refine_form_function' ));
		
		add_action('admin_init', array( $this,'refine_add_user_roles'));
		add_filter( 'user_contactmethods', array( $this,'refine_active_methods'));
		add_filter( 'manage_users_columns', array( $this,'refine_modify_user_table' ));
		add_action('admin_menu',array( $this,'max_register_menu_page'));
		add_action('admin_menu',array( $this,'max_hj_default_menu_page'));
    	add_action('wp_ajax_deleteUserAjax', array( $this,'deleteUserAjax'));
		add_action('wp_head', array( $this,'myplugin_ajaxurl'));

    }

	public function enqueue_admin_style(){

        wp_enqueue_style('max-admin-css', plugin_dir_url( __FILE__ ) . 'css/pharm-admin.css');
        wp_enqueue_style('max-admin-datatable-css', plugin_dir_url( __FILE__ ) . 'css/jquery.dataTables.css');
	}
	public function enqueue_admin_script(){

        wp_enqueue_script('max-admin-js', plugin_dir_url( __FILE__ ) . 'js/pharm-admin.js',array('jquery'));
        wp_enqueue_script('max-admin-datatable-js', plugin_dir_url( __FILE__ ) . 'js/jquery.dataTables.js');
	}
	//========================================================
	//=================adding custompost type=================
	//========================================================
	public function refine_custom_post_type() {
	    register_post_type('price',
	        array(
	            'labels'        => array(
	            'name'          => __( 'Prescription', 'textdomain' ),
	            'singular_name' => __( 'prescription', 'textdomain' ),
	            ),
	            'public'      => true,
	            'has_archive' => true,
	            'rewrite'     => array( 'slug' => 'products' ), // my custom slug
	            'menu_icon'   => 'dashicons-arrow-right-alt',
	        )
	    );
	}
	//==============================================================
	//============= refine pharma form submit data =================
	//==============================================================
	public function refine_form_function() {
	    $data = $_POST['data'];
	    $meta = $_POST['meta'];
	    $user_id = wp_insert_user($data);
	    $images = [];
	    $x = 1;
	    $images['industry_certificate'] = $_FILES['industry_certificate'];
	    $images['utility_bill'] = $_FILES['utility_bill'];
	    $images['photo_id'] = $_FILES['photo_id'];
	    $images['insurance'] = $_FILES['insurance'];
	    $images['treatment'] = $_FILES['treatment'];
	    foreach ($images as $key => $image) {
	        $file_name = $image['name'];
	        $file_temp = $image['tmp_name'];
	        $upload_dir = wp_upload_dir();
	        $image_data = file_get_contents($file_temp);
	        $filename = basename($file_name);
	        $filetype = wp_check_filetype($file_name);
	        $filename = time() . '.' . $filetype['ext'];
	        if (wp_mkdir_p($upload_dir['path'])) {
	            $file = $upload_dir['path'] . '/' . $filename;
	        } else {
	            $file = $upload_dir['basedir'] . '/' . $filename;
	        }
	        file_put_contents($file, $image_data);
	        $wp_filetype = wp_check_filetype($filename, null);
	        $attachment = array(
	            'post_mime_type' => $wp_filetype['type'],
	            'post_title' => sanitize_file_name($filename),
	            'post_content' => '',
	            'post_status' => 'inherit'
	        );
	        $attach_id = wp_insert_attachment($attachment, $file);
	        require_once(ABSPATH . 'wp-admin/includes/image.php');
	        $attach_data = wp_generate_attachment_metadata($attach_id, $file);
	        wp_update_attachment_metadata($attach_id, $attach_data);
	        $meta[$key] = $attach_id;
	    }
	    // $attachment = json_encode($attachments);
	    if (is_wp_error($user_id)) {
	        echo $user_id->get_error_message();
	    } else {
	        foreach ($meta as $key => $value)
	         {
	            update_user_meta($user_id, $key, $value);
	        }
	        
	    }
	    exit();

	}
	//==================================================================
	//=====================Start Add user role and capability===========
	//==================================================================

	function refine_add_user_roles(){
	    add_role('prescriber', 'Prescriber');
	    add_role(
	        'non_medical_professional',
	        'Non-Medical Professional',
	        array(
	            //'read' => TRUE,
	        )
	    );
	    add_role(
	        'medical_professional',
	        'Medical Professional',
	        array(
	            //'read' => TRUE,
	        )
	    );
	     //remove_role( 'super_admin' );
	    // remove_role( 'non_medical_user' );
	    add_role(
	        'super-admin',
	        'Super-Admin',
	        array(
	            'activate_plugins'      =>true,
	            'customize'             =>true,
	            'delete_others_pages'   =>true,
	            'delete_others_posts'   =>true,
	            'delete_posts'          =>true,
	            'delete_private_pages'  =>true,
	            'delete_private_posts'  =>true,
	            'delete_published_pages'=>true,
	            'delete_published_posts'=>true,
	            'delete_site'           =>true,
	            'edit_dashboard'        =>true,
	            'edit_others_pages'     =>true,
	            'edit_pages'            =>true,
	            'edit_posts'            =>true,
	            'edit_published_pages'  =>true,
	            'edit_theme_options'    =>true,
	            'import'                =>true,
	            'list_users'            =>true,
	            'manage_categories'     =>true,
	            'manage_links'          =>true,
	            'manage_options'        =>true,
	            'moderate_comments'     =>true,
	            'promote_users'         =>true,
	            'publish_pages'         =>true,
	            'publish_posts'         =>true,
	            'read'                  =>true,
	            'read_private_pages'    =>true,
	            'remove_users'          =>true,
	            'switch_themes'         =>true,
	            'upload_files'          =>true,
	        )
	    );
	}
	//===============================================================================
	//============= adding a new column in 'user' menu   ==========================
	//===============================================================================

	function refine_active_methods( $contactmethods ) {
	    $contactmethods['Last Active'] = 'Last Active';
	    return $contactmethods;
	}

	function refine_modify_user_table( $column ) {
	    $column['Last Active'] = 'last Active';
	    return $column;
	}
	//adding a menu page to approve and disapprove user 
		function max_register_menu_page(){
			add_menu_page(
			    'Pharma Registration Fields',//Page title
			    'Pharma Registration Fields',//Menu title
			    'manage_options',//capability
			    'max-setting',//parent/menu slug
			    'max_setting_page_html',//call back function
			    'dashicons-buddicons-buddypress-logo',//icon of main sectio
			    30//set position of menu
			);
			add_submenu_page(
				'max-setting',			//parent slug
			    'Approve_User',			//page title
			    'Approve User',			//menu title
			    'manage_options',		//capability
			    'approve_user',			//menu slug
			    'add_new_function',		// call back function
			);	
		}
		// wordpress default table class
		public function max_hj_default_menu_page(){
			add_menu_page(
			    'Users',//Page title
			    'Custom user',//Menu title
			    'manage_options',//capability
			    'user',//parent/menu slug
			    array($this,'max_hj_sub_menu_page'),//call back function
			    'dashicons-buddicons-buddypress-logo',//icon of main sectio
			    30//set position of menu
			);
		}
		function max_hj_sub_menu_page(){

			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wordpress-default-table-UI.php';
		}

    function deleteUserAjax() {
    	 $user->ID = isset( $_POST['hj_post_id'] ) ? (int) $_POST['hj_post_id'] : 0;
		    if( ! $user->ID ) {
		        echo __( 'Post ID not found' );

		        wp_die();
		    }
		    
		        wp_delete_user( $user->ID );
		        wp_die();



	}
	function myplugin_ajaxurl() {
    echo '<script type="text/javascript">
           var ajaxurl = "' . admin_url('admin-ajax.php') . '";
         </script>';
}
}

$pharma_admin = new Pharma_Admin();


		
