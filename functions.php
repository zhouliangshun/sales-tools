<?php
require_once(dirname(dirname(dirname(dirname(__FILE__)))). '/wp-config.php' );
require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/wp-blog-header.php');


/**
 * 获取wordpress table name
 */
function get_wp_table_name($table_name){
    global $table_prefix;
    return $table_prefix.$table_name;
}

/**
 * 获取最新更新的销售记录，如果last_time == -1，返回所有记录
 */
function get_update_record_describe_list($user, $last_time){
    global $wpdb;
    $table_name = get_wp_table_name('record_describe');
    $query_str = "SELECT id AS server_id, local_id AS id, title, create_date FROM $table_name WHERE update_date > $last_time AND user = '$user'";
    $result = $wpdb->get_results($query_str);
    return $result;
}


/**
 * 获取最新更新的商品销售记录，如果last_time == -1，返回所有记录
 */
function get_update_sale_record_list($user, $last_time){
    global $wpdb;
    $table_name = get_wp_table_name('sale_record');
    $query_str = "SELECT id AS server_id, local_id AS id, pid, purchaser, goods, spec, purchase_price, sell_price, count FROM $table_name WHERE update_date > $last_time AND user = '$user'";
    $result = $wpdb->get_results($query_str);
    return $result;
}

/**
 * 获取某个人每次购买记录
 */
function get_sale_record_list($user, $record, $name){
    global $wpdb;
    $table_name = get_wp_table_name('sale_record');
    $query_str = "SELECT id, goods, spec, sell_price AS price, count FROM $table_name WHERE pid = $record AND user = '$user' AND purchaser = '$name' GROUP BY goods";
    $result = $wpdb->get_results($query_str);
    return $result;
}

/**
 * 获取最新更新客户信息，如果last_time == -1，返回所有记录
 */
function get_update_customer_list($user, $last_time){
    global $wpdb;
    $table_name = get_wp_table_name('customer');
    $query_str = "SELECT id AS server_id, local_id AS id, name, phone, address, wechat, birthday, amount, score FROM $table_name WHERE update_date > $last_time AND user = '$user'";
    $result = $wpdb->get_results($query_str);
    return $result;
}

/**
 * 获取用户的客户列表
 */
function get_customer_list($user){
    global $wpdb;
    $table_name = get_wp_table_name('customer');
    $query_str = "SELECT id AS server_id, local_id AS id, name, phone, address, wechat, birthday, amount, score FROM $table_name WHERE user = '$user'";
    $result = $wpdb->get_results($query_str);
    return $result;
}


/**
 * 获取最新更新商品信息，如果last_time == -1，返回所有记录
 */
function get_update_goods_list($user, $last_time){
    global $wpdb;
    $table_name = get_wp_table_name('goods');
    $query_str = "SELECT id AS server_id, local_id AS id, name, purchase_price, sell_price, country, spec, comments, count FROM $table_name WHERE update_date > $last_time AND user = '$user'";
    $result = $wpdb->get_results($query_str);
    return $result;
}

/**
 * 获取最新更新支付信息，如果last_time == -1，返回所有记录
 */
function get_update_paid_list($user, $last_time){
    global $wpdb;
    $table_name = get_wp_table_name('paid_flag');
    $query_str = "SELECT id AS server_id, local_id AS id, purchaser, record_id, flag, amount, score FROM $table_name  WHERE update_date > $last_time AND user = '$user'";
    $result = $wpdb->get_results($query_str);
    return $result;
}

/**
 * 获取最新更新支付信息，如果last_time == -1，返回所有记录
 */
function get_update_goods_pics_list($user, $last_time){
    global $wpdb;
    $table_name = get_wp_table_name('goods_pics');
    $query_str = "SELECT id AS server_id, local_id AS id, local_url, url, sync, goods_id FROM $table_name WHERE update_date > $last_time AND user = '$user'";
    $result = $wpdb->get_results($query_str);
    return $result;
}

/**
 * 获取所有删除的ids
 */
function get_delete_ids($user){
    global $wpdb;
    $table_name = get_wp_table_name('delete_record');
    $query_str = "SELECT table_name, record_id AS id FROM $table_name WHERE user = '$user'";
    $result = $wpdb->get_results($query_str);
    return $result;
}

/**
 * 清除所有删除记录
 */
function clear_delete_ids($user){
    //clear delete
    global $wpdb;
    $wpdb->delete(get_wp_table_name('delete_record'),array('user'=>$user));
}

/**
 * 获取最后一次服务同步本地数据时间
 */
function get_last_sync_time($user){
    global $wpdb;
    $table_name = get_wp_table_name('sync_timestamp');
    $last_time =  $wpdb->get_results("SELECT last_time FROM $table_name WHERE user = '$user'");
    if($last_time){
        return $last_time[0]->last_time;
    }else{
        return $data['last_sync_time'] = -1;
    }
}

/**
 * 更新最后一次服务同步本地数据时间
 */
function update_last_sync_time($user, $last_time){
    global $wpdb;
    
    $table_name = get_wp_table_name('sync_timestamp');
    $id =  $wpdb->get_results("SELECT id from $table_name where user = '$user'");
    if($id){
        $wpdb->update($table_name , array('last_time'=>$last_time), array('id'=>$id[0]->id));
    }else{
        $wpdb->insert($table_name , array('last_time'=>$last_time,'user'=>$user));
    }
}

/**
 * 更新数据
 */
function update_data($table_name, $data, $user){

    if(isset($data)){

        global $wpdb;
        
            $wp_table_name = get_wp_table_name($table_name);
            $newId = array();
            foreach($data as $describe){
                //modify data server_id to id id to local_id
                $describe['local_id'] = $describe['id'];
                $describe['id'] = $describe['server_id'];
                unset($describe['server_id']);
            
                //if exits update or insert
               if(!($describe['id'] != 0 && 
                    $wpdb->update($wp_table_name, $describe, array('id'=>$describe['id'],'user'=>$user))))
             {
                   //inser
                   $describe['user'] = $user;
                   unset($describe['id']);
                   $wpdb->insert($wp_table_name, $describe);
               
                   $local_id = $describe['local_id'];
                   $id = $wpdb->get_results("SELECT id FROM $wp_table_name WHERE local_id=$local_id AND user ='$user'");
                   if($id){
                       $newId[]= array('id'=>$id[0]->id,'local_id'=>$describe['local_id']);
                   }
                   
               }
            }
            return $newId;
    }

    
}

function delete_data($table_name, $id){

    if(isset($id)){
        global $wpdb;
        $wp_table_name = get_wp_table_name($table_name);
        $wpdb->delete($wp_table_name, array('id'=>$id));
    }

    
}

function delete_data_server($table_name, $ids,$user){
    $_ids = [];
    if(is_string($ids)){
        $_ids[] = $ids;
    }else if(is_array($ids)){
        $_ids = $ids;
    }

    global $wpdb;
    foreach ($_ids as $id){

        if(!$id){
            continue;
        }

        $wp_table_name = get_wp_table_name($table_name);
        $result = $wpdb->get_results("SELECT local_id FROM $wp_table_name WHERE id = '$id' AND user = '$user'");
        if(!$result){
            continue;
        }
        $wpdb->delete($wp_table_name, array('id'=>$id));
        if($result[0]->local_id) {
            $wp_table_name = get_wp_table_name('delete_record');
            $wpdb->insert($table_name,['table_name'=>$wp_table_name,'record_id'=>$result[0]->local_id,'user'=>$user]);
        }
    }

}

/**
 * 更新本地数据id
 */
function update_local_id($table_name, $data, $user){

    if(!isset($data)){
        global $wpdb;
        
            $wp_table_name = get_wp_table_name($table_name);
            //update local_id
            if(isset($data)){
                foreach($data as $newId){
                    $wpdb->update($wp_table_name, array('local_id'=>$newId['local_id']) ,array('id'=> $newId['id']));
                }
            }
    }
}

/**
 * 获取物品信息
 */
function get_goods_info($id, $user){
    global $wpdb;
    $wp_table_name = get_wp_table_name('goods');
    $goodses =  $wpdb->get_results("SELECT name ,spec ,sell_price ,comments FROM $wp_table_name WHERE user = '$user' AND id = $id");
    if($goodses){
        return $goodses[0];
    }
}

/**
 * 获取物品全部信息
 */
function get_goods_full_info($id, $user){
    global $wpdb;
    $wp_table_name = get_wp_table_name('goods');
    $goodses =  $wpdb->get_results("SELECT * FROM $wp_table_name WHERE user = '$user' AND id = $id");
    if($goodses){
        return $goodses[0];
    }
}

/**
 * 获取记录信息
 */
function get_record_info($id, $user){
    global $wpdb;
    $wp_table_name = get_wp_table_name('record_describe');
    $records =  $wpdb->get_results("SELECT * FROM $wp_table_name WHERE user = '$user' AND id = $id");
    if($records){
        return $records[0];
    }
}


function add_sale_record($record, $goods, $count, $purchaser, $phone, $user){
    global $wpdb;
    $table_name = get_wp_table_name('sale_record');
    $goods_name = $goods->name;
    $query_str = "SELECT * FROM $table_name WHERE pid = $record AND user = '$user' AND goods = '$goods_name' AND purchaser = '$purchaser'";
    $result = $wpdb->get_results($query_str);
    if($result){
        $count += $result[0]->count;
       return $wpdb->update($table_name, array('count'=>$count,'update_date' => time()), array('id'=> $result[0]->id));
    }else{

        //检查客户是否存在
        add_custom_ifnot_exist($purchaser, $phone, $user);

        return $wpdb->insert($table_name, array('count'=>$count,
                                         'user'=>$user,
                                        'goods'=>$goods_name,
                                        'purchaser' => $purchaser,
                                        'sell_price' => $goods->sell_price,
                                        'purchase_price' => $goods->sell_price,
                                        'pid' => $record,
                                        'update_date' => time()));
    }
}

function add_custom_ifnot_exist($purchaser, $phone,  $user){
    global $wpdb;
    $table_name = get_wp_table_name('customer');
    $query_str = "SELECT id  FROM $table_name WHERE phone = '$phone' AND user = '$user'";
    $result = $wpdb->get_results($query_str);
    if(!$result){
        $wpdb->insert($table_name, array('user'=>$user,'phone'=>$phone,'name' => $purchaser,'update_date' => time()));
    }
}



?>