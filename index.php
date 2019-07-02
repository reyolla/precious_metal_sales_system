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


        $discount = $info->discountCards;
        $sale_type = new SaleType();
        $discounts = $sale_type->getDiscountsByNames($discount); //获取优惠
        $order->setDiscount($discounts); // 设置优惠券
        $total_price = $order->calAmountList(); //合计总价
        $total_minus_fess = $order->minusFeeList(); //开门红优惠总价
        $total_discount = $order->discountFeeList();//打折券优惠总价
        $payfee = $order->payFee(); //实付金额

        $member = new VipUser();
        $member->setUser($info->memberId);
        $member->setPoint($payfee);
        //组装打印凭证
        $string = "方鼎银行贵金属购买凭证"." \n\n";

        $string .= "销售单号:".$info->orderId."\t 日期:".$info->createTime."\n";
        $string .= "客户卡号:".$info->memberId."\t 会员姓名:".$member->name."\t 客户等级:".$member->getLevel()."\t 累计积分:".$member->point."\n\n";

        $string .= "商品及数量\t\t\t 单价 \t\t\t 金额\n";


        foreach($total_price["data"] as $item){
            $string .= "(".$item["no"].")".$item["name"]."x".$item["number"].", ".$item["price"].", ".$item["total_price"]."\n";
        }
        $string .= "合计：". $total_price["total_price"]."\n\n";

        $string .= "优惠清单：\t";
        foreach($total_minus_fess["data"] as $item){
            $string .= "(".$item["no"].")".$item["name"].":".$item["minus_fee"]."\n";
        }
        $string .= "优惠合计：". $total_minus_fess["total_minus_fee"]."\n\n";
        $string .= "应收合计：". $payfee."\n";
        $string .= "收款：\n";

        foreach($discount as $item){
            $string .=  " ".$item."\n";
        }
        $string .= " 余额支付：".$item."\n\n";
        $string .= " 客户等级与积分：\n";
        $string .= " 新增积分：".$member->newPoint."\n";
        if($member->oldlevel!=0 && $member->oldlevel < $member->level){
            $string .= "恭喜您升级为".$member->getLevel()."客户！";
        }

        file_put_contents("test/sample_result.txt",$string);


    }




}

$output = new Index();
$output->order();

echo '运行成功！';