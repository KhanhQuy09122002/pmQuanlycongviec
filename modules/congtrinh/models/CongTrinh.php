<?php
namespace app\modules\congtrinh\models;

use app\modules\congtrinh\models\base\CongTrinhBase;


class CongTrinh extends CongTrinhBase
{
    
    public function getCaMayThanhToan()
    {
        return $this->hasMany(CaMayThanhToan::class, ['id_cong_trinh' => 'id']);
    }

 
    public function getChiPhiKhacThanhToan()
    {
        return $this->hasMany(ChiPhiKhacThanhToan::class, ['id_cong_trinh' => 'id']);
    }

 
    public function getGiaTriBaoHanh()
    {
        return $this->hasMany(GiaTriBaoHanh::class, ['id_cong_trinh' => 'id']);
    }

    public function getGiaTriDaThanhToan()
    {
        return $this->hasMany(GiaTriDaThanhToan::class, ['id_cong_trinh' => 'id']);
    }

 
    public function getGiaTriTamUng()
    {
        return $this->hasMany(GiaTriTamUng::class, ['id_cong_trinh' => 'id']);
    }

    public function getGiaTriThucHienHopDong()
    {
        return $this->hasMany(GiaTriThucHienHopDong::class, ['id_cong_trinh' => 'id']);
    }

   
    public function getNhanCongThanhToan()
    {
        return $this->hasMany(NhanCongThanhToan::class, ['id_cong_trinh' => 'id']);
    }


    public function getThauPhuThanhToan()
    {
        return $this->hasMany(ThauPhuThanhToan::class, ['id_cong_trinh' => 'id']);
    }

    public function getVatTuThanhToan()
    {
        return $this->hasMany(VatTuThanhToan::class, ['id_cong_trinh' => 'id']);
    }
 
   
}