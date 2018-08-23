<?php

require_once(dirname(dirname(dirname(dirname(__FILE__)))).'/functions.php');

$user = $_REQUEST['user'];
$data = json_decode(file_get_contents("php://input"), true);
$last_time = $data["time"];

//describe
update_local_id('record_describe',$data['ids']['describes'],$user);
$result_ids['describes'] = update_data('record_describe', $data['describes'], $user);

//sales
update_local_id('sale_record',$data['ids']['sales'],$user);
$result_ids['sales'] = update_data('sale_record', $data['sales'], $user);

//customer
update_local_id('customer',$data['ids']['customers'],$user);
$result_ids['customers'] = update_data('customer', $data['customers'], $user);

//goods
update_local_id('goods',$data['ids']['goods'],$user);
$result_ids['goods'] = update_data('goods', $data['goods'], $user);

//paid
update_local_id('paid_flag',$data['ids']['paids'],$user);
$result_ids['paids'] = update_data('paid_flag', $data['paids'], $user);

//pics
update_local_id('goods_pics',$data['ids']['pics'],$user);
$result_ids['pics'] = update_data('goods_pics', $data['pics'], $user);

foreach($data['delete'] as $delete){
    $table_name = null;
    switch($delete['table_name']){
        case "RECORD_DESCRIBE":
            $table_name = 'record_describe';
            break;
        case "SALE_RECORD":
            $table_name = 'sale_record';
            break;
        case "CUSTOMER":
            $table_name = 'customer';
            break;
        case "GOODS":
            $table_name = 'goods';
            break;
        case "PAID_FLAG":
            $table_name = 'paid_flag';
            break;
        case "GOODS_PICS":
            $table_name = 'goods_pics';
            break;
    }

    if($table_name){
        delete_data($table_name, $delete['record_id']);
    }
}

//update timestamp wp_sync_timestamp
update_last_sync_time($user, $last_time);

echo wp_json_encode(array('code'=>200, 'msg'=>"SUCCESS", 'data'=>$result_ids));