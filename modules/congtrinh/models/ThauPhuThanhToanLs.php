<?php
namespace app\modules\congtrinh\models;

use app\modules\congtrinh\models\base\ThauPhuThanhToanLsBase;


class  ThauPhuThanhToanLs extends ThauPhuThanhToanLsBase
{
   
    public function getThauPhuThanhToan()
    {
        return $this->hasOne(ThauPhuThanhToan::class, ['id' => 'id_thau_phu_thanh_toan']);
    }
}