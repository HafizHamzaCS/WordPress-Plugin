<?
function ss_user_approvel_call_back_func(){
	$args = array(
		'role'    => 'customer',
		'orderby' => 'user_nicename',
		'order'   => 'ASC'
	);
	$users = get_users( $args );
    ?>
	
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
	<script type="text/jQuery" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
	<div class="sb_table">
		<h4>Approve Users</h4>
		<table id="table_id" class="display">
			<thead>
				<tr>
					<th>ID</th>
<!--					<th>Username</th>-->
					<th>Name</th>
					<th>Profession</th>
					<th>Registration Number</th>
					<th>Type</th>
					<th>Email</th>
					<th>Role</th>
					<th>Files</th>
					<th>Status</th>
					<th>Approve / Disapprove</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($users as $user){
                $user_id = $user->ID;
                $current_user = wp_get_current_user();
                $type = '';
                if(!empty(get_user_meta($user_id, 'presc_data')) && get_user_meta($user_id, 'presc_data')[0] == 1) {
                    $type = 'Prescriber';
                }
                else if(!empty(get_user_meta($user_id, 'presc_data')) && get_user_meta($user_id, 'presc_data')[0] == 2) {
                    $type = 'Non Prescriber';
                }else{
                    $type = 'Other';
                }
		$files = '';
		$sb = 1;
		if(!empty(get_user_meta($user_id, 'attachments')) && !empty(get_user_meta($user_id, 'attachments')[0])){
			$files_array = get_user_meta($user_id, 'attachments')[0];
			$files_array = json_decode($files_array);
			foreach($files_array as $single){
				if($sb == 1 && !empty(wp_get_attachment_url($single)) && file_get_contents(wp_get_attachment_url($single))){
					$files .= '<a href="'.wp_get_attachment_url($single).'" target="_blank">Passport/License</a><br />';	
				}
				elseif($sb == 2 && !empty(wp_get_attachment_url($single)) && file_get_contents(wp_get_attachment_url($single))){
					$files .= '<a href="'.wp_get_attachment_url($single).'" target="_blank">Utiity Bill</a><br />';	
				}
				elseif($sb == 3 && !empty(wp_get_attachment_url($single)) && file_get_contents(wp_get_attachment_url($single))){
					$files .= '<a href="'.wp_get_attachment_url($single).'" target="_blank">Training Certificate</a><br />';	
				}
				$sb++;
			}
		}
		$extra_files = '';
		$sb = 1;
		if(!empty(get_user_meta($user_id, 'extra_attachments')) && !empty(get_user_meta($user_id, 'extra_attachments')[0])){
            $files_array = get_user_meta($user_id, 'extra_attachments')[0];
            if(!empty($files_array) && $files_array != '') {
                $files_array = json_decode($files_array);
//                if (!empty($files_array) && $files_array != '' && count($files_array) >= 1) {
                if (!empty($files_array) && $files_array != '') {
                    foreach ($files_array as $single) {
                        if (!empty($single) && !empty($single->name) && !empty($single->id) && file_get_contents(wp_get_attachment_url($single->id))) {
                            $extra_files .= '<a href="' . wp_get_attachment_url($single->id) . '" target="_blank">' . $single->label . '</a><br />';
                            $sb++;
                        }
                    }
                }
            }
		}
                $files .= $extra_files;
		
                if ( in_array( 'super_admin', (array) $current_user->roles ) ) {
                        ?>

                        <tr>

                            <td><?php echo $user_id; ?></td>
<!--                            <td>--><?php //echo $user->user_nicename . '( ' . $user_id . ' )'; ?><!--</td>-->

                            <td><?php echo get_user_meta($user_id, 'first_name')[0].' '.get_user_meta($user_id, 'last_name')[0]; ?></td>
                            <td><?php echo (!empty(get_user_meta($user_id, 'profession', true))) ? get_user_meta($user_id, 'profession', true) : 'profession'; ?></td>
                            <td><?php echo (!empty(get_user_meta($user_id, 'ss_reg_field', true))) ? get_user_meta($user_id, 'ss_reg_field', true) : ''; ?></td>
                            <td><?php echo $type; ?></td>

                            <td><?php echo $user->user_email; ?></td>

                            <td><?php echo $user->roles[0]; ?></td>
							<td><?php echo (!empty($files)) ? $files : 'No File'; ?></td>

                            <td><?php if(!empty(get_user_meta($user_id, 'max_account_status'))){ echo get_user_meta($user_id, 'max_account_status')[0];} else{ echo 'pending'; } ?></td>

                            <td>

                                <form action="<?php echo admin_url('admin-post.php'); ?>" method="post">

                                    <input type="hidden" name="action" value="sb_status_form_submit">

                                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">

                                    <?php if (!empty(get_user_meta($user_id, 'max_account_status')) && get_user_meta($user_id, 'max_account_status')[0] == 'approved') { ?>

                                        <input type="hidden" name="status" value="pending">

                                        <input type="submit" name="action_post" value="Disapprove">

                                    <?php } else { ?>

                                        <input type="hidden" name="status" value="approved">

                                        <input type="submit" name="action_post" value="Approve">

                                    <?php } ?>

                                </form>

                            </td>

                        </tr>

                        <?php
                }
                else{
                        ?>
                        <tr>
                            <td><?php echo $user_id; ?></td>
<!--                            <td>--><?php //echo $user->user_nicename.'( '.$user_id.' )'; ?><!--</td>-->
                            <td>
                                <a href="#" class="max_view_info" data-id="<?php echo $user_id; ?>">
                                    <?php echo get_user_meta($user_id, 'first_name')[0].' '.get_user_meta($user_id, 'last_name')[0]; ?>
                                </a>
                            </td>
                            <td><?php echo (!empty(get_user_meta($user_id, 'profession', true))) ? get_user_meta($user_id, 'profession', true) : 'profession'; ?></td>
                            <td><?php echo (!empty(get_user_meta($user_id, 'ss_reg_field', true))) ? get_user_meta($user_id, 'ss_reg_field', true) : ''; ?></td>
                            <td><?php echo $type; ?></td>
                            <td><?php echo $user->user_email; ?></td>

                            <td><?php echo $user->roles[0]; ?></td>
							<td><?php echo (!empty($files)) ? $files : 'No File'; ?></td>
                            <td><?php if(!empty(get_user_meta($user_id, 'max_account_status'))){ echo get_user_meta($user_id, 'max_account_status')[0];} else{ echo 'pending'; } ?></td>
                            <td>
                                <?php if(!empty(get_user_meta($user_id, 'presc_data')) && get_user_meta($user_id, 'presc_data')[0] == 1){ ?>

                                <?php } else { ?>
                                    <form action="<?php echo admin_url('admin-post.php'); ?>" method="post">
                                        <input type="hidden" name="action" value="sb_status_form_submit">
                                        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                        <?php if (!empty(get_user_meta($user_id, 'max_account_status')) && get_user_meta($user_id, 'max_account_status')[0] == 'approved') { ?>
                                            <input type="hidden" name="status" value="pending">
                                            <input type="submit" name="action_post" value="Disapprove">
                                        <?php } else { ?>
                                            <input type="hidden" name="status" value="approved">
                                            <input type="submit" name="action_post" value="Approve">
                                        <?php } ?>
                                    </form>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php
                }
			} ?>
			</tbody>
		</table>
	</div>
    <div class="max_modal" style="display:none;">
        <div class="max_modal_inner">
        </div>
    </div>
	<script>
		jQuery(document).ready( function () {
			jQuery('#table_id').DataTable({
                "order": [[ 8, "desc" ], [0,'desc']]
            });
            jQuery(document).on( 'click', '.max_modal_close', function(e){
                jQuery('.max_modal').hide();
            });
            jQuery(document).on( 'click', '.max_view_info', function(e){
            // jQuery('.max_view_info').click(function(e){
                e.preventDefault();
                var id = jQuery(this).data('id');
                var getSiteAdminURL = max_customer_smart_tradition_bargain_ajax_url.ajax_url;
                var getSiteURL = getSiteAdminURL.replace('/wp-admin/admin-ajax.php', '');
                var fd = new FormData();
                fd.append('id', id);
                fd.append('action', 'max_user_info_admin_popup');
                jQuery.ajax({
                    type: "post",
                    url: getSiteAdminURL,
                    data: fd,
                    cache: false,
                    processData: false,
                    contentType: false,
                    success: function (res) {
                        jQuery("html, body").animate({ scrollTop: 0 }, "slow");
                        jQuery('.max_modal').show();
                        jQuery('.max_modal_inner').empty();
                        jQuery('.max_modal_inner').append(res);
                    }
                });
            })
		} );
	</script>
    <?php
