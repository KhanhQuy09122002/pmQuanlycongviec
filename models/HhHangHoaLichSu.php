<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hh_hang_hoa_lich_su".
 *
 * @property int $id
 * @property int $id_hang_hoa
 * @property int|null $id_nha_cung_cap
 * @property string|null $ghi_chu
 * @property float $so_luong số lượng thay đổi tăng/giảm
 * @property float $so_luong_cu
 * @property float $so_luong_moi
 * @property int|null $nguoi_tao
 * @property string|null $thoi_gian_tao
 *
 * @property HhHangHoa $hangHoa
 * @property NccNhaCungCap $nhaCungCap
 */
class HhHangHoaLichSu extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hh_hang_hoa_lich_su';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_nha_cung_cap', 'ghi_chu', 'nguoi_tao', 'thoi_gian_tao'], 'default', 'value' => null],
            [['id_hang_hoa', 'so_luong', 'so_luong_cu', 'so_luong_moi'], 'required'],
            [['id_hang_hoa', 'id_nha_cung_cap', 'nguoi_tao'], 'integer'],
            [['ghi_chu'], 'string'],
            [['so_luong', 'so_luong_cu', 'so_luong_moi'], 'number'],
            [['thoi_gian_tao'], 'safe'],
            [['id_hang_hoa'], 'exist', 'skipOnError' => true, 'targetClass' => HhHangHoa::class, 'targetAttribute' => ['id_hang_hoa' => 'id']],
            [['id_nha_cung_cap'], 'exist', 'skipOnError' => true, 'targetClass' => NccNhaCungCap::class, 'targetAttribute' => ['id_nha_cung_cap' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_hang_hoa' => 'Id Hang Hoa',
            'id_nha_cung_cap' => 'Id Nha Cung Cap',
            'ghi_chu' => 'Ghi Chu',
            'so_luong' => 'So Luong',
            'so_luong_cu' => 'So Luong Cu',
            'so_luong_moi' => 'So Luong Moi',
            'nguoi_tao' => 'Nguoi Tao',
            'thoi_gian_tao' => 'Thoi Gian Tao',
        ];
    }

    /**
     * Gets query for [[HangHoa]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHangHoa()
    {
        return $this->hasOne(HhHangHoa::class, ['id' => 'id_hang_hoa']);
    }

    /**
     * Gets query for [[NhaCungCap]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNhaCungCap()
    {
        return $this->hasOne(NccNhaCungCap::class, ['id' => 'id_nha_cung_cap']);
    }

}
