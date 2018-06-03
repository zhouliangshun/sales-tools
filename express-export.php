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
    <!-- <script type='text/javascript' src='../../../wp-includes/js/jquery/jquery.js?ver=1.12.4'></script> -->
    <script src="//libs.baidu.com/jquery/1.10.2/jquery.min.js"></script>
   
</head>

<body>
    <h3 align="center">快递批量下单系统</h3>  
    <div id="app">
        <table>
            <thead>
                <tr>
                    <th><input id="cb-select-all" type="checkbox"><label for="cb-select-all" id='label-seleect-all'>全选</label></th>
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
                            <th class = 'name'><p>$custome->name</p></th>
                            <th class = 'address'><p>$custome->address</p></th>
                            <th class = 'phone'><p>$custome->phone</p></th>
                            <th></th>
                            </tr>\n";
                        } 
                    }
                   
                ?>
            </tbody>
        </table>
    </div>

    <script type="text/javascript" src="./js/framework7.min.js"></script>
    <script>

        $(document).ready(function(){
            // 开始写 jQuery 代码...
            $('#cb-select-all').click(function(){
                var isSelect = $this.is(":checked")
                if(isSelect) {
                    $('#the-list tr td input').attr('checked','checked')
                    $('#label-seleect-all').val("取消全选");
                }else {
                    $('#the-list tr td input').removeAttr('checked');
                    $('#label-seleect-all').val("全选");
                }
            });
            $('#btn-export').click(function(){
                var text  = "";
                $('#the-list tr td input[checked]').each(function () {
                var dataContains =  $this.parent.parent;
                text += dataContains.children('.name:first p:first').val();
                text += ","+dataContains.children('.address:first p:first').val();
                text += ","+dataContains.children('.phone:first p:first').val();
                text += ",化妆品;";
                });

                Copied = text.createTextRange();
                Copied.execCommand("Copy");
                alert("已经复制到剪贴板！");
                window.open("http://op.yundasys.com/opserver/pages/addService/batch_send.html?openid=011jkgl60iv5CK18W3k600cyl60jkgll&appid=ydwechat", "韵达快递", "width=240,height=600");
            });

    }); 

    </script>
   
</body>

</html>

