<?php
namespace Model;

require_once 'SaleType.php';
require_once 'GrandOpening.php';
use Model\GrandOpening;
use Model\SaleType;

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
    public $discount_money = 0; //打折金额
    public $minu_fee = 0; //优惠金额

    public $use_discount = 0;



    public  $PRODUCT = [
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


    /**
     * 设置产品信息
     * @param $no
     */
    public function setProductByNo($no){

        $products = $this->PRODUCT[$no];
        $this->name = $products['name'];
        $this->no = $products['no'];
        $this->unit = $products['unit'];
        $this->price = $products['price'];
        $this->discount = $products['discount'];

    }

    /**
     * @param $no
     * 设置产品信息
     */
    public function setAllByNo($no){
        $product = $this->PRODUCT[$no];
        $this->name = $product['name'];
        $this->no = $product['no'];
        $this->unit = $product['unit'];
        $this->price = $product['price'];
        $this->discount = $product['discount'];
    }

    public function setNumber($number){
        $this->number = $number;
    }

    /**
     * @return float|int
     * 计算总价
     */
    public function getTotalPrice(){
        return $this->price * $this->number;
    }

    /**
     *
     * 计算折扣金及开门红优惠金额
     */
    public function getDiscountMoney(){
        $total_price = $this->price * $this->number;
        $discount = $this->discount;
        $discount_money = 0;
        foreach($discount as  $item){

            if(isset(GrandOpening::GRANDTYPE[$item])){
                switch ($item){
                    case '000003':
                        if($this->number >3 ){
                            if($this->price/2 > $discount_money){
                                $discount_money = $this->price/2;
                                $this->minu_fee = $discount_money;
                                $this->discount_money = 0;
                            }
                        }
                        break;
                    case '000004':
                        if($this->number >4 && $this->price > $discount_money){
                            $discount_money = $this->price;
                            $this->minu_fee = $discount_money;
                            $this->discount_money = 0;
                        }
                        break;
                    default:
                        $discount_money_count =intval($this->getTotalPrice()/GrandOpening::GRANDTYPE[$item]['money'])*GrandOpening::GRANDTYPE[$item]['cutmoney'];
                        if($discount_money_count > $discount_money){
                            $discount_money = $discount_money_count;
                            $this->minu_fee = $discount_money;
                            $this->discount_money = 0;
                        }
                        break;

                }
            }

            if(isset(SaleType::SALETYPE[$item]) && !empty($this->use_discount) ){
                foreach($this->use_discount as $value){
                    if(!empty(SaleType::SALETYPE[$item])){
                        $discount_money_count = $total_price * (1-SaleType::SALETYPE[$item]['ratio']);
                        if($discount_money_count > $this->discount_money){
                            $discount_money = $discount_money_count;
                            $this->discount_money = $discount_money;
                            $this->minu_fee = 0;
                        }
                    }
                }
            }
        }
    }

}