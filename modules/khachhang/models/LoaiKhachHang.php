<?php
namespace app\modules\khachhang\models;

use app\modules\khachhang\models\base\LoaiKhachHangBase;
use yii\helpers\ArrayHelper;

class LoaiKhachHang extends LoaiKhachHangBase
{
    /**
     * lay danh sach loai khach hang vao dropdownlist
     */
    public static function getList(){
        $list = LoaiKhachHang::find()->all();
        return ArrayHelper::map($list, 'id', 'ten_loai_khach_hang');
    }
}