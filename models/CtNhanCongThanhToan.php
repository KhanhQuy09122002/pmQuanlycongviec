<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ct_nhan_cong_thanh_toan".
 *
 * @property int $id
 * @property int $id_cong_trinh
 * @property string $ho_ten
 * @property double $tong_hop_dong
 * @property double $da_thanh_toan
 * @property double $con_lai
 * @property int|null $nguoi_tao
 * @property string|null $thoi_gian_tao
 *
 * @property CtCongTrinh $congTrinh
 * @property CtNhanCongThanhToanLichSu[] $ctNhanCongThanhToanLichSus
 */
class CtNhanCongThanhToan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ct_nhan_cong_thanh_toan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_cong_trinh', 'ho_ten', 'tong_hop_dong'], 'required'],
            [['id_cong_trinh', 'nguoi_tao'], 'integer'],
            [['tong_hop_dong','da_thanh_toan','con_lai'],'number'],
            [['thoi_gian_tao'], 'safe'],
            [['ho_ten'], 'string', 'max' => 255],
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
            'ho_ten' => 'Ho Ten',
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
     * Gets query for [[CtNhanCongThanhToanLichSus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCtNhanCongThanhToanLichSus()
    {
        return $this->hasMany(CtNhanCongThanhToanLichSu::class, ['id_nhan_cong_thanh_toan' => 'id']);
    }
}
