<?php
namespace Model;
/**
 * Created by PhpStorm.
 * User: alloyer
 * Date: 2019/7/2
 * Time: 16:20
 */
class Product{
    /**
     * 所有商品
     * @var array
     */
    public $name;  //商品名
    public $no;    //商品编号
    public $unit;  //商品单位
    public $price; //商品价格

    public $discount; //折扣券
    public $number;   //数量



    const PRODUCT = [
        '001001'=> [
            'name'=>'世园会五十国钱币册',
            'no'=>'001001',
            'unit'=>'册',
            'price'=>998.00,
            'can_use' => [
            ]
        ],
        '001002'=>[
            'name'=>'2019北京世园会纪念银章大全40g',
            'no'=>'001002',
            'unit'=>'盒',
            'price'=>1380.00,
        ],
        '003001'=>[
            'name'=>'招财进宝',
            'no'=>'003001',
            'unit'=>'条',
            'price'=>1580.00,
            'discount' => [

            ]
        ],
        '003002'=>[
            'name'=>'水晶之恋',
            'no'=>'003002',
            'unit'=>'条',
            'price'=>980.00,
            'discount' => [

            ]
        ],
        '002002'=>[
            'name'=>'中国经典钱币套装',
            'no'=>'002002',
            'unit'=>'套',
            'price'=>998.00,
            'discount' => [

            ]
        ],
        '002001'=>[
            'name'=>'守扩之羽比翼双飞4.8g',
            'no'=>'002001',
            'unit'=>'条',
            'price'=>1080.00,
            'discount' => [

            ]
        ],
        '002003'=>[
            'name'=>'中国银象棋12g',
            'no'=>'002003',
            'unit'=>'套',
            'price'=>698.00,
            'discount' => [

            ]
        ],
    ];

    public function getAllProduct(){
        return self::PRODUCT;
    }



    public static function getProductByNo($no){
        $products = self::PRODUCT[$no];

        return $products;
    }

    public function setAllByNo($no){
        $product = $this->getProductByNo($no);
        $this->name = $product['name'];
        $this->no = $product['no'];
        $this->unit = $product['unit'];
        $this->price = $product['price'];
    }

    public function getTotalPrice(){
        return $this->price * $this->number;
    }

    public function getDiscount(){
        return $this->price * $this->number;
    }


    public function discountRules(){

    }

}