<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ct_ca_may_thanh_toan".
 *
 * @property int $id
 * @property int $id_cong_trinh
 * @property string $ten_ca_may
 * @property double $so_tien
 * @property int|null $nguoi_tao
 * @property string|null $thoi_gian_tao
 *
 * @property CtCongTrinh $congTrinh
 */
class CtCaMayThanhToan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ct_ca_may_thanh_toan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_cong_trinh', 'ten_ca_may', 'so_tien'], 'required'],
            [['id_cong_trinh', 'nguoi_tao'], 'integer'],
            [['so_tien'],'number'],
            [['thoi_gian_tao'], 'safe'],
            [['ten_ca_may'], 'string', 'max' => 255],
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
            'ten_ca_may' => 'Ten Ca May',
            'so_tien' => 'So Tien',
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
}
