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
  <title>快递批量下单系统</title>
  <!-- <link rel="stylesheet" href="css/app.css"> -->

   <style type="text/css">
        table
        {
            border-collapse: collapse;
            margin: 0 auto;
            text-align: center;
        }
        table td, table th
        {
            border: 1px solid #cad9ea;
            color: #666;
            height: 30px;
        }
        table thead th
        {
            background-color: #CCE8EB;
            width: 100px;
        }
        table tr:nth-child(odd)
        {
            background: #fff;
        }
        table tr:nth-child(even)
        {
            background: #F5FAFA;
        }
    </style>
</head>

<body>
    <div id="app">
        <table>
            <thead>
                <td><tr><th rowspan='4'><h1>快递批量下单系统</h1></th></tr></td>
                <tr>
                    <th><label for="cb-select-all">全选</label><input id="cb-select-all" type="checkbox"></th>
                    <th><span>姓名</span></th>
                    <th>地址</th>
                    <th>电话</th>
                    <th><input id="btn-export" type="button" value="下单"></th>
                </tr>
            </thead>
            <tbody id="the-list">
                <?php 
                    
                    $user = wp_get_current_user(); 
                    $customers = get_customer_list($user->user_login);
                    if(isset($customers)) {
                        foreach($customers as $custome) {
                            echo "<tr id='$custome->server_id'>
                            <td><input id='cb-select-$custome->server_id' type='checkbox'></td>
                            <th><span>$custome->name</span></th>
                            <th><span>$custome->address</span></th>
                            <th><span>$custome->phone</span></th>
                            <th></th>
                            </tr>\n";
                        } 
                    }
                   
                ?>
            </tbody>
        </table>
    </div>

    <script type="text/javascript" src="./js/framework7.min.js"></script>
</body>

</html>

