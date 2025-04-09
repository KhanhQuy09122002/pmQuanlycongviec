<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "nv_nhan_vien_boc_vac".
 *
 * @property int $id
 * @property string $ho_ten
 * @property string $so_dien_thoai
 * @property string $so_cccd
 * @property string|null $hinh_anh
 * @property int $muc_luong
 * @property string|null $trang_thai
 * @property int|null $nguoi_tao
 * @property string|null $thoi_gian_tao
 *
 * @property NvLuongNhanVienBocVac[] $nvLuongNhanVienBocVacs
 */
class NvNhanVienBocVac extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nv_nhan_vien_boc_vac';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ho_ten', 'so_dien_thoai', 'so_cccd', 'muc_luong'], 'required'],
            [['muc_luong', 'nguoi_tao'], 'integer'],
            [['thoi_gian_tao'], 'safe'],
            [['ho_ten', 'hinh_anh'], 'string', 'max' => 255],
            [['so_dien_thoai'], 'string', 'max' => 12],
            [['so_cccd'], 'string', 'max' => 15],
            [['trang_thai'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ho_ten' => 'Ho Ten',
            'so_dien_thoai' => 'So Dien Thoai',
            'so_cccd' => 'So Cccd',
            'hinh_anh' => 'Hinh Anh',
            'muc_luong' => 'Muc Luong',
            'trang_thai' => 'Trang Thai',
            'nguoi_tao' => 'Nguoi Tao',
            'thoi_gian_tao' => 'Thoi Gian Tao',
        ];
    }

    /**
     * Gets query for [[NvLuongNhanVienBocVacs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNvLuongNhanVienBocVacs()
    {
        return $this->hasMany(NvLuongNhanVienBocVac::class, ['id_nhan_vien_boc_vac' => 'id']);
    }
}
