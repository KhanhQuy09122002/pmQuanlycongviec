<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ct_thau_phu_thanh_toan".
 *
 * @property int $id
 * @property int $id_cong_trinh
 * @property string $ten_cong_viec
 * @property int $tong_hop_dong
 * @property int $da_thanh_toan
 * @property int $con_lai
 * @property int|null $nguoi_tao
 * @property string|null $thoi_gian_tao
 *
 * @property CtCongTrinh $congTrinh
 * @property CtThauPhuThanhToanLichSu[] $ctThauPhuThanhToanLichSus
 */
class CtThauPhuThanhToan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ct_thau_phu_thanh_toan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_cong_trinh', 'ten_cong_viec', 'tong_hop_dong', 'da_thanh_toan', 'con_lai'], 'required'],
            [['id_cong_trinh', 'tong_hop_dong', 'da_thanh_toan', 'con_lai', 'nguoi_tao'], 'integer'],
            [['thoi_gian_tao'], 'safe'],
            [['ten_cong_viec'], 'string', 'max' => 255],
            [['id_cong_trinh'], 'exist', 'skipOnError' => true, 'targetClass' => CtCongTrinh::class, 'targetAttribute' => ['id_cong_trinh' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_cong_trinh' => 'Id Cong Trinh',
            'ten_cong_viec' => 'Ten Cong Viec',
            'tong_hop_dong' => 'Tong Hop Dong',
            'da_thanh_toan' => 'Da Thanh Toan',
            'con_lai' => 'Con Lai',
            'nguoi_tao' => 'Nguoi Tao',
            'thoi_gian_tao' => 'Thoi Gian Tao',
        ];
    }

    /**
     * Gets query for [[CongTrinh]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCongTrinh()
    {
        return $this->hasOne(CtCongTrinh::class, ['id' => 'id_cong_trinh']);
    }

    /**
     * Gets query for [[CtThauPhuThanhToanLichSus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCtThauPhuThanhToanLichSus()
    {
        return $this->hasMany(CtThauPhuThanhToanLichSu::class, ['id_thau_phu_thanh_toan' => 'id']);
    }
}
