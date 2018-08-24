<?php
/**
 * Created by PhpStorm.
 * User: zhouliangshun
 * Date: 2018/8/22
 * Time: 8:36 PM
 */

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/functions.php');

$id = $_REQUEST['id'];
$user = $_REQUEST['user'];

$name = $_REQUEST['name'];
$count = $_REQUEST['count'];
$purchase_price = $_REQUEST['purchase_price'];
$sell_price = $_REQUEST['sell_price'];
$spec = $_REQUEST['spec'];
$comments = $_REQUEST['comments'];
$country = $_REQUEST['country'];

$id = update_server('goods', 'name', compact('name', 'count', 'purchase_price', 'sell_price', 'spec','comments','country'), $id, $user);

echo wp_json_encode(array('code' => 200, 'msg' => "", 'data' => array('id' => $id)));