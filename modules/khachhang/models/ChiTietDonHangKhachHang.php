<?php
namespace app\modules\khachhang\models;

use app\modules\khachhang\models\base\ChiTietDonHangKhachHangBase;



class ChiTietDonHangKhachHang extends ChiTietDonHangKhachHangBase
{

    public function getKhChiTietDonHangKhs()
    {
        return $this->hasMany(ChiTietDonHangKhachHang ::class, ['id_don_hang' => 'id']);
    }

    public function getKhachHang()
    {
        return $this->hasOne(KhachHang::class, ['id' => 'id_khach_hang']);
    }
   
}