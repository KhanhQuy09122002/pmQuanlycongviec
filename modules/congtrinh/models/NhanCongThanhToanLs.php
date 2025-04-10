<?php
namespace app\modules\congtrinh\models;

use app\modules\congtrinh\models\base\NhanCongThanhToanLsBase;


class  NhanCongThanhToanLs extends NhanCongThanhToanLsBase
{
    public function getNhanCongThanhToan()
    {
        return $this->hasOne(NhanCongThanhToan::class, ['id' => 'id_nhan_cong_thanh_toan']);
    }
}