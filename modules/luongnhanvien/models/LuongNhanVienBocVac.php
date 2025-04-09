<?php
namespace app\modules\luongnhanvien\models;

use app\modules\luongnhanvien\models\base\LuongNhanVienBocVacBase;



class LuongNhanVienBocVac extends LuongNhanVienBocVacBase
{
    public function getNhanVienBocVac()
    {
        return $this->hasOne(NhanVienBocVac::class, ['id' => 'id_nhan_vien_boc_vac']);
    }
}