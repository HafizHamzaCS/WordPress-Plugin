
<?php 
  // ============================================================
  // 		Register a menu
  // ===============================================================		

	function max_setting_page_html(){
	}	
	function add_new_function(){

    
    if (isset($_GET['action']) && $_GET['action'] == 'approve_user') {
        update_user_meta($_GET['user_id'], 'approved', 'approve');
      }
    if (isset($_GET['action']) && $_GET['action'] == 'un_approve_user') {
        update_user_meta($_GET['user_id'], 'approved', 'unapproved');
      }
		?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script type="text/jQuery" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
 <table class="table " id="myTable">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Profession</th>
        <th>Registration Number</th>
        <th>Type</th>
        <th>Email</th>
        <th>Role</th>
        <th>Files</th>
        <th>Status</th>
        <th>Approved/Disapproved</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        //===============================================================================
        //=============loop through item to get all form data  ==========================
        //===============================================================================
        $users = get_users( array() );
         foreach($users as $user){
          if( !empty(get_user_meta($user->ID, 'photo_id' , true )) ){
                $certificate_img = wp_get_attachment_url(get_user_meta($user->ID, 'photo_id' , true ));
            }else{
                $certificate_img = '';
            }
             if( !empty(get_user_meta($user->ID, 'utility_bill' , true )) ){
                $bills_img = wp_get_attachment_url(get_user_meta($user->ID, 'utility_bill' , true ));
            }else{
                $bills_img = '';
            }
            if( !empty(get_user_meta($user->ID, 'industry_certificate' , true )) ){
                $passport_img = wp_get_attachment_url(get_user_meta($user->ID, 'industry_certificate' , true ));
            }else{
                $passport_img = '';
              }
            if( !empty(get_user_meta($user->ID, 'insurance' , true )) ){
                $insurance = wp_get_attachment_url(get_user_meta($user->ID, 'insurance' , true ));
            }else{
                $insurance = '';
            }
            if( !empty(get_user_meta($user->ID, 'treatment' , true )) ){
                $insurance = wp_get_attachment_url(get_user_meta($user->ID, 'treatment' , true ));
            }else{
                $insurance = '';
            }
      ?>   
        <tr>
          <td><?php  echo$user->ID ?></td>
          <td><?php echo($user->user_login);?></td>
          <td><?php echo(get_user_meta($user->ID, 'Profession' , true )); ?></td>
          <td><?php echo(get_user_meta($user->ID, 'registration_no' , true )); ?></td>
          <td><?php echo(get_user_meta($user->ID, 'medical_type' , true )); ?></td>
          <td><?php echo ($user->user_email);?></td>
          <td><?php echo($user->roles[0]);?></td>
          <td>
            <p>

              <?php $attach= get_post(get_user_meta($user->ID, 'photo_id' , true ));?>
              <a href="<?php echo $certificate_img;?>" target="_blank"><?php echo !empty($attach->post_title) ? $attach->post_title : ''; ?></a><br>

            </p>
            <p>

              <?php  $attach= get_post(get_user_meta($user->ID, 'utility_bill' , true ));?>
              <a href="<?php echo $bills_img;?>" target="_blank"><?php  echo !empty($attach->post_title) ? $attach->post_title : ''; ?></a><br>

            </p>
            <p>

              <?php  $attach= get_post(get_user_meta($user->ID, 'industry_certificate' , true ));?>
              <a href="<?php echo $passport_img;?>" target="_blank"><?php  echo !empty($attach->post_title) ? $attach->post_title : ''; ?></a>

            </p>
            <p>

              <?php  $attach= get_post(get_user_meta($user->ID, 'insurance' , true ));?>
              <a href="<?php echo $insurance;?>" target="_blank"><?php  echo !empty($attach->post_title) ? $attach->post_title : ''; ?></a><br>

            </p>
            <p>

              <?php  $attach= get_post(get_user_meta($user->ID, 'treatment' , true ));?>
              <a href="<?php echo $treatment;?>" target="_blank"><?php  echo !empty($attach->post_title) ? $attach->post_title : ''; ?></a><br>

            </p>
          </td>
          <td><?php echo get_user_meta( $user->ID,'approved', true ); ?></td>
          <td>
            <?php
              if(get_user_meta($user->ID, 'approved' , true ) == 'unapproved'){
                echo '<a href="'. admin_url('/admin.php?page=approve_user&action=approve_user&user_id=' . $user->ID) . '"  class="button">Approve</a>';
                }else{
                   echo '<a href="'. admin_url('/admin.php?page=approve_user&action=un_approve_user&user_id=' . $user->ID) . '" class="button">Disapproved</a>';
                }
            ?>
          </td>

        </tr>
      <?php
      }
      ?>
    </tbody>
  </table>
<?php
};
?>