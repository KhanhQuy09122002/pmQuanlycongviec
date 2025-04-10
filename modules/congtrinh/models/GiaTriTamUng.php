<?php
namespace app\modules\congtrinh\models;

use app\modules\congtrinh\models\base\GiaTriTamUngBase;


class GiaTriTamUng extends GiaTriTamUngBase
{
    public function getCongTrinh()
    {
        return $this->hasOne(CongTrinh::class, ['id' => 'id_cong_trinh']);
    }
}