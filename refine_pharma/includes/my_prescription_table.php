<?php 
{
    $arg=[
        'post_type' => 'price',
        'post_status' => 'publish',
        'post_per_page'=>-1
    ];
      $query = new WP_Query($arg);
     ?>
          <table>
          <tr>
              <th>ID</th>
              <th>Image</th>
              <th>Title</th>
              <th>Price</th>
              <th>Quantity</th>
              <th>Sale Price</th>
          </tr>
          <?php
          foreach ($query->posts as $post_data) {
              $pre_order_post_id = $post_data->ID;
              $items = get_post_meta($pre_order_post_id, 'items', true);
              foreach ($items as $item) {
                  $product_id = $item['product_id'];
                  $quantity = $item['quantity'];
                  $price = get_post_field('_price', $product_id);
                  $subtotal =  $quantity * $price;
          ?>
                    <tr>
                      <td style=" width: 15%;"><?php echo $pre_order_post_id ?></td>
                      <td style=" width: 15%;"><img src="<?php echo get_the_post_thumbnail_url($product_id); ?>"></td>
                      <td><?php _e(get_post_field('post_title', $product_id)) ?></td>
                      <td><?php _e(get_post_field('_price', $product_id)) ?></td>
                      <td><?php _e($quantity) ?></td>
                      <td><?php _e($subtotal) ?></td>
                  </tr> 

              <?php   
              }
          }
          ?>
      </table>
      <?php 
  }