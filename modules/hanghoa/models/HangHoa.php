<?php
namespace app\modules\hanghoa\models;

use app\modules\hanghoa\models\base\HangHoaBase;
use app\modules\nhacungcap\models\ChiTietDonHangNcc;
use app\modules\khachhang\models\ChiTietDonHangKhachHang;

class HangHoa extends HangHoaBase
{
    
   
    public function getKhChiTietDonHangKhs()
    {
        return $this->hasMany(ChiTietDonHangKhachHang ::class, ['id_hang_hoa' => 'id']);
    }

 
    public function getNccChiTietDonHangNccs()
    {
        return $this->hasMany(ChiTietDonHangNcc::class, ['id_hang_hoa' => 'id']);
    }
   
}