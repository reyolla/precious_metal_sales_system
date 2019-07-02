<?php
/**
 * Created by PhpStorm.
 * User: system.err
 * Date: 2019/7/2
 * Time: 17:24
 */

namespace Model;
/**
 * Created by PhpStorm.
 * User: alloyer
 * Date: 2019/7/2
 * Time: 16:20
 *Desc:定义VIP用户
 */

class VipUser
{
    public $name;  //用户名
    public $level;    //会员等级
    public $cardno;  //卡号
    public $point;  //积分
    public $newPoint = 0;
    public $oldlevel ;

    const VIPUSER = [
        '6236609999'=> [
            'name'=>'马丁',
            'level'=>1,
            'levelname'=>'普卡',
            'cardno'=>'6236609999',
            'point'=>9860
        ],

        '6630009999'=> [
            'name'=>'王立',
            'level'=>2,
            'levelname'=>'金卡',
            'cardno'=>'6630009999',
            'point'=>48860
        ],
        '8230009999'=> [
            'name'=>'李想',
            'level'=>3,
            'levelname'=>'白金卡',
            'cardno'=>'8230009999',
            'point'=>98860
        ],
        '9230009999'=> [
            'name'=>'张三',
            'level'=>4,
            'levelname'=>'钻石卡',
            'cardno'=>'9230009999',
            'point'=>198860
        ],
    ];
    public function setPoint($money){
        switch ($this->level){
            case 1:
                $this->newPoint= $money*1;
                break;
            case 2:
                $this->newPoint=  $money*1.5;
                break;
            case 3:
                $this->newPoint= $money*1.8;
                break;
            case 4:
                $this->newPoint= $money*2;
                break;
        }
        $this->point += $this->newPoint;
    }

    public function setUser($cardno){
        $data = self::VIPUSER[$cardno];
        $this->name = $data['name'];
        $this->level = $data['level'];
        $this->levelname = $data['levelname'];
        $this->cardno = $data['cardno'];
        $this->point = $data['point'];
    }
    public function getLevel(){
        $this->oldlevel = $this->level;
        if($this->point>100000){
            $this->level = 4;
            return '普卡';
        }elseif($this->point>50000){
            $this->level = 3;
            return '白金卡';
        }elseif($this->point > 10000){
            $this->level = 2;
            return '金卡';
        }else{
            $this->level = 1;
            return '钻石卡';
        }

    }

}