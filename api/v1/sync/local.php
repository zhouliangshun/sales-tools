<?php

require_once(dirname(dirname(dirname(dirname(__FILE__)))).'/functions.php');

$user = $_REQUEST['user'];
$last_time = $_REQUEST['time'];

$data['describes'] = get_update_record_describe_list($user, $last_time);
$data['sales'] = get_update_sale_record_list($user, $last_time);
$data['customers'] = get_update_customer_list($user, $last_time);
$data['goods'] = get_update_goods_list($user, $last_time);
$data['paids'] = get_update_paid_list($user, $last_time);
$data['pics'] = get_update_goods_pics_list($user, $last_time);
$data['time'] = time();
$data['delete'] = get_delete_ids($user);
$data['last_sync_time'] = get_last_sync_time($user);
clear_delete_ids($user);

echo wp_json_encode( array('code'=>200, 'msg'=>"", 'data'=>$data) );
?>