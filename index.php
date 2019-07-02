<?php
/**
 * Created by PhpStorm.
 * User: alloyer
 * Date: 2019/7/2
 * Time: 16:17
 */

require_once 'Model/Product.php';
require_once 'Model/Order.php';
require_once 'Model/VipUser.php';
//require 'Model/SaleType.php';
use Model\Product;
use Model\Order;
use Model\SaleType;
use Model\VipUser;

class Index {

    public function order(){

       $product = new Product();

       //读取json 文件
        $json = file_get_contents('test/sample_command.json');
        $info = json_decode($json);
        $order = new Order();
        $order->setItems($info->items);
//        print_r($order);


        $discount = $info->discountCards;
        $sale_type = new SaleType();
        $discounts = $sale_type->getDiscountsByNames($discount); //获取优惠
        $order->setDiscount($discounts); // 设置优惠券
        $total_price = $order->calAmountList();
        $total_minus_fess = $order->minusFeeList();
        $total_discount = $order->discountFeeList();
        $total_discount = $order->payFee();

        $member = new VipUser();
        
        print_r($total_discount);

        $string = '';
        //输出txt文件


    }




}

$output = new Index();
$output->order();