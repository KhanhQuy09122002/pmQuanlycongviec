<?php

namespace app\modules\khachhang\models\base;

use Yii;
use app\modules\khachhang\models\KhachHang;
            
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
            'id_khach_hang' => 'Id Khach Hang',
            'loai_cong_no' => 'Loai Cong No',
            'so_tien' => 'So Tien',
            'ghi_chu' => 'Ghi Chu',
            'ngay_phat_sinh' => 'Ngay Phat Sinh',
            'nguoi_tao' => 'Nguoi Tao',
            'thoi_gian_tao' => 'Thoi Gian Tao',
        ];
    }

  
}
