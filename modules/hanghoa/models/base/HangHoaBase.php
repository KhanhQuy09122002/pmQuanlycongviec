<?php

namespace app\modules\hanghoa\models\base;

use Yii;

/**
 * This is the model class for table "hh_hang_hoa".
 *
 * @property int $id
 * @property string $ten_hang_hoa
 * @property string|null $ma_hang_hoa
 * @property string $ngay_san_xuat
 * @property int|null $so_luong_ton_kho
 * @property int $don_gia
 * @property string|null $ghi_chu
 * @property int|null $nguoi_tao
 * @property string|null $thoi_gian_tao
 *
 * @property KhChiTietDonHangKh[] $khChiTietDonHangKhs
 * @property NccChiTietDonHangNcc[] $nccChiTietDonHangNccs
 */
class HangHoaBase extends \app\models\HhHangHoa
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hh_hang_hoa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ten_hang_hoa', 'ngay_san_xuat', 'don_gia'], 'required'],
            [['ngay_san_xuat', 'thoi_gian_tao'], 'safe'],
            [['so_luong_ton_kho', 'don_gia', 'nguoi_tao'], 'integer'],
            [['ghi_chu'], 'string'],
            [['ten_hang_hoa'], 'string', 'max' => 255],
            [['ma_hang_hoa'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ten_hang_hoa' => 'Tên hàng hóa',
            'ma_hang_hoa' => 'Mã hàng hóa',
            'ngay_san_xuat' => 'Ngày sản xuất',
            'so_luong_ton_kho' => 'Số lượng tồn kho',
            'don_gia' => 'Đơn gái',
            'ghi_chu' => 'Ghi chú',
            'nguoi_tao' => 'Người tạo',
            'thoi_gian_tao' => 'Thời gian tạo',
        ];
    }

}
