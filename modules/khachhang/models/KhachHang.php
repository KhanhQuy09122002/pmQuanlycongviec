<?php
namespace app\modules\khachhang\models;

use app\modules\khachhang\models\base\KhachHangBase;



class KhachHang extends KhachHangBase
{
    public function getCongNoKhachHang()
    {
        return $this->hasMany(CongNoKhachHang::class, ['id_khach_hang' => 'id']);
    }

    public function getKhDonHangs()
    {
        return $this->hasMany(DonHangKhachHang::class, ['id_khach_hang' => 'id']);
    }

}