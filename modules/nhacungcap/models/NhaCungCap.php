<?php
namespace app\modules\nhacungcap\models;

use app\modules\nhacungcap\models\base\NhaCungCapBase;



class NhaCungCap extends NhaCungCapBase
{
    public function getCongNoNhaCungCap()
    {
        return $this->hasMany(CongNoNhaCungCap::class, ['id_nha_cung_cap' => 'id']);
    }

    public function getNccDonHangNhaCungCaps()
    {
        return $this->hasMany(DonHangNhaCungCap::class, ['id_nha_cung_cap' => 'id']);
    }

}