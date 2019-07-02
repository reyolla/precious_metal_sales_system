<?php
namespace Model;
require 'Product.php';
/**
 * Created by PhpStorm.
 * User: alloyer
 * Date: 2019/7/2
 * Time: 16:18
 */
class Order{

    private $items = [];
    private $discount;
    private $ratio;

    public function setItems($items)
    {
        foreach($items as $value){
            $product = new Product();
            $product = $product->getProductByNo($value->product);
            $product['number'] = $value->amount;
            array_push($this->items,$product);
        }
    }

    public function setDiscount($val){
        //没有设置成固定1
        $this->discount = $val;
    }

    public function calAmount(){
        //计算金额
        $total_prace = 0;
        foreach($this->items as $item){
//            $item[]
            $price = 0;
            $price += $item['price'] * $item['number'];
            in_array($this->discount,$item['discount']) && $price = $price * $this->ratio;
            //
            $total_prace += $price;
        }

        return $total_prace;
    }
}