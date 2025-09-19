<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ct_thau_phu_thanh_toan".
 *
 * @property int $id
 * @property int $id_cong_trinh
 * @property string $ten_cong_viec
 * @property string|null $ten_thau_phu
 * @property string|null $so_hop_dong
 * @property float $tong_hop_dong
 * @property int|null $da_thanh_toan khong dung
 * @property string|null $ghi_chu
 * @property int|null $con_lai khong dung
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
            [['ten_thau_phu', 'so_hop_dong', 'da_thanh_toan', 'ghi_chu', 'con_lai', 'nguoi_tao', 'thoi_gian_tao'], 'default', 'value' => null],
            [['id_cong_trinh', 'ten_cong_viec', 'tong_hop_dong'], 'required'],
            [['id_cong_trinh', 'da_thanh_toan', 'con_lai', 'nguoi_tao'], 'integer'],
            [['tong_hop_dong'], 'number'],
            [['ghi_chu'], 'string'],
            [['thoi_gian_tao'], 'safe'],
            [['ten_cong_viec', 'ten_thau_phu', 'so_hop_dong'], 'string', 'max' => 255],
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
            'ten_thau_phu' => 'Ten Thau Phu',
            'so_hop_dong' => 'So Hop Dong',
            'tong_hop_dong' => 'Tong Hop Dong',
            'da_thanh_toan' => 'Da Thanh Toan',
            'ghi_chu' => 'Ghi Chu',
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
