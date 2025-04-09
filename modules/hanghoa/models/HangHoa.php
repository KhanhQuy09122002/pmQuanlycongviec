<?php
namespace app\modules\hanghoa\models;

use app\modules\hanghoa\models\base\HangHoaBase;



class HangHoa extends HangHoaBase
{
    
   
    public function getKhChiTietDonHangKhs()
    {
        return $this->hasMany(ChiTietDonHangKh::class, ['id_hang_hoa' => 'id']);
    }

 
    public function getNccChiTietDonHangNccs()
    {
        return $this->hasMany(ChiTietDonHangNcc::class, ['id_hang_hoa' => 'id']);
    }
   
}