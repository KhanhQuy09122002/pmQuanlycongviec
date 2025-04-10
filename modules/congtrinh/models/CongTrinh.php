<?php
namespace app\modules\congtrinh\models;

use app\modules\congtrinh\models\base\CongTrinhBase;


class CongTrinh extends CongTrinhBase
{
    
    public function getCtCaMayThanhToans()
    {
        return $this->hasMany(CaMayThanhToan::class, ['id_cong_trinh' => 'id']);
    }

 
    public function getCtChiPhiKhacThanhToans()
    {
        return $this->hasMany(ChiPhiKhacThanhToan::class, ['id_cong_trinh' => 'id']);
    }

 
    public function getCtGiaTriBaoHanhs()
    {
        return $this->hasMany(GiaTriBaoHanh::class, ['id_cong_trinh' => 'id']);
    }

    public function getCtGiaTriDaThanhToans()
    {
        return $this->hasMany(GiaTriDaThanhToan::class, ['id_cong_trinh' => 'id']);
    }

 
    public function getCtGiaTriTamUngs()
    {
        return $this->hasMany(GiaTriTamUng::class, ['id_cong_trinh' => 'id']);
    }

    public function getCtGiaTriThucHienHopDongs()
    {
        return $this->hasMany(GiaTriThucHienHopDong::class, ['id_cong_trinh' => 'id']);
    }

   
    public function getCtNhanCongThanhToans()
    {
        return $this->hasMany(NhanCongThanhToan::class, ['id_cong_trinh' => 'id']);
    }


    public function getCtThauPhuThanhToans()
    {
        return $this->hasMany(ThauPhuThanhToan::class, ['id_cong_trinh' => 'id']);
    }

    public function getCtVatTuThanhToans()
    {
        return $this->hasMany(VatTuThanhToan::class, ['id_cong_trinh' => 'id']);
    }
 
   
}