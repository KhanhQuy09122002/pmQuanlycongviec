<?php
namespace app\modules\khachhang\models;

use app\modules\khachhang\models\base\KhachHangBase;
use yii\helpers\ArrayHelper;



class KhachHang extends KhachHangBase
{
    /**
     * lay danh sach dvt de fill vao dropdownlist
     */
    public static function getList(){
        $list = KhachHang::find()->all();
        return ArrayHelper::map($list, 'id', 'ho_ten');
    }
    
    public function getCongNoKhachHang()
    {
        return $this->hasMany(CongNoKhachHang::class, ['id_khach_hang' => 'id']);
    }

    public function getDonHang()
    {
        return $this->hasMany(DonHangKhachHang::class, ['id_khach_hang' => 'id']);
    }

}