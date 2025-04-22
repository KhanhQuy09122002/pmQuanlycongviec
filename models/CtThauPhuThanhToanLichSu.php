<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ct_thau_phu_thanh_toan_lich_su".
 *
 * @property int $id
 * @property int $id_thau_phu_thanh_toan
 * @property string $ngay_thanh_toan
 * @property double $so_tien
 * @property string|null $ghi_chu
 * @property int|null $nguoi_tao
 * @property string|null $thoi_gian_tao
 *
 * @property CtThauPhuThanhToan $thauPhuThanhToan
 */
class CtThauPhuThanhToanLichSu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ct_thau_phu_thanh_toan_lich_su';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_thau_phu_thanh_toan', 'ngay_thanh_toan', 'so_tien'], 'required'],
            [['id_thau_phu_thanh_toan', 'nguoi_tao'], 'integer'],
            [['so_tien'],'number'],
            [['ngay_thanh_toan', 'thoi_gian_tao'], 'safe'],
            [['ghi_chu'], 'string'],
            [['id_thau_phu_thanh_toan'], 'exist', 'skipOnError' => true, 'targetClass' => CtThauPhuThanhToan::class, 'targetAttribute' => ['id_thau_phu_thanh_toan' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_thau_phu_thanh_toan' => 'Id Thau Phu Thanh Toan',
            'ngay_thanh_toan' => 'Ngay Thanh Toan',
            'so_tien' => 'So Tien',
            'ghi_chu' => 'Ghi Chu',
            'nguoi_tao' => 'Nguoi Tao',
            'thoi_gian_tao' => 'Thoi Gian Tao',
        ];
    }

    /**
     * Gets query for [[ThauPhuThanhToan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getThauPhuThanhToan()
    {
        return $this->hasOne(CtThauPhuThanhToan::class, ['id' => 'id_thau_phu_thanh_toan']);
    }
}
