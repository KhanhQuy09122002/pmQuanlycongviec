<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "nv_luong_nhan_vien_boc_vac".
 *
 * @property int $id
 * @property int $id_nhan_vien_boc_vac
 * @property string $ngay_thang
 * @property int $so_ngay_lam
 * @property int $so_tien
 * @property string|null $ghi_chu
 * @property int|null $da_nhan
 * @property int|null $nguoi_tao
 * @property string|null $thoi_gian_tao
 *
 * @property NvNhanVienBocVac $nhanVienBocVac
 */
class NvLuongNhanVienBocVac extends \yii\db\ActiveRecord
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
            [['id_nhan_vien_boc_vac', 'ngay_thang', 'so_tien','so_ngay_lam'], 'required'],
            [['id_nhan_vien_boc_vac', 'so_tien', 'da_nhan', 'nguoi_tao'], 'integer'],
            [['thoi_gian_tao','ghi_chu','ngay_thang'], 'safe'],
            [['id_nhan_vien_boc_vac'], 'exist', 'skipOnError' => true, 'targetClass' => NvNhanVienBocVac::class, 'targetAttribute' => ['id_nhan_vien_boc_vac' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_nhan_vien_boc_vac' => 'Id Nhan Vien Boc Vac',
            'ngay_thang' => 'Ngay Thang',
            'so_ngay_lam'=>'So Ngay Lam',
            'so_tien' => 'So Tien',
            'da_nhan' => 'Da Nhan',
            'ghi_chu'=>'Ghi Chu',
            'nguoi_tao' => 'Nguoi Tao',
            'thoi_gian_tao' => 'Thoi Gian Tao',
        ];
    }

    /**
     * Gets query for [[NhanVienBocVac]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNhanVienBocVac()
    {
        return $this->hasOne(NvNhanVienBocVac::class, ['id' => 'id_nhan_vien_boc_vac']);
    }
}
