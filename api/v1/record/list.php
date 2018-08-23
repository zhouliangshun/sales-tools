<?php

require_once(dirname(dirname(dirname(dirname(__FILE__)))).'/functions.php');

$user = $_REQUEST['user'];
$name = $_REQUEST['id'];
$record = $_REQUEST['record'];

if(!isset($user)
    || !isset($name)
    || !isset($record)){
    echo wp_json_encode( array('code'=>301, 'msg'=>"缺少参数", 'data'=>$data) );
    exit();
}

//查询record是否存在，不存在不能添加
$record_desc = get_record_info($record, $user);
if(!isset($record_desc)){
    echo wp_json_encode( array('code'=>303, 'msg'=>"记录不存在") );
    exit();
}

$data = get_sale_record_list($user, $record_desc->local_id, $name);

echo wp_json_encode(array('code'=>200, 'msg'=>'','data'=>$data));