<?php 
function max_setting_page_html(){
    }   
    function add_new_function(){
        $users = get_users( array() );
         foreach($users as $user){
      if(isset($_GET['action']) && $_GET['action'] == 'approve_user') {
          update_user_meta($_GET['user_id'], 'approved', 'approve');
        }
      if (isset($_GET['action']) && $_GET['action'] == 'un_approve_user') {
          update_user_meta($_GET['user_id'], 'approved', 'unapproved');
        }
      $attachment = get_post(get_user_meta($user->ID, 'utility_bill', true));
        ?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
 <table class="table table-bordered ">
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
            ?>
        <tr>
        <td><?php  echo$user->ID ?></td>
        <td><?php echo($user->user_login);?></td>
        <td><?php echo(get_user_meta($user->ID, 'Profession' , true )); ?></td>
        <td><?php echo(get_user_meta($user->ID, 'registration_no' , true )); ?></td>
        <td><?php echo(get_user_meta($user->ID, 'medical_type' , true )); ?></td>
        <td><?php echo ($user->user_email);?></td>
        <td><?php echo($user->roles[0]);?></td>
        <td><?php $attach= get_post(get_user_meta($user->ID, 'photo_id' , true ));
        ?>
            <a href="<?php echo $passport_img;?>" target="blank"><?php echo !empty($attach->post_title) ? $attach->post_title : ''; ?></a>
        <br>
            <?php  $attach= get_post(get_user_meta($user->ID, 'utility_bill' , true ));?>
            <a href="<?php echo $bills_img;?>" target="_blank"><?php  echo !empty($attach->post_title) ? $attach->post_title : ''; ?><br>
            <?php  $attach= get_post(get_user_meta($user->ID, 'industry_certificate' , true ));?>
            <a href="<?php echo $certificate_img;?>" target="blank"><?php  echo !empty($attach->post_title) ? $attach->post_title : ''; ?>
        </td>
        <td><?php echo (get_user_meta($user->ID, 'is_approved' , true ));?></td>
        <td>
            <?php
            if(get_user_meta($user->ID, 'is_approved' , true ) == 'un-approve'){
                echo '<a href="'. admin_url('/admin.php?page=approved_user&action=approve_user&user_id=' . $user->ID) . '"  class="button">Approve</a>';
                } else{
                   echo '<a href="'. admin_url('/admin.php?page=approved_user&action=un_approve_user&user_id=' . $user->ID) . '" class="button">Not Approve</a>';
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
   
        echo"<pre>";

      // print_r(get_user_meta,$user_id );
       //print_r($users);
        echo"</pre>";
        ///////////?>
<?php
}
};
?>