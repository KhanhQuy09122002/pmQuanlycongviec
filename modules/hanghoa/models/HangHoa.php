<?php
namespace app\modules\hanghoa\models;

use app\modules\hanghoa\models\base\HangHoaBase;
use app\modules\nhacungcap\models\ChiTietDonHangNcc;
use app\modules\khachhang\models\ChiTietDonHangKhachHang;
use app\modules\user\models\User;
use yii\helpers\ArrayHelper;

class HangHoa extends HangHoaBase
{
    public function getKhChiTietDonHangKhs()
    {
        return $this->hasMany(ChiTietDonHangKhachHang::class, ['id_hang_hoa' => 'id']);
    }

    public function getNccChiTietDonHangNccs()
    {
        return $this->hasMany(ChiTietDonHangNcc::class, ['id_hang_hoa' => 'id']);
    }

    public function getNguoiTao()
    {
        return $this->hasOne(User::class, ['id' => 'nguoi_tao']);
    }
    
    public static function getDmHangHoa(){
        $ds = HangHoa::find()->all();
        return ArrayHelper::map($ds, 'id', function($model) {
            return '+ ' . $model->ten_hang_hoa;
        }, function($model) {
            return $model->loaiHangHoa->ten_loai_hang_hoa;
        });
    }

   
}