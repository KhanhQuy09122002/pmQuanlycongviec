<?php
namespace app\modules\congtrinh\models;

use app\modules\congtrinh\models\base\GiaTriThucHienHopDongBase;


class GiaTriThucHienHopDong extends GiaTriThucHienHopDongBase
{
    public function getCongTrinh()
    {
        return $this->hasOne(CongTrinh::class, ['id' => 'id_cong_trinh']);
    }
}