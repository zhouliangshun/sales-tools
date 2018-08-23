<?php

require_once(dirname(dirname(dirname(dirname(__FILE__)))).'/functions.php');

$user = $_REQUEST['user'];
$id = $_REQUEST['id'];
$phone = $_REQUEST['phone'];
$record = $_REQUEST['record'];
$count = $_REQUEST['count'];
$purchaser = $_REQUEST['purchaser'];

if(!isset($user)
    || !isset($id)
    || !isset($phone)
    || !isset($record)
    || !isset($count)
    || !isset($purchaser)){
    echo wp_json_encode( array('code'=>301, 'msg'=>"缺少参数", 'data'=>$data) );
    exit();
}

$goods = get_goods_full_info($id, $user);
if(!isset($goods)){
    echo wp_json_encode( array('code'=>302, 'msg'=>"物品不存在", 'data'=>$data) );
    exit();
}

//查询record是否存在，不存在不能添加
$record_desc = get_record_info($record, $user);
if(!isset($record_desc)){
    echo wp_json_encode( array('code'=>303, 'msg'=>"记录不存在") );
    exit();
}

//添加
$result = add_sale_record($record_desc->local_id, $goods, $count, $purchaser, $phone, $user);
if(!result){
    echo wp_json_encode(array('code'=>400, 'msg'=>"添加失败！"));
    exit;
}

echo wp_json_encode(array('code'=>200, 'msg'=>"添加成功！"));