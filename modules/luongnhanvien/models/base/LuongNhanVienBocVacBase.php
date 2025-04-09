<?php

namespace app\modules\luongnhanvien\models\base;

use Yii;
use app\modules\luongnhanvien\models\NhanVienBocVac;
use app\custom\CustomFunc;
/**
 * This is the model class for table "nv_luong_nhan_vien_boc_vac".
 *
 * @property int $id
 * @property int $id_nhan_vien_boc_vac
 * @property string $ngay_thang
 * @property int $so_tien
 * @property int|null $da_nhan
 * @property int|null $nguoi_tao
 * @property string|null $thoi_gian_tao
 * @property string|null $ghi_chu
 *
 * @property NvNhanVienBocVac $nhanVienBocVac
 */
class LuongNhanVienBocVacBase extends \app\models\NvLuongNhanVienBocVac
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nv_luong_nhan_vien_boc_vac';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_nhan_vien_boc_vac', 'ngay_thang', 'so_tien'], 'required'],
            [['id_nhan_vien_boc_vac', 'so_tien', 'da_nhan', 'nguoi_tao'], 'integer'],
            [['thoi_gian_tao','ghi_chu','ngay_thang'], 'safe'],
            [['id_nhan_vien_boc_vac'], 'exist', 'skipOnError' => true, 'targetClass' => NhanVienBocVac::class, 'targetAttribute' => ['id_nhan_vien_boc_vac' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_nhan_vien_boc_vac' => 'Nhân viên bóc vác/vận chuyển',
            'ngay_thang' => 'Ngày tháng',
            'so_tien' => 'Số tiền',
            'da_nhan' => 'Đã nhận',
            'ghi_chu'=>'Ghi chú',
            'nguoi_tao' => 'Người tạo',
            'thoi_gian_tao' => 'Thời gian tạo',
        ];
    }
    public function beforeSave($insert) {
        $this->ngay_thang = CustomFunc::convertDMYToYMD($this->ngay_thang);
        if ($this->isNewRecord) {
            $this->nguoi_tao = Yii::$app->user->identity->id;
            $this->thoi_gian_tao = date('Y-m-d H:i:s');        
        }
        return parent::beforeSave($insert);
    }
  
}
