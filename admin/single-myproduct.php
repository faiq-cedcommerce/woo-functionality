<?php
get_header();
global $post;
$postData = get_post( $post->ID ); 
echo '<div style="border: solid 2px #000;width: 300px;padding: 20px;">';
echo  '<div style="width:260px; height:200px;">' . get_the_post_thumbnail() . '</div>';
echo '<div style="color: #5c370c; font-size: 24px; font-weight: 800" >' . get_the_title() . '</div>';
echo '<div style="color: #000; font-size: 18px; font-weight: 600;"><i>' . get_the_content() . '</i></div>'; 
echo '<div style="color: red; font-size: 24px; font-weight: 800;">Rs: ' . get_post_meta($post->ID, '_product_price')[0] . '</div>'; 
echo '<input type="number" name="quantity" id="ced_quantity" min="1" max="1000" value="1">'; 
echo '<div style="margin-top:20px;"><button name="add_to_cart" prod_id="' .$post->ID. '" class="button ced_add_to_cart">Add to Cart</button></div>'; 
echo '</div>';