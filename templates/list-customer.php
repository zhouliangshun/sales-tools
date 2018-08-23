<?php
include_once plugin_dir_path(__FILE__) . '../functions.php';
?>


<div id="wrap">

    <h1 class="wp-heading-inline"> <?= esc_html(get_admin_page_title()); ?> </h1>
    <a class="page-title-action" href='javascript:onExport()'>下单</a>|
    <a class="page-title-action" href='javascript:onDelete("<?php $user = wp_get_current_user();
    echo esc_url(plugins_url('api/v1/customer/delete.php?user=', __FILE__ . 'sales-tools')) . $user->user_login ?>")'>删除</a>
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
                            <th class = 'manage-column column-author name' ><input  type='text' value='$customer->name' style='width: 100%;height: 100%;padding: 10px 10px;'/></th>
                            <th class = 'manage-column column-title column-primary' ><input  type='text' value='$customer->address' style='width: 100%;height: 100%;padding: 10px 10px;'/></th>
                            <th class = 'manage-column column-phone phone'><input  type='text' style='width: 100%;height: 100%;padding: 10px 10px;' value='$customer->phone'/></th>
                          </tr>\n";
            }
        }

        ?>
        </tbody>
    </table>
    <textarea align="center" placeholder="如无法自动复制请手动复制" id="data-text" style="display: none"></textarea>
</div>

<script>


    function onExport() {
        var text = "";
        jQuery('#the-list tr td input:checked').each(function () {
            var dataContains = $(this).closest('tr')[0];
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


