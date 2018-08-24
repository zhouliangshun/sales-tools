<?php
include_once plugin_dir_path(__FILE__) . '../functions.php';
?>


<div id="wrap">

    <h1 class="wp-heading-inline"> <?= esc_html(get_admin_page_title()); ?> </h1>

    <hr class="wp-header-end">

    <div class="tablenav top">

        <div class="alignleft actions">
            <a class="button action" href='javascript:onDelete("<?php $user = wp_get_current_user();
            echo esc_url(plugins_url('api/v1/goods/delete.php?user=', dirname(__FILE__))) . $user->user_login ?>")'>删除</a>
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
            <th scope="col" id="title" class="manage-column column-title">名称</th>
            <th scope="col" id="area" class="manage-column column-area">
                <span>地区</span>
            </th>
            <th scope="col" id="spec" class="manage-column column-spec">
                <span>规格</span>
            </th>
            <th scope="col" id="price" class="manage-column column-price">
                <span>售价</span>
            </th>
            <th scope="col" id="buy" class="manage-column column-price">
                <span>进价</span>
            </th>
            <th scope="col" id="count" class="manage-column column-count">
                <span>库存</span>
            </th>
            <th scope="col" id="note" class="manage-column column-primary column-note">
                <span>备注</span>
            </th>
            <th scope="col" id="count" class="manage-column column-count">
                <span>销量</span>
            </th>
            <th scope="col" id="actions" class="manage-column column-actions">
                <span>操作</span>
            </th>
        </tr>
        </thead>
        <tbody id="the-list">
        <?php

        $user = wp_get_current_user();
        $goodsList = get_goods_list($user->user_login);
        if (isset($goodsList)) {
            foreach ($goodsList as $goods) {
                $edit_url = esc_url(plugins_url("api/v1/goods/update.php", dirname(__FILE__) . 'sales-tools'));
                echo "<tr id='$goods->id'>
                            <td><input id='cb-select-$goods->id' type='checkbox'></td>
                            <th class = 'manage-column column-title title' ><input  type='text' value='$goods->name' style='width: 100%;height: 100%;padding: 10px 10px;'/></th>
                            <th class = 'manage-column column-area area' ><input  type='text' value='$goods->country' style='width: 100%;height: 100%;padding: 10px 10px;'/></th>
                            <th class = 'manage-column column-spec spec' ><input  type='text' value='$goods->spec' style='width: 100%;height: 100%;padding: 10px 10px;'/></th>
                            <th class = 'manage-column column-price price' ><input  type='text' value='$goods->sell_price' style='width: 100%;height: 100%;padding: 10px 10px;'/></th>
                            <th class = 'manage-column column-price buy'><input  type='text' style='width: 100%;height: 100%;padding: 10px 10px;' value='$goods->purchase_price'/>元</th>
                            <th class = 'manage-column column-count count'><input  type='text' style='width: 80%;height: 100%;padding: 10px 10px;' value='$goods->count'/>元</th>
                            <th class = 'manage-column column-note  column-primary note'><input  type='text' style='width: 80%;height: 100%;padding: 10px 10px;' value='$goods->comments'/></th>
                            <th class = 'manage-column column-count'><span>$goods->sell_count 件 </span></th>
                            <th class='manage-column column-actions'><a href='javascript:onUpdate($goods->id,\"$user->user_login\",\"$edit_url\")'>更新</a></th>
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
        let name = jQuery(tr).find('.title input').val();
        let country = jQuery(tr).find('.area input').val();
        let spec = jQuery(tr).find('.spec input').val();
        let sellPrice = jQuery(tr).find('.score input').val();
        let purchasePrice = jQuery(tr).find('.buy input').val();
        let count = jQuery(tr).find('.count input').val();
        let comments = jQuery(tr).find('.note input').val();

        jQuery.getJSON(url, {
            'id': id,
            'user': user,
            'name': name,
            'country': country,
            'count': count,
            'spec': spec,
            'sell_price': sellPrice,
            'purchase_price':purchasePrice,
            'comments':comments
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


