<?php
include_once plugin_dir_path(__FILE__) . '../functions.php';
?>


<div id="wrap">

    <h1 class="wp-heading-inline"> <?= esc_html(get_admin_page_title()); ?> </h1>

    <hr class="wp-header-end">

    <div class="tablenav top">

        <div class="alignleft actions">
            <a class="button action" href='javascript:onDelete("<?php $user = wp_get_current_user();
            echo esc_url(plugins_url('api/v1/record/delete.php?user=', dirname(__FILE__))) . $user->user_login ?>")'>删除</a>
        </div>
    </div>

    <h2 class="screen-reader-text">销售列表</h2>

    <table class="wp-list-table widefat fixed striped posts">
        <thead>
        <tr>
            <td id="cb" class="manage-column column-cb check-column">
                <label class="screen-reader-text" for="cb-select-all">全选</label>
                <input id="cb-select-all" type="checkbox">
            </td>
            <th scope="col" id="author" class="manage-column column-title column-primary">标题</th>
            <th scope="col" id="title" class="manage-column column-cost ">
                <span>成本</span>
            </th>
            <th scope="col" id="phone" class="manage-column column-sales">
                <span>销售额</span>
            </th>
            <th scope="col" id="phone" class="manage-column column-profit">
                <span>盈利额</span>
            </th>
            <th scope="col" id="phone" class="manage-column column-date">
                <span>时间</span>
            </th>
            <th scope="col" id="phone" class="manage-column column-actions">
                <span>操作</span>
            </th>
        </tr>
        </thead>
        <tbody id="the-list">
        <?php

        $user = wp_get_current_user();
        $records = get_describe_list($user->user_login);
        if (isset($records)) {
            foreach ($records as $record) {
                $edit_url = esc_url(plugins_url("api/v1/record/update.php", dirname(__FILE__) . 'sales-tools'));
                echo "<tr id='$record->id'>
                            <td><input id='cb-select-$record->id' type='checkbox'></td>
                            <th class = 'manage-column column-title column-primary title' ><input  type='text' value='$record->title' style='width: 100%;height: 100%;padding: 10px 10px;'/></th>
                            <th class = 'manage-column column-cost cost' >$record->cost <span> 元</span></th>
                            <th class = 'manage-column column-sales sales'>$record->sales <span> 元</span></th>
                            <th class = 'manage-column column-profit profit'>$record->profit <span> 元</span></th>
                            <th class = 'manage-column column-date date'>$record->create_date</th>
                            <th class='manage-column column-actions'><a href='javascript:onUpdate($record->id,\"$user->user_login\",\"$edit_url\")'>更新</a></th>
                          </tr>\n";
            }
        }

        ?>
        </tbody>
    </table>
</div>

<script>


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
        let tr = jQuery("#"+id)[0];
        let name = jQuery(tr).find('.name input').val();
        let address = jQuery(tr).find('.address input').val();
        let phone = jQuery(tr).find('.phone input').val();
        let score = jQuery(tr).find('.score input').val();
        let amount = jQuery(tr).find('.amount input').val();

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


