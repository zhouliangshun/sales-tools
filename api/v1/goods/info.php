<?php
require_once(dirname(dirname(dirname(dirname(__FILE__)))).'/functions.php');
$user = $_REQUEST['user'];
$id = $_REQUEST['id'];

if(!isset($user) || !isset($id)){
    echo wp_json_encode( array('code'=>301, 'msg'=>"参数错误", 'data'=>$data) );
    exit();
}

$goods = get_goods_info($id, $user);

if(!isset($goods)){
    echo wp_json_encode( array('code'=>401, 'msg'=>"物品不存在", 'data'=>$data) );
    exit();
}

echo wp_json_encode( array('code'=>200, 'msg'=>"", 'data'=>$goods) );

?>