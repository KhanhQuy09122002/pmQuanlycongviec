<?php
namespace app\modules\hanghoa\models;

use app\modules\hanghoa\models\base\HangHoaDvtBase;
use yii\helpers\ArrayHelper;

class DVT extends HangHoaDvtBase{
    /**
     * lay danh sach dvt de fill vao dropdownlist
     */
    public static function getList(){
        $list = DVT::find()->all();
        return ArrayHelper::map($list, 'id', 'ten_dvt');
    }
}