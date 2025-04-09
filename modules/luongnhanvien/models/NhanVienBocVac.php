<?php
namespace app\modules\luongnhanvien\models;

use app\modules\luongnhanvien\models\base\NhanVienBocVacBase;



class NhanVienBocVac extends NhanVienBocVacBase
{
    
    public function getNvLuongNhanVienBocVacs()
    {
        return $this->hasMany(LuongNhanVienBocVac::class, ['id_nhan_vien_boc_vac' => 'id']);
    }
}