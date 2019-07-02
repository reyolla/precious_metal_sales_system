<?php
/**
 * Created by PhpStorm.
 * User: alloyer
 * Date: 2019/7/2
 * Time: 16:17
 */
namespace order;

require 'Model/Product.php';

use Model\Order;
use Model\Product;

class Index {

    public function index(){

       $product = new Product();
//       print_r($product::PRODUCT);

       //读取json 文件
        $json = file_get_contents('test/sample_command.json');
//        print_r($json);
        $info = json_decode($json);
        $order = new Order();
        $order->setItems($info);;
        $total_price = $order->calAmount();

        $member =


        print_r($info->orderId);

        //输出txt文件


    }




}

$output = new Index();
$output->index();