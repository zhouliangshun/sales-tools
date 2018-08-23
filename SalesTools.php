<?php 

/**
 * @package SalesTools(销售助手)
 * @version 1.0
 */


/*
Plugin Name: 销售助手
Plugin URI: https://github.com/zhouliangshun/sales-tools
Description: 在为销售助手提供备份功能
Author: Liangshun Zhou
Version: 1.0
Author URI: http://www.kylins.com
*/

require_once(dirname(dirname(dirname(dirname(__FILE__)))). '/wp-config.php' );
require_once(dirname(dirname(dirname(dirname(__FILE__)))). '/wp-admin/includes/upgrade.php' );

register_activation_hook( __FILE__, array( 'SalesTools', 'plugin_activation' ) );
register_deactivation_hook( __FILE__, array( 'SalesTools', 'plugin_deactivation' ) );



$salesToos = new SalesTools();

class SalesTools {

    public function __Construct()
	{
        //menus
        add_action( "admin_init", array($this, 'add__admin_init') );
        add_action( 'admin_menu', array($this, 'add__admin_menu'));

    }

    public static function plugin_activation(){
        global $table_prefix,$wpdb;

        //$rawQuery =  file_get_contents(dirname(__FILE__).'/assets/sql/install.sql');
        //$rawQuery = str_replace('[PREFIX]', $table_prefix, $rawQuery);
        //$rawQuery = explode(';', $rawQuery);
        //$querys = array();
        $table_name = $table_prefix."record_describe";
        $query = "CREATE TABLE IF NOT EXISTS `$table_name` (
            `id` INT NOT NULL AUTO_INCREMENT,
            `title` VARCHAR(45) NULL COMMENT '记录标题',
            `create_date` DATETIME NULL COMMENT '创建日期',
            `local_id` INT NULL,
            `user` VARCHAR(30) NULL,
            `update_date` INT NOT NULL DEFAULT 0,
            PRIMARY KEY (`id`));";
        dbDelta($query);
        
        $table_name = $table_prefix."customer";
        $query = "CREATE TABLE IF NOT EXISTS `$table_name` (
            `id` INT NOT NULL AUTO_INCREMENT,
            `address` VARCHAR(45) NULL COMMENT '地址',
            `birthday` VARCHAR(45) NULL COMMENT '生日日期',
            `name` VARCHAR(45) NULL COMMENT '姓名',
            `phone` VARCHAR(45) NULL COMMENT '联系电话',
            `wechat` VARCHAR(45) NULL COMMENT '微信号',
            `amount` FLOAT NULL COMMENT '消费总额',
            `score` INT NULL COMMENT '积分',
            `local_id` INT NULL,
            `user` VARCHAR(30) NULL,
            `update_date` INT NOT NULL DEFAULT 0,
            PRIMARY KEY (`id`));";
        dbDelta($query);
        
        $table_name = $table_prefix."goods";
        $query = "CREATE TABLE IF NOT EXISTS `$table_name` (
            `id` INT NOT NULL AUTO_INCREMENT,
            `count` VARCHAR(45) NULL,
            `name` VARCHAR(45) NULL,
            `purchase_price` FLOAT NULL COMMENT '进价',
            `sell_price` FLOAT NULL COMMENT '卖价',
            `spec` VARCHAR(45) NULL,
            `comments` VARCHAR(200) NULL COMMENT '备注',
            `local_id` INT NULL,
            `country` VARCHAR(45) NULL,
            `user` VARCHAR(30) NULL,
            `update_date` INT NOT NULL DEFAULT 0,
            PRIMARY KEY (`id`));";
        dbDelta($query);

        $table_name = $table_prefix."sale_record";
        $query = "CREATE TABLE IF NOT EXISTS `$table_name` (
            `id` INT NOT NULL AUTO_INCREMENT,
            `count` INT NULL COMMENT '库存数量',
            `goods` VARCHAR(45) NULL COMMENT '商品名字',
            `purchase_price` FLOAT NULL COMMENT '进价',
            `sell_price` FLOAT NULL COMMENT '卖价',
            `purchaser` VARCHAR(45) NULL COMMENT '买家',
            `pid` INT NOT NULL COMMENT '销售记录id',
            `spec` VARCHAR(45) NULL COMMENT '商品规格',
            `local_id` INT NULL,
            `user` VARCHAR(30) NULL,
            `update_date` INT NOT NULL DEFAULT 0,
            PRIMARY KEY (`id`));";
        dbDelta($query);

        $table_name = $table_prefix."paid_flag";
        $query = "CREATE TABLE IF NOT EXISTS `$table_name` (
            `id` INT NOT NULL AUTO_INCREMENT,
            `purchaser` VARCHAR(45) NULL COMMENT '买家',
            `flag` TINYINT(1) NULL COMMENT '是否支付',
            `record_id` INT NOT NULL COMMENT '销售记录id',
            `score` INT NULL COMMENT '使用的积分',
            `amount` FLOAT NULL COMMENT '总金额',
            `date` DATETIME NULL COMMENT '支付日期',
            `local_id` INT NULL,
            `user` VARCHAR(30) NULL,
            `update_date` INT NOT NULL DEFAULT 0,
            PRIMARY KEY (`id`));";
        dbDelta($query);

        $table_name = $table_prefix."goods_pics";
        $query = "CREATE TABLE IF NOT EXISTS `$table_name` (
            `id` INT NOT NULL AUTO_INCREMENT,
            `local_url` VARCHAR(45) NULL COMMENT '本地地址',
            `url` VARCHAR(45) NULL COMMENT '服务器地址',
            `sync` TINYINT(1) NULL COMMENT '是否同步',
            `goods_id` INT NOT NULL,
            `local_id` INT NULL,
            `user` VARCHAR(30) NULL,
            `update_date` INT NOT NULL DEFAULT 0,
            PRIMARY KEY (`id`));";
        dbDelta($query);

        $table_name = $table_prefix."sync_timestamp";
        $query = "CREATE TABLE IF NOT EXISTS `$table_name` (
            `id` INT NOT NULL AUTO_INCREMENT,
            `last_time` BIGINT NULL,
            `user` VARCHAR(30) NULL,
            PRIMARY KEY (`id`));";
        dbDelta($query);

        $table_name = $table_prefix."delete_record";
        $query = "CREATE TABLE IF NOT EXISTS `$table_name` (
            `id` INT NOT NULL AUTO_INCREMENT,
            `table_name` VARCHAR(45) NOT NULL,
            `record_id` INT NOT NULL,
            `user` VARCHAR(30) NULL,
            PRIMARY KEY (`id`));";

        dbDelta($query);
    }

    public static function plugin_deactivation()
    {
        global $table_prefix, $wpdb;
        
        // $rawQuery =  file_get_contents(dirname(__FILE__).'/assets/sql/uninstall.sql');
        $rawQuery = "DROP TABLE IF EXISTS [PREFIX]record_describe, 
        [PREFIX]customer,
        [PREFIX]goods,
        [PREFIX]sale_record,
        [PREFIX]paid_flag,
        [PREFIX]goods_pics,
        [PREFIX]sync_timestamp,
        [PREFIX]delete_record;";
        $rawQuery =  str_replace('[PREFIX]', $table_prefix, $rawQuery);
        $wpdb->query($rawQuery);
    }



    public function add__admin_init() {


    }



    public function add__admin_menu(){
        
        add_menu_page( '销售记录', '销售助手', 'manage_options',  'sales-tools', array($this, 'display_record_list')  ,'',20);

        add_submenu_page( 'sales-tools', '客户管理' , '客户管理', 'manage_options', 'sales-customers',  array($this, 'display_custome_list'));
        add_submenu_page( 'sales-tools', '商品管理',  '商品管理', 'manage_options', 'sales-goods',  array($this, 'display_goods_list'));
    }


    public function display_record_list(){
        wp_enqueue_style( 'list_css' ,CSS . "list.css");//css
		load_template(dirname( __FILE__ ) . '/templates/list-record.php');
    }
    
    public function display_custome_list(){
		load_template(dirname( __FILE__ ) . '/templates/list-customer.php');
    }
    
    public function display_goods_list(){
        load_template(dirname( __FILE__ ) . '/templates/list-goods.php');
	}
    



}
