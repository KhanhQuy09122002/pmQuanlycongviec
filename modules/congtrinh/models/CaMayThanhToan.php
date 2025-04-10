<?php
namespace app\modules\congtrinh\models;

use app\modules\congtrinh\models\base\CaMayThanhToanBase;


class CaMayThanhToan extends CaMayThanhToanBase
{
    public function getCongTrinh()
    {
        return $this->hasOne(CongTrinh::class, ['id' => 'id_cong_trinh']);
    }
}