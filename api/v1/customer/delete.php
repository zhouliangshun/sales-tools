<?php
/**
 * Created by PhpStorm.
 * User: zhouliangshun
 * Date: 2018/8/22
 * Time: 8:36 PM
 */

require_once(dirname(dirname(dirname(dirname(__FILE__)))).'/functions.php');

$ids = explode(",",$_REQUEST['ids']);
$user = $_REQUEST['user'];

if(!isset($ids)){
    echo wp_json_encode( array('code'=>301, 'msg'=>"参数错误", 'data'=>$data) );
    exit();
}

delete_data_server('customer',$ids,$user);

echo wp_json_encode( array('code'=>200, 'msg'=>"", 'data'=>$goods) );

?>