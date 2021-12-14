<?php
/**
 * Proceed to checkout button
 *
 * Contains the markup for the proceed to checkout button on the cart.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/proceed-to-checkout-button.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
 <!-- adding a new button  -->
 <?php 
      global $wpdb;
      $current_user_id = get_current_user_id();
      $table = 'wp_patient_detail';
      $results = $wpdb->get_results("SELECT * FROM $table ");
     ?>
 <div class="form-group" style="display: flex;">
    <select required="" name="rf_patient" class="form-control" id="rf_patient" style="width: 100%;max-width: 500px;margin-right: 30px;">
        <option value="">Select Patient</option>
        <!-- fetch data from databae -->
        <?php foreach ($results as $value) { ?>
             <option  value="<?php echo $value->patient_name;?>"><?php echo $value->patient_name;?>
             </option>
        <?php } ?>
        <!-- fetch data from database -->
    </select>
    <a href="<?php echo site_url('my-account/refine-pharma-patient/') ?>">Add New</a>
</div>
 <div class="form-group" style="display: flex;">
    <select required="" name="rf_prescriber" class="form-control" id="rf_prescriber" style="width: 100%;max-width: 500px;margin-right: 30px;">
        <option value="">Select Prescriber</option>
        <option value="id">new prescriber</option>
    </select>
    <a href="#">Add New</a>
</div>
<?php 
$term_names = [];
foreach (WC()->cart->get_cart() as $item_keys => $item) {


    $product_id = $item['product_id'];
    $line_total = $item['line_total'];

    $terms = get_the_terms($product_id, 'product_tag');

    foreach ($terms as $term) {
        $term_names[] = $term->name;
    }
}
$ancher_text = 'Proceed to checkout';
if ((in_array('POM', $term_names) == TRUE && in_array('NON-POM', $term_names) == TRUE) || in_array('POM', $term_names) == TRUE  ) {
    $ancher_text = 'Create Prescription';
} elseif (in_array('NON-POM', $term_names) === true && in_array('POM', $term_names) === false) {
    $ancher_text = 'Proceed to checkout';
}
?>
<!--  Adding a new button  -->
<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="checkout-button button alt wc-forward">
	<?php esc_html_e( $ancher_text, 'woocommerce' ); ?>
</a>
