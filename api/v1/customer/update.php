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
$phone = $_REQUEST['phone'];
$address = $_REQUEST['address'];
$score = $_REQUEST['score'];
$amount = $_REQUEST['amount'];

$id = update_server('customer', 'name', compact('name', 'phone', 'address', 'score', 'amount'), $id, $user);

echo wp_json_encode(array('code' => 200, 'msg' => "", 'data' => array('id' => $id)));