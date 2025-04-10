<?php
namespace app\modules\nhacungcap\models;

use app\modules\nhacungcap\models\base\CongNoNhaCungCapBase;



class CongNoNhaCungCap extends CongNoNhaCungCapBase
{

    public function getNhaCungCap()
    {
        return $this->hasOne(NhaCungCap::class, ['id' => 'id_nha_cung_cap']);
    }

}