<?php
namespace app\modules\congtrinh\models;

use app\modules\congtrinh\models\base\ThauPhuThanhToanBase;


class ThauPhuThanhToan extends ThauPhuThanhToanBase
{
    public function getCongTrinh()
    {
        return $this->hasOne(CongTrinh::class, ['id' => 'id_cong_trinh']);
    }

    public function getCtThauPhuThanhToanLichSus()
    {
        return $this->hasMany(ThauPhuThanhToanLs::class, ['id_thau_phu_thanh_toan' => 'id']);
    }
}