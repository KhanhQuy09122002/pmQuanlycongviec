<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ct_nhan_cong_thanh_toan_lich_su".
 *
 * @property int $id
 * @property int $id_nhan_cong_thanh_toan
 * @property string $ngay_thanh_toan
 * @property int $so_tien
 * @property string|null $ghi_chu
 * @property int|null $nguoi_tao
 * @property string|null $thoi_gian_tao
 *
 * @property CtNhanCongThanhToan $nhanCongThanhToan
 */
class CtNhanCongThanhToanLichSu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ct_nhan_cong_thanh_toan_lich_su';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_nhan_cong_thanh_toan', 'ngay_thanh_toan', 'so_tien'], 'required'],
            [['id_nhan_cong_thanh_toan', 'so_tien', 'nguoi_tao'], 'integer'],
            [['ngay_thanh_toan', 'thoi_gian_tao'], 'safe'],
            [['ghi_chu'], 'string'],
            [['id_nhan_cong_thanh_toan'], 'exist', 'skipOnError' => true, 'targetClass' => CtNhanCongThanhToan::class, 'targetAttribute' => ['id_nhan_cong_thanh_toan' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_nhan_cong_thanh_toan' => 'Id Nhan Cong Thanh Toan',
            'ngay_thanh_toan' => 'Ngay Thanh Toan',
            'so_tien' => 'So Tien',
            'ghi_chu' => 'Ghi Chu',
            'nguoi_tao' => 'Nguoi Tao',
            'thoi_gian_tao' => 'Thoi Gian Tao',
        ];
    }

    /**
     * Gets query for [[NhanCongThanhToan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNhanCongThanhToan()
    {
        return $this->hasOne(CtNhanCongThanhToan::class, ['id' => 'id_nhan_cong_thanh_toan']);
    }
}
