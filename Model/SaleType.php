<?php
/**
 * Created by PhpStorm.
 * User: system.err
 * Date: 2019/7/2
 * Time: 17:01
 */

namespace Model;

/**
 * Created by PhpStorm.
 * User: alloyer
 * Date: 2019/7/2
 * Time: 16:20
 *Desc:定义打折券的类型
 */

class SaleType
{
    public $name;  //打折券名
    public $no;    //打折券编号
    public $des;  //打折券描述
    public $ratio;//折扣计算率

    const SALETYPE = [
        '0090'=> [
            'name'=>'95折券',
            'no'=>'0090',
            'des'=>'可使用9折打折券',
            'ratio'=>0.95,
        ],
        '0095'=> [
            'name'=>'9折券',
            'no'=>'0095',
            'des'=>'可使用95折打折券',
            'ratio'=>0.95,
        ],
    ];
}