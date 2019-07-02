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
            'discount' => [
            ]

        ],
        '001002'=>[
            'name'=>'2019北京世园会纪念银章大全40g',
            'no'=>'001002',
            'unit'=>'盒',
            'price'=>1380.00,
            'discount' => [
                '0090'
            ]
        ],
        '003001'=>[
            'name'=>'招财进宝',
            'no'=>'003001',
            'unit'=>'条',
            'price'=>1580.00,
            'discount' => [
                '0095'
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
                '002000',
                '001000',
            ]
        ],
        '002001'=>[
            'name'=>'守扩之羽比翼双飞4.8g',
            'no'=>'002001',
            'unit'=>'条',
            'price'=>1080.00,
            'discount' => [
                '0095',
                '000003',
                '000004',
            ]
        ],
        '002003'=>[
            'name'=>'中国银象棋12g',
            'no'=>'002003',
            'unit'=>'套',
            'price'=>698.00,
            'discount' => [
                '0090',
                '001000',
                '002000',
                '003000',
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
        $this->discount = $product['discount'];
    }

    public function setNumber($number){
        $this->number = $number;
    }

    public function getTotalPrice(){
        return $this->price * $this->number;
    }

    public function getDiscountMoney(){
        $total_price = $this->price * $this->number;
        $discount = $this->discount;
        $discount_money = 0;
        foreach($discount as  $item){
            if(in_array($item,GrandOpening::GRANDTYPE)){
                switch ($item){
                    case '000003':
                        if($this->number >3 ){
                            if($this->price/2 > $discount_money){
                                $discount_money = $this->price/2;
                            }
                        }
                        break;
                    case '000004':
                        if($this->number >4 && $this->price > $discount_money){
                            $discount_money = $this->price;
                        }
                        break;
                    default:
                        $discount_money_count =intval($total_price/GrandOpening::GRANDTYPE[$item]['money'])*GrandOpening::GRANDTYPE[$item]['cutmoney'];
                        if($discount_money_count > $discount_money){
                            $discount_money = $discount_money_count;
                        }
                        break;

                }
            }

            if(isset(SaleType::SALETYPE[$item])){
                $discount_money_count = $total_price * SaleType::SALETYPE[$item]['ratio'];
                if($discount_money_count > $discount_money){
                    $discount_money = $discount_money_count;
                }
            }

        }

        return $discount_money;


    }


    public function discountMoney(){
        $this->discount;
    }

}