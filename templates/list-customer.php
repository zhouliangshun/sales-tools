<?php
include_once plugin_dir_path(__FILE__) . '../functions.php';
?>


<div id="wrap">

    <h1 class="wp-heading-inline"> <?= esc_html(get_admin_page_title()); ?> </h1>

    <hr class="wp-header-end">

    <div class="tablenav top">
        <div class="alignleft actions bulkactions">
            <a class="button action" href='javascript:onExport()'>快递下单</a>
        </div>

        <div class="alignleft actions">
            <a class="button action" href='javascript:onDelete("<?php $user = wp_get_current_user();
            echo esc_url(plugins_url('api/v1/customer/delete.php?user=', dirname(__FILE__))) . $user->user_login ?>")'>删除</a>
        </div>
    </div>

    <h2 class="screen-reader-text">客户列表</h2>

    <table class="wp-list-table widefat fixed striped posts">
        <thead>
        <tr>
            <td id="cb" class="manage-column column-cb check-column">
                <label class="screen-reader-text" for="cb-select-all">全选</label>
                <input id="cb-select-all" type="checkbox">
            </td>
            <th scope="col" id="author" class="manage-column column-author">姓名</th>
            <th scope="col" id="title" class="manage-column column-title column-primary">
                <span>地址</span>
            </th>
            <th scope="col" id="phone" class="manage-column column-phone">
                <span>电话</span>
            </th>
            <th scope="col" id="phone" class="manage-column column-score">
                <span>积分</span>
            </th>
            <th scope="col" id="phone" class="manage-column column-cons">
                <span>消费额</span>
            </th>
            <th scope="col" id="phone" class="manage-column column-actions">
                <span>操作</span>
            </th>
        </tr>
        </thead>
        <tbody id="the-list">
        <?php

        $user = wp_get_current_user();
        $customers = get_customer_list($user->user_login);
        if (isset($customers)) {
            foreach ($customers as $customer) {
                $edit_url = esc_url(plugins_url("api/v1/customer/update.php", dirname(__FILE__) . 'sales-tools'));
                echo "<tr id='$customer->server_id'>
                            <td><input id='cb-select-$customer->server_id' type='checkbox'></td>
                            <th class = 'manage-column column-author name' ><input  type='text' value='$customer->name' style='width: 100%;height: 100%;padding: 10px 10px;'/></th>
                            <th class = 'manage-column column-title column-primary address' ><input  type='text' value='$customer->address' style='width: 100%;height: 100%;padding: 10px 10px;'/></th>
                            <th class = 'manage-column column-phone phone'><input  type='text' style='width: 100%;height: 100%;padding: 10px 10px;' value='$customer->phone'/></th>
                            <th class = 'manage-column column-score score'><input  type='text' style='width: 80%;height: 100%;padding: 10px 10px;' value='$customer->score'/> <span>分</span></th>
                            <th class = 'manage-column column-cons amount'><input  type='text' style='width: 80%;height: 100%;padding: 10px 10px;' value='$customer->amount'/> <span>元</span></th>
                            <th class='manage-column column-actions'><a href='javascript:onUpdate($customer->server_id,\"$user->user_login\",\"$edit_url\")'>更新</a></th>
                          </tr>\n";
            }
        }

        ?>
        </tbody>
    </table>
    <textarea align="center" placeholder="如无法自动复制请手动复制" id="data-text" style="width: 0px;height: 0px"></textarea>
    <!--    <iframe id="iframe" src="http://op.yundasys.com/opserver/pages/addService/batch_send.html?openid=011jkgl60iv5CK18W3k600cyl60jkgll&appid=ydwechat" width="600" height="1067" style="display: none;position: fixed;top: 50%;left: 50%;transform: translate(-50%,-50%)"></iframe>-->
</div>

<script>


    function onExport() {
        var text = "";
        jQuery('#the-list tr td input:checked').each(function () {
            var dataContains = jQuery(this).closest('tr')[0];
            text += jQuery(dataContains).find('.name input').val();
            text += "," + jQuery(dataContains).find('.address input').val();
            text += "," + jQuery(dataContains).find('.phone input').val();
            text += ",化妆品;";
        });

        jQuery('#data-text').text(text);
        jQuery('#data-text').copyme();

        alert("已经复制到剪贴板！");

        window.open("http://op.yundasys.com/opserver/pages/addService/batch_send.html?openid=011jkgl60iv5CK18W3k600cyl60jkgll&appid=ydwechat", "韵达快递", "width=600,height=1000");
    };

    function onDelete(url) {
        let ids = new Array();
        jQuery('#the-list tr td input:checked').each(function () {
            ids.push(jQuery(this).attr("id").replace('cb-select-', ''))
        });
        jQuery.getJSON(url + "&ids=" + encodeURIComponent(ids.join()), function (result) {
            if (result['code'] == 200) {
                location.reload();
            }
        });
    };

    function onUpdate(id, user, url) {
        let tr = jQuery("#cb-select-" + id);
        let name = jQuery(tr).children('input.name').val();
        let address = jQuery(tr).children('input.address').val();
        let phone = jQuery(tr).children('input.phone').val();
        let score = jQuery(tr).children('input.score').val();
        let amount = jQuery(tr).children('input.amount').val();

        jQuery.getJSON(url, {
            'id': id,
            'user': user,
            'name': name,
            'address': address,
            'phone': phone,
            'score': score,
            'amount': amount
        }, function (result) {
            if (result['code'] == 200) {

            }
        });
    }

    jQuery(document).ready(function () {
        // 开始写 jQuery 代码...
        jQuery('#cb-select-all').click(function () {
            let isSelect = jQuery(this).is(":checked")
            if (isSelect) {
                jQuery('#the-list tr td input').attr('checked', true)
                jQuery('#label-seleect-all').text("取消全选");
            } else {
                jQuery('#the-list tr td input').removeAttr('checked');
                jQuery('#label-seleect-all').text("全选");
            }
        });

    });

</script>


