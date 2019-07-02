<?php
namespace Model;
/**
 * Created by PhpStorm.
 * User: system.err
 * Date: 2019/7/2
 * Time: 17:13
 */

/**
 * Created by PhpStorm.
 * User: alloyer
 * Date: 2019/7/2
 * Time: 16:20
 * Desc:定义"开门红活动"的满减优惠清单
 */

class GrandOpening
{
    public $name;  //优惠名
    public $no;    //优惠编号
    public $des;  //优惠描述
    public $cutmoney;//满减金额

    const GRANDTYPE = [
        '001000'=> [
            'name'=>'1000元减10',
            'no'=>'001000',
            'des'=>'每满1000元减10',
            'money'=>1000,
            'cutmoney'=>10
        ],
        '002000'=> [
            'name'=>'2000元减30',
            'no'=>'002000',
            'des'=>'每满2000元减30',
            'money'=>2000,
            'cutmoney'=>30
        ],
        '003000'=> [
            'name'=>'3000元减350',
            'no'=>'003000',
            'des'=>'每满3000元减350',
            'money'=>3000,
            'cutmoney'=>350
        ],
        '000003'=> [
            'name'=>'第3件半价',
            'no'=>'000003',
            'des'=>'第3件半价'//买3件及以上，其中1件半价
        ],
        '000004'=> [
            'name'=>'满3送1',
            'no'=>'000004',
            'des'=>'满3送1'//买4件及以上，其中1件免费
        ],
    ];
}