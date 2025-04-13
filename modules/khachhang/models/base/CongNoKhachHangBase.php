<?php

namespace app\modules\khachhang\models\base;

use Yii;
use app\modules\khachhang\models\KhachHang;
use app\custom\CustomFunc;
            
/**
 * This is the model class for table "kh_cong_no_khach_hang".
 *
 * @property int $id
 * @property int $id_khach_hang
 * @property string $loai_cong_no
 * @property int $so_tien
 * @property string|null $ghi_chu
 * @property string|null $ngay_phat_sinh
 * @property int|null $nguoi_tao
 * @property string|null $thoi_gian_tao
 *
 * @property KhKhachHang $khachHang
 */
class CongNoKhachHangBase extends \app\models\KhCongNoKhachHang
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kh_cong_no_khach_hang';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_khach_hang', 'loai_cong_no', 'so_tien'], 'required'],
            [['id_khach_hang', 'so_tien', 'nguoi_tao'], 'integer'],
            [['ghi_chu'], 'string'],
            [['ngay_phat_sinh', 'thoi_gian_tao'], 'safe'],
            [['loai_cong_no'], 'string', 'max' => 255],
            [['id_khach_hang'], 'exist', 'skipOnError' => true, 'targetClass' => KhachHang::class, 'targetAttribute' => ['id_khach_hang' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_khach_hang' => 'Khách hàng',
            'loai_cong_no' => 'Loại công nợ',
            'so_tien' => 'Số tiền',
            'ghi_chu' => 'Ghi chú',
            'ngay_phat_sinh' => 'Ngày phát sinh',
            'nguoi_tao' => 'Người tạo',
            'thoi_gian_tao' => 'Thời gian tạo',
        ];
    }

    public function beforeSave($insert) {
        $this->ngay_phat_sinh = CustomFunc::convertDMYToYMD($this->ngay_phat_sinh);
        if ($this->isNewRecord) {
            $this->nguoi_tao = Yii::$app->user->identity->id;
            $this->thoi_gian_tao = date('Y-m-d H:i:s');        
        }
        return parent::beforeSave($insert);
    }
}
