<?php
namespace Model;
require_once 'Product.php';
use Model\Product;

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
    private $total_price = 0;
    private $total_discount_fee = 0;
    private $total_minus_fee = 0;

    public function setItems($items)
    {
        foreach($items as $value){
            $product = new Product();
            $product->setProductByNo($value->product);
            $product->number = $value->amount;
            array_push($this->items,$product);
        }
    }

    /**
     * 设置订单优惠券种类
     * @param $val
     */
    public function setDiscount($val){
        //没有设置成固定1
        $this->discount = $val;
    }

    /**
     * 计算总金额
     *
     */
    public function calAmountList(){
        //计算金额
        $total_price = 0;
        $data = [];
        foreach($this->items as $item){
            $item = (array)$item;
            $price = 0;
            $price += $item['price'] * $item['number'];
            $item = [
                'no' => $item['no'],
                'name' => $item['name'],
                'number' => $item['number'],
                'price' => $item['price'],
                'total_price' => $price
            ];
            $total_price += $price;
            array_push($data,$item);
        }
        $this->total_price = $total_price;
        return ['total_price'=>$total_price,'data'=>$data];
    }

    /**
     * 计算开门红优惠清单
     * @return array
     */
    public function minusFeeList(){
        $data = [];
        $total_minus_fee= 0;
        foreach ($this->items as $item) {
            $item = (array)$item;
            $product = new Product();
            $product->number = $item['number'];
            $product->setAllByNo($item['no']);
            if(!empty($this->discount)){
                $product->use_discount= $this->discount;
            }
            $product->getDiscountMoney();
            if(!empty($product->minu_fee) && $product->minu_fee != 0){
                $item['no'] = $product->no;
                $item['name'] = $product->name;
                $item['minus_fee'] = $product->minu_fee;
                $total_minus_fee += $item['minus_fee'];
                array_push ($data,$item);
            }
        }
        $this->total_minus_fee = $total_minus_fee;
        return ['total_minus_fee'=>$total_minus_fee,'data'=>$data];
    }
    /**
     * 折扣优惠清单
     *
     */
    public function discountFeeList(){
        $data = [];
        $total_discount_fee = 0;
        foreach ($this->items as $item) {
            $item = (array)$item;
            $product = new Product();
            $product->number = $item['number'];
            $product->setAllByNo($item['no']);
            if(!empty($this->discount)){
                $product->use_discount= $this->discount;
            }
            $product->getDiscountMoney();
            if(!empty($product->discount_money) && $product->discount_money != 0 ){
                $item['no'] = $product->no;
                $item['name'] = $product->name;
                $item['discount_money'] = $product->discount_money;
                $total_discount_fee += $item['discount_money'];
                array_push ($data,$item);
            }
        }
        $this->total_discount_fee = $total_discount_fee;
        return ['total_discount_fee'=>$total_discount_fee,'data'=>$data];

    }
    /**
     * 合计金额
     *
     */
    public function payFee(){
        return $this->total_price - $this->total_minus_fee - $this->total_discount_fee ;
    }
}