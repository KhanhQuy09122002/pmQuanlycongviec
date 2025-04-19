<?php

namespace app\modules\nhacungcap\models\base;

use Yii;
use app\modules\nhacungcap\models\DonHangNhaCungCap;
use app\modules\hanghoa\models\HangHoa;
/**
 * This is the model class for table "ncc_chi_tiet_don_hang_ncc".
 *
 * @property int $id
 * @property int $id_don_hang
 * @property int $id_hang_hoa
 * @property int $so_luong
 * @property int $thanh_tien
 * @property int|null $nguoi_tao
 * @property string|null $thoi_gian_tao
 *
 * @property NccDonHangNhaCungCap $donHang
 * @property HhHangHoa $hangHoa
 */
class ChiTietDonHangNccBase extends \app\models\NccChiTietDonHangNcc 
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ncc_chi_tiet_don_hang_ncc';
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
            [['id_don_hang'], 'exist', 'skipOnError' => true, 'targetClass' => DonHangNhaCungCap::class, 'targetAttribute' => ['id_don_hang' => 'id']],
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


}
