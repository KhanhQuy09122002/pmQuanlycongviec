<?php
namespace app\modules\congtrinh\models;

use app\modules\congtrinh\models\base\VatTuThanhToanBase;
use app\modules\hanghoa\models\HangHoa;


class VatTuThanhToan extends VatTuThanhToanBase
{
    public function getCongTrinh()
    {
        return $this->hasOne(CongTrinh::class, ['id' => 'id_cong_trinh']);
    }
    public function getHangHoa()
    {
        return $this->hasOne(HangHoa::class, ['id' => 'id_hang_hoa']);
    }
}