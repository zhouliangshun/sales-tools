<?php
include_once plugin_dir_path(__FILE__) . '../functions.php';
?>


<div id="wrap">

    <h1 class="wp-heading-inline"> <?= esc_html(get_admin_page_title()); ?> </h1>
    <a href='javascript:onExport()'>下单</a>|
    <a href='javascript:onDelete("<?php $user = wp_get_current_user();
    echo esc_url(plugins_url('api/v1/customer/delete.php?user=', __FILE__ . 'sales-tools')) . $user->user_login ?>")'>删除
        <table class="wp-list-table widefat fixed striped posts">
            <thead>
            <tr>
                <td id="cb" class="manage-column column-cb check-column"><label class="screen-reader-text" for="cb-select-all-1">全选</label><inputid="cb-select-all" type="checkbox"></td>
                <th scope="col" id="title" class="manage-column column-title column-primary sortable desc">
                        <span>姓名</span><spanclass="sorting-indicator"></span>
                </th>
                <th scope="col" id="author" class="manage-column column-author">地址</th>
                <th scope="col" id="phone" class="manage-column column-date sortable asc">
                    <span>电话</span><span class="sorting-indicator"></span></a>
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
                            <th class = 'name'><input  type='text' value='$customer->name'/></th>
                            <th class = 'address'><input  type='text' value='$customer->address'/></th>
                            <th class = 'phone'><input  type='text' value='$customer->phone'/></th>
                            <th>\n";
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
            ids.push($(this).attr("id").replace('cb-select-', ''))
        });
        $.getJSON(url + "&ids=" + encodeURIComponent(ids.join()), function (result) {
            if (result['code'] == 200) {
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

    });

</script>


