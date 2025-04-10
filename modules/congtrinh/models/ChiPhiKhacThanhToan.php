<?php
namespace app\modules\congtrinh\models;

use app\modules\congtrinh\models\base\ChiPhiKhacThanhToanBase;


class ChiPhiKhacThanhToan extends ChiPhiKhacThanhToanBase
{
    public function getCongTrinh()
    {
        return $this->hasOne(CongTrinh::class, ['id' => 'id_cong_trinh']);
    }
}