<?php
namespace app\modules\congtrinh\models;

use app\modules\congtrinh\models\base\VatTuThanhToanBase;


class VatTuThanhToan extends VatTuThanhToanBase
{
    public function getCongTrinh()
    {
        return $this->hasOne(CongTrinh::class, ['id' => 'id_cong_trinh']);
    }
}