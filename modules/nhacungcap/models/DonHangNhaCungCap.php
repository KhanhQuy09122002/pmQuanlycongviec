<?php
namespace app\modules\nhacungcap\models;

use app\modules\nhacungcap\models\base\DonHangNhaCungCapBase;



class DonHangNhaCungCap extends DonHangNhaCungCapBase
{
   
    public function getNccChiTietDonHangNccs()
    {
        return $this->hasMany(ChiTietDonHangNcc::class, ['id_don_hang' => 'id']);
    }

    public function getNhaCungCap()
    {
        return $this->hasOne(NhaCungCap::class, ['id' => 'id_nha_cung_cap']);
    }

}