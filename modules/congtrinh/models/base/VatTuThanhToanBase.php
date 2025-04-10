<?php

namespace app\modules\congtrinh\models\base;
use Yii;
use app\modules\congtrinh\models\CongTrinh;

/**
 * This is the model class for table "ct_vat_tu_thanh_toan".
 *
 * @property int $id
 * @property int $id_cong_trinh
 * @property string $ten_vat_tu
 * @property int $so_luong
 * @property int $don_gia
 * @property int $thanh_tien
 * @property int|null $nguoi_tao
 * @property string|null $thoi_gian_tao
 *
 * @property CtCongTrinh $congTrinh
 */
class VatTuThanhToanBase extends \app\models\CtVatTuThanhToan 
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ct_vat_tu_thanh_toan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_cong_trinh', 'ten_vat_tu', 'so_luong', 'don_gia', 'thanh_tien'], 'required'],
            [['id_cong_trinh', 'so_luong', 'don_gia', 'thanh_tien', 'nguoi_tao'], 'integer'],
            [['thoi_gian_tao'], 'safe'],
            [['ten_vat_tu'], 'string', 'max' => 255],
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
            'ten_vat_tu' => 'Ten Vat Tu',
            'so_luong' => 'So Luong',
            'don_gia' => 'Don Gia',
            'thanh_tien' => 'Thanh Tien',
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
