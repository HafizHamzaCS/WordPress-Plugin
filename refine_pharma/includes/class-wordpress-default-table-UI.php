<?php
if ( ! class_exists( 'WP_List_Table' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}
class Custom_Table_List_Table extends WP_List_Table
 {


 	 function __construct()
    {
        global $status, $page;

        parent::__construct(array(
            'singular' => 'user',
            'plural'   => 'users',
        ));

    }

    function prepare_items(){

        // $order_by = isset( $_GET['orderby'] ) ? $_GET['orderby'] : '';
        // $order = isset( $_GET['order'] ) ? $_GET['order'] : '';
        // $search_term = isset( $_POST['s'] ) ? $_POST['s'] : '';

        // $this->items = $this->wlt_list_table_data( $order_by, $order, $search_term );

        $columns = $this->get_columns();
        $hidden = array();
        $sortable = $this->get_sortable_columns();
        $this->_column_headers = array($columns, $hidden, $sortable);


        $paged = isset($_REQUEST['paged']) ? max(0, intval($_REQUEST['paged']) - 1) : 0;
        $orderby = (isset($_REQUEST['orderby']) && in_array($_REQUEST['orderby'], array_keys($this->get_sortable_columns()))) ? $_REQUEST['orderby'] : 'lastname';
        $order = (isset($_REQUEST['order']) && in_array($_REQUEST['order'], array('asc', 'desc'))) ? $_REQUEST['order'] : 'asc';

        
        $this->items = $this->get_data_from_db();
    }
    //===============================================================================
    //============= WP list table row actions  ======================================
    //===============================================================================
    public function handle_row_actions( $item, $column_name, $primary ) {

        if( $primary !== $column_name ) {
            return '';
        }

        $action = [];
        $action['delete'] = '<a class="rf-delete-user">'.__( 'Delete' ).'</a>';
        return $this->row_actions( $action );
    }

     function get_bulk_actions()
    {   
        $actions = array(

            'delete'      => __( 'Delete' ),

        );
        return $actions;
    }
        

  
    function column_cb($item)
    {
        return sprintf(
            // '<input type="checkbox" name="id[]" value="%s" />',
            '<input type="checkbox" name="bulk-delete[]" value="%s" />', $item['ID']    
            // $item['id']
        );
    }

   
   

    public function get_data_from_db(){
            echo  '<h2>Refine Pharma Users Details</h2>';
        $users = get_users(); // get array of WP_User objects

        foreach ( $users as $user ) {

                $files_name = '';
                $files_name .= '<a href="'.wp_get_attachment_url(get_user_meta($user->ID, 'photo_id' , true )).'" target="_blank">Photo ID</a><br>';
                $files_name .= '<a href="'.wp_get_attachment_url(get_user_meta($user->ID, 'utility_bill' , true )).'" target="_blank">Utiity Bills</a><br>';
                $files_name .= '<a href="'.wp_get_attachment_url(get_user_meta($user->ID, 'industry_certificate' , true )).'" target="_blank">Industry</a><br>';
                $files_name .= '<a href="'.wp_get_attachment_url(get_user_meta($user->ID, 'insurance' , true )).'" target="_blank">Insurance</a><br>';
                $files_name .= '<a href="'.wp_get_attachment_url(get_user_meta($user->ID, 'treatment' , true )).'" target="_blank">Treatment</a><br>';

                $form_arr[] = [

                    // 'user_id'               => $user->ID,
                    'user_id'               => '<a data-user-id="'.$user->ID.'" href="'.get_edit_user_link( $user->ID ).'"> '.$user->ID.' </a>',
                    'name'                  => $user->user_login ,
                    'Profession'            => get_user_meta($user->ID, 'Profession' , true ),
                    'Registration Number'   => get_user_meta($user->ID, 'registration_no' , true ),
                    'Type'                  => get_user_meta($user->ID, 'medical_type' , true ),
                    'Email'                 => $user->user_email,
                    'Role'                  => $user->roles[0],
                    'Files'                 => $files_name,
                    'Status'                =>  __('Approved'),
                    'Action'                => '<Button variant="secondary">Approve</Button>',

                ];
        }           
        return $form_arr;
    }
    function column_default($item, $column_name)
    {   
        switch ($column_name){
            case 'user_id':
            case 'name':
            case 'Profession':
            case 'Registration Number':
            case 'medical_type':
            case 'Email':
            case 'Role':
            case 'Files':
            case 'Status':
            case 'Action':
    }

        return $item[$column_name];
    }

 	function get_columns()
    {
        $columns = array(
            'cb' 					=> '<input type="checkbox" />',
            'user_id' => __('USER ID'),
            'name'      			=> __('Name'),
            'Profession'  			=> __('Profession'),
            'Registration Number'   => __('Registration Number'),
            'Type'   				=> __('Type'),
            'Email'   				=> __('Email'),
            'Role'   				=> __('Role'),
            'Files'                 => __('Files'),
            'Status'   				=> __('Status'),
            'Action'                => __('Action'),
        );

        return $columns;
    }
    function get_sortable_columns()
    {
        $sortable_columns = array(
            'user_id'               => array('user_id',true),
            'name'      			=> array('name', true),
            'Profession'  			=> array('Profession', true),
            'Registration Number'   => array('Registration Number', true),
            'Type'     				=> array('Type', true),
            'Email'   				=> array('Email', true),
            'Role'       			=> array('Role', true),  
            'Status' 				=> array('Status', true),  
            'Files' 				=> array('Files', true),   
        );
        return $sortable_columns;
    }

    public function get_primary_column() {
        return $this->get_primary_column_name();
    }
 
}
	$table_list_table = new Custom_Table_List_Table();

	$table_list_table->prepare_items();

	$table_list_table->search_box('Search Post','search_post_id');

    // $table_list_table->pagination();


    $table_list_table->display();


