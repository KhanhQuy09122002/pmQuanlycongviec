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
* @property string $don_vi_tinh
 * @property int $so_luong
 * @property int $don_gia
 * @property double $thanh_tien
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
            [['id_cong_trinh', 'so_luong', 'don_gia', 'nguoi_tao'], 'integer'],
            [['thanh_tien'],'number'],
            [['thoi_gian_tao'], 'safe'],
            [['ten_vat_tu'], 'string', 'max' => 255],
            [['don_vi_tinh'], 'string', 'max' => 50],
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
            'id_cong_trinh' => 'Công trình',
            'ten_vat_tu' => 'Tên vật tư',
            'so_luong' => 'Số lượng',
            'don_gia' => 'Đơn giá',
            'thanh_tien' => 'Thành tiền',
            'don_vi_tinh'=>'Đơn vị tính',
            'nguoi_tao' => 'Người tạo',
            'thoi_gian_tao' => 'Thời gian tạo',
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
