<?php
namespace app\modules\khachhang\models;

use app\modules\khachhang\models\base\CongNoKhachHangBase;



class CongNoKhachHang extends CongNoKhachHangBase
{
    
    public function getKhachHang()
    {
        return $this->hasOne(KhachHang::class, ['id' => 'id_khach_hang']);
    }
}