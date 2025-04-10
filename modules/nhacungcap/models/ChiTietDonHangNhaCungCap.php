<?php
namespace app\modules\nhacungcap\models;

use app\modules\nhacungcap\models\base\ChiTietDonHangNccBase;
use app\modules\hanghoa\models\HangHoa;


class ChiTietDonHangNcc extends ChiTietDonHangNccBase
{
    public function getDonHang()
    {
        return $this->hasOne(DonHangNhaCungCap::class, ['id' => 'id_don_hang']);
    }

    public function getHangHoa()
    {
        return $this->hasOne(HangHoa::class, ['id' => 'id_hang_hoa']);
    }

}