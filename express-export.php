<?php
    require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/wp-load.php');
    require_once(dirname(__FILE__).'/functions.php');
    if(!is_user_logged_in()){
        auth_redirect();
        exit;
    }
?>

<!DOCTYPE html>
<html lang="zh">
<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, viewport-fit=cover">
  <link rel="stylesheet" href="./css/framework7.min.css">
  <title>导出快递</title>
  <!-- <link rel="stylesheet" href="css/app.css"> -->
</head>

<body>
    <div id="app">
        </tabel>
            <thead>
                <tr>
                    <th><label for="cb-select-all">全选</label><input id="cb-select-all" type="checkbox"></th>
                    <th><span>姓名</span></tr>
                    <th>地址</tr>
                    <th>电话</tr>
                    <th><input id="btn-export" type="button" value="导出"></th>
                </tr>
            </thead>
            <tbody id="the-list">
                <?php 
                    
                    $user = wp_get_current_user(); 
                    $customers = get_customer_list($user->user_login);
                    if(isset($customers)) {
                        foreach($customers as $custome) {
                            echo "<tr id='$custome->server_id'><td><input id='cb-select-$custome->server_id' type='checkbox'></td>
                            <th><span>$custome->name</span></tr>
                            <th><span>$custome->address</span></tr>
                            <th><span>$custome->phone</span></tr>
                            <th></th></tr>";
                        } 
                    }
                   
                ?>
            </tbody>
        <tabel>
    </div>

    <script type="text/javascript" src="./js/framework7.min.js"></script>
</body>

</html>

