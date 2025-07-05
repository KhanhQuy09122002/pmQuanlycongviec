<?php

namespace app\modules\khachhang\models\base;

use Yii;
use app\modules\khachhang\models\DonHangKhachHang;
use app\modules\hanghoa\models\HangHoa;
/**
 * This is the model class for table "kh_chi_tiet_don_hang_kh".
 *
 * @property int $id
 * @property int $id_don_hang
 * @property int $id_hang_hoa
 * @property int $so_luong
 * @property int $thanh_tien
 * @property int|null $nguoi_tao
 * @property string|null $thoi_gian_tao
 *
 * @property KhDonHang $donHang
 * @property HhHangHoa $hangHoa
 */
class ChiTietDonHangKhachHangBase  extends \app\models\KhChiTietDonHangKh
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kh_chi_tiet_don_hang_kh';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_don_hang', 'id_hang_hoa', 'so_luong', 'thanh_tien'], 'required'],
            [['id_don_hang', 'id_hang_hoa', 'so_luong', 'thanh_tien', 'nguoi_tao'], 'integer'],
            [['thoi_gian_tao'], 'safe'],
            [['id_don_hang'], 'exist', 'skipOnError' => true, 'targetClass' => DonHangKhachHang::class, 'targetAttribute' => ['id_don_hang' => 'id']],
            [['id_hang_hoa'], 'exist', 'skipOnError' => true, 'targetClass' => HangHoa::class, 'targetAttribute' => ['id_hang_hoa' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_don_hang' => 'Đơn hàng',
            'id_hang_hoa' => 'Hàng hóa',
            'so_luong' => 'Số lượng',
            'thanh_tien' => 'Thành tiền',
            'nguoi_tao' => 'Người tạo',
            'thoi_gian_tao' => 'Thời gian tạo',
        ];
    }

    /**
     * Gets query for [[DonHang]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDonHang()
    {
        return $this->hasOne(DonHangKhachHang ::class, ['id' => 'id_don_hang']);
    }

    /**
     * Gets query for [[HangHoa]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHangHoa()
    {
        return $this->hasOne(HangHoa::class, ['id' => 'id_hang_hoa']);
    }
}
