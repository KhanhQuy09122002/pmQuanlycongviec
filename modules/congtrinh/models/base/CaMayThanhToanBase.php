<?php

namespace app\modules\congtrinh\models\base;

use Yii;
use app\modules\congtrinh\models\CongTrinh;
/**
 * This is the model class for table "ct_ca_may_thanh_toan".
 *
 * @property int $id
 * @property int $id_cong_trinh
 * @property string $ten_ca_may
 * @property int $so_tien
 * @property int|null $nguoi_tao
 * @property string|null $thoi_gian_tao
 *
 * @property CtCongTrinh $congTrinh
 */
class CaMayThanhToanBase extends \app\models\CtCaMayThanhToan
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
            [['id_cong_trinh', 'so_tien', 'nguoi_tao'], 'integer'],
            [['thoi_gian_tao'], 'safe'],
            [['ten_ca_may'], 'string', 'max' => 255],
            [['id_cong_trinh'], 'exist', 'skipOnError' => true, 'targetClass' => CongTrinh::class, 'targetAttribute' => ['id_cong_trinh' => 'id']],
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

    public function beforeSave($insert) {
        if ($this->isNewRecord) {
            $this->nguoi_tao = Yii::$app->user->identity->id;
            $this->thoi_gian_tao = date('Y-m-d H:i:s');        
        }
        return parent::beforeSave($insert);
    }
}
