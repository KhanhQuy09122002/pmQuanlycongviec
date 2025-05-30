<?php

namespace app\modules\nhacungcap\models\base;

use Yii;
use app\modules\nhacungcap\models\NhaCungCap;

/**
 * This is the model class for table "ncc_don_hang_nha_cung_cap".
 *
 * @property int $id
 * @property int $id_nha_cung_cap
 * @property int $so_don_hang
 * @property string $ngay_dat_hang
 * @property int|null $tong_tien
 * @property int|null $da_giao_hang
 * @property string|null $ngay_giao_hang
 * @property int|null $nguoi_tao
 * @property string|null $thoi_gian_tao
 *
 * @property NccChiTietDonHangNcc[] $nccChiTietDonHangNccs
 * @property NccNhaCungCap $nhaCungCap
 */
class DonHangNhaCungCapBase extends \app\models\NccDonHangNhaCungCap 
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ncc_don_hang_nha_cung_cap';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_nha_cung_cap', 'so_don_hang', 'ngay_dat_hang'], 'required'],
            [['id_nha_cung_cap', 'so_don_hang', 'tong_tien', 'da_giao_hang', 'nguoi_tao'], 'integer'],
            [['ngay_dat_hang', 'ngay_giao_hang', 'thoi_gian_tao'], 'safe'],
            [['id_nha_cung_cap'], 'exist', 'skipOnError' => true, 'targetClass' => NhaCungCap::class, 'targetAttribute' => ['id_nha_cung_cap' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_nha_cung_cap' => 'Nhà cung cấp',
            'so_don_hang' => 'Số đơn hàng',
            'ngay_dat_hang' => 'Ngày đặt hàng',
            'tong_tien' => 'Tổng tiền',
            'da_giao_hang' => 'Đã giao hàng',
            'ngay_giao_hang' => 'Ngày giao hàng',
            'nguoi_tao' => 'Người giao hàng',
            'thoi_gian_tao' => 'Thời gian tạo',
        ];
    }

}
