<?php
$course_name = get_query_var('course_name');


$args = array(
    'post_type'  => 'product',
    'name'       => $course_name,
    'post_status' => 'publish',
    'numberposts' => 1,
);
$course = get_posts($args);


$course_id = $course[0]->ID;
$current_user_id = get_current_user_id();


$has_purchased = wc_customer_bought_product('', $current_user_id, $course_id);
var_dump($has_purchased);

?>
<div>test</div>