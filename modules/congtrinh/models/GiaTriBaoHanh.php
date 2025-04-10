<?php
namespace app\modules\congtrinh\models;

use app\modules\congtrinh\models\base\GiaTriBaoHanhBase;


class GiaTriBaoHanh extends GiaTriBaoHanhBase
{
    public function getCongTrinh()
    {
        return $this->hasOne(CongTrinh::class, ['id' => 'id_cong_trinh']);
    }
}