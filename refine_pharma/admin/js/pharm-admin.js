	jQuery(document).ready( function () {
        jQuery('#myTable').DataTable();
    jQuery( '.rf-delete-user' ).on( 'click', function() {

    let self = jQuery( this );
    let parent = self.parents( 'tr' );
    let postID = parent.find( '.user_id a' ).attr( 'data-user-id' );
    console.log(postID);
    let data = {
      'action'          : 'deleteUserAjax',
      'hj_post_id'     : postID,
    }

    jQuery.post( ajaxurl, data, function( responce ) {
      //  location.reload( true );
    } );
 
  } );








    } );