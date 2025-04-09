<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ncc_cong_no_nha_cung_cap".
 *
 * @property int $id
 * @property int $id_nha_cung_cap
 * @property string $loai_cong_no
 * @property int $so_tien
 * @property string|null $ghi_chu
 * @property string|null $ngay_phat_sinh
 * @property int|null $nguoi_tao
 * @property string|null $thoi_gian_tao
 *
 * @property NccNhaCungCap $nhaCungCap
 */
class NccCongNoNhaCungCap extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ncc_cong_no_nha_cung_cap';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_nha_cung_cap', 'loai_cong_no', 'so_tien'], 'required'],
            [['id_nha_cung_cap', 'so_tien', 'nguoi_tao'], 'integer'],
            [['ghi_chu'], 'string'],
            [['ngay_phat_sinh', 'thoi_gian_tao'], 'safe'],
            [['loai_cong_no'], 'string', 'max' => 255],
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
            'id_nha_cung_cap' => 'Id Nha Cung Cap',
            'loai_cong_no' => 'Loai Cong No',
            'so_tien' => 'So Tien',
            'ghi_chu' => 'Ghi Chu',
            'ngay_phat_sinh' => 'Ngay Phat Sinh',
            'nguoi_tao' => 'Nguoi Tao',
            'thoi_gian_tao' => 'Thoi Gian Tao',
        ];
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
