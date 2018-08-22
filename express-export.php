<?php
require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/wp-load.php');
require_once(dirname(__FILE__) . '/functions.php');
if (!is_user_logged_in()) {
    auth_redirect();
    exit;
}
?>

<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, viewport-fit=cover">
    <link rel="stylesheet" href="./css/framework7.min.css">
    <title>快递批量下单系统</title>
    <!-- <link rel="stylesheet" href="css/app.css"> -->

    <style type="text/css">
        table {
            border-collapse: collapse;
            margin: 0 auto;
            text-align: center;
        }

        table td, table th {
            border: 1px solid #cad9ea;
            color: #666;
            height: 30px;
        }

        table thead th {
            background-color: #CCE8EB;
            width: 100px;
        }

        table tr:nth-child(odd) {
            background: #fff;
        }

        table tr:nth-child(even) {
            background: #F5FAFA;
        }
    </style>
    <!-- <script type='text/javascript' src='../../../wp-includes/js/jquery/jquery.js?ver=1.12.4'></script> -->
    <script src="//libs.baidu.com/jquery/1.10.2/jquery.min.js"></script>
    <script src="https://www.jqueryscript.net/demo/Copy-Entire-Textarea-To-Clipboard-Using-jQuery-Copyme/copyme.js"></script>

</head>

<body>
<h3 align="center">快递批量下单系统</h3>
<div id="app">
    <table>
        <thead>
        <tr>
            <th><input id="cb-select-all" type="checkbox"><label for="cb-select-all" id='label-seleect-all'>全选</label>
            </th>
            <th><span>姓名</span></th>
            <th>地址</th>
            <th>电话</th>
            <th><a href='javascript:onExport()'>下单</a>|<a href='javascript:onDelete("<?php echo esc_url(plugins_url('api/v1/customer/delete', __FILE__.'sales-tools'))?>")'>删除</th>
        </tr>
        </thead>
        <tbody id="the-list">
        <?php

        $user = wp_get_current_user();
        $customers = get_customer_list($user->user_login);
        if (isset($customers)) {
            foreach ($customers as $customer) {
                echo "<tr id='$customer->server_id'>
                            <td><input id='cb-select-$customer->server_id' type='checkbox'></td>
                            <th class = 'name'><input  type='text' value='$customer->name'/></th>
                            <th class = 'address'><input  type='text' value='$customer->address'/></th>
                            <th class = 'phone'><input  type='text' value='$customer->phone'/></th>
                            <th></th>
                            </tr>\n";
            }
        }

        ?>
        </tbody>
    </table>
</div>
<textarea align="center" placeholder="如无法自动复制请手动复制" id="data-text"></textarea>
<script>


    function onExport() {
        var text = "";
        $('#the-list tr td input:checked').each(function () {
            var dataContains = $(this).closest('tr')[0];
            text += $(dataContains).find('.name input').val();
            text += "," + $(dataContains).find('.address input').val();
            text += "," + $(dataContains).find('.phone input').val();
            text += ",化妆品;";
        });

        $('#data-text').text(text);
        $('#data-text').copyme();

        alert("已经复制到剪贴板！");

        window.open("http://op.yundasys.com/opserver/pages/addService/batch_send.html?openid=011jkgl60iv5CK18W3k600cyl60jkgll&appid=ydwechat", "韵达快递", "width=600,height=1000");
    };

    function onDelete(url) {
        var ids = new Array();
        $('#the-list tr td input:checked').each(function () {
            ids.push($(this).attr("id"))
        });
        $.getJSON(url + "ids="+ids.join(),function(result){
            if(result['code'] == 200){
                location.reload();
            }
        });
    };

    $(document).ready(function () {
        // 开始写 jQuery 代码...
        $('#cb-select-all').click(function () {
            var isSelect = $(this).is(":checked")
            if (isSelect) {
                $('#the-list tr td input').attr('checked', true)
                $('#label-seleect-all').text("取消全选");
            } else {
                $('#the-list tr td input').removeAttr('checked');
                $('#label-seleect-all').text("全选");
            }
        });
        $('#btn-export').click(function () {
            var text = "";
            $('#the-list tr td input:checked').each(function () {
                var dataContains = $(this).closest('tr')[0];
                text += $(dataContains).find('.name input').val();
                text += "," + $(dataContains).find('.address input').val();
                text += "," + $(dataContains).find('.phone input').val();
                text += ",化妆品;";
            });

            $('#data-text').text(text);
            $('#data-text').copyme();

            alert("已经复制到剪贴板！");

            window.open("http://op.yundasys.com/opserver/pages/addService/batch_send.html?openid=011jkgl60iv5CK18W3k600cyl60jkgll&appid=ydwechat", "韵达快递", "width=600,height=1000");
        });
        $('#btn-delete').click(function (url) {
            var ids = new Array();
            $('#the-list tr td input:checked').each(function () {
                ids.push($(this).attr("id"))
            });
            $.getJSON(url + "ids="+ids.join(),function(result){
                if(result['code'] == 200){
                    location.reload();
                }
            });
        });

    });





</script>

</body>

</html>

