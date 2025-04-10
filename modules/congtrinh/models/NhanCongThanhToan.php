<?php
namespace app\modules\congtrinh\models;

use app\modules\congtrinh\models\base\NhanCongThanhToanBase;


class NhanCongThanhToan extends NhanCongThanhToanBase
{
    public function getCongTrinh()
    {
        return $this->hasOne(CongTrinh::class, ['id' => 'id_cong_trinh']);
    }

    public function getCtNhanCongThanhToanLichSus()
    {
        return $this->hasMany(NhanCongThanhToanLs::class, ['id_nhan_cong_thanh_toan' => 'id']);
    }
}