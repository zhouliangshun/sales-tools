<?php
    require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/wp-load.php');
    if(is_user_logged_in()){
        wp_logout();
    }
    echo "<html><script type='text/javascript'>Native.logout();</script></html>";
?>

