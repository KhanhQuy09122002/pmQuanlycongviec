<?php
namespace app\modules\congtrinh\models;

use app\modules\congtrinh\models\base\GiaTriDaThanhToanBase;


class GiaTriDaThanhToan extends GiaTriDaThanhToanBase
{
    public function getCongTrinh()
    {
        return $this->hasOne(CongTrinh::class, ['id' => 'id_cong_trinh']);
    }
}