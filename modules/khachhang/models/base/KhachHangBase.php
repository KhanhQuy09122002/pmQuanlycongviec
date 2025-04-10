<?php

namespace app\modules\khachhang\models\base;

use Yii;

/**
 * This is the model class for table "kh_khach_hang".
 *
 * @property int $id
 * @property string $ho_ten
 * @property string|null $so_dien_thoai
 * @property string|null $dia_chi
 * @property int|null $tong_cong_no
 * @property int|null $da_thanh_toan
 * @property int|null $con_lai
 * @property int|null $nguoi_tao
 * @property string|null $thoi_gian_tao
 *
 * @property KhCongNoKhachHang[] $khCongNoKhachHangs
 * @property KhDonHang[] $khDonHangs
 */
class KhachHangBase extends \app\models\KhKhachHang 
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kh_khach_hang';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ho_ten'], 'required'],
            [['tong_cong_no', 'da_thanh_toan', 'con_lai', 'nguoi_tao'], 'integer'],
            [['thoi_gian_tao'], 'safe'],
            [['ho_ten'], 'string', 'max' => 50],
            [['so_dien_thoai'], 'string', 'max' => 12],
            [['dia_chi'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ho_ten' => 'Họ tên',
            'so_dien_thoai' => 'Số điện thoại',
            'dia_chi' => 'Địa chỉ',
            'tong_cong_no' => 'Tổng công nợ',
            'da_thanh_toan' => 'Đã thanh toán',
            'con_lai' => 'Còn lại',
            'nguoi_tao' => 'Người tạo',
            'thoi_gian_tao' => 'Thời gian tạo',
        ];
    }

    public function beforeSave($insert) {
      
        if ($this->isNewRecord) {
            $this->nguoi_tao = Yii::$app->user->identity->id;
            $this->thoi_gian_tao = date('Y-m-d H:i:s');        
        }
        return parent::beforeSave($insert);
    }
}
