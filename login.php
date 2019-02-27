<?php
require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/wp-load.php');
if (!is_user_logged_in()) auth_redirect();
$user = wp_get_current_user();
$user_json = wp_json_encode(array('user' => $user->user_login,
    'nickName' => $user->user_nicename,
    'pic' => $user->user_url));
echo "<html><script type='text/javascript'>Native.login('$user_json');</script></html>";
?>

