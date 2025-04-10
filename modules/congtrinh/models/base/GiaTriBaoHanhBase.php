<?php

namespace app\modules\congtrinh\models\base;

use Yii;
use app\modules\congtrinh\models\CongTrinh;
/**
 * This is the model class for table "ct_gia_tri_bao_hanh".
 *
 * @property int $id
 * @property int $id_cong_trinh
 * @property int $so_tien
 * @property string $ngay_thang_bao_hanh
 * @property int|null $nguoi_tao
 * @property string|null $thoi_gian_tao
 *
 * @property CtCongTrinh $congTrinh
 */
class GiaTriBaoHanhBase extends \app\models\CtGiaTriBaoHanh 
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ct_gia_tri_bao_hanh';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_cong_trinh', 'so_tien', 'ngay_thang_bao_hanh'], 'required'],
            [['id_cong_trinh', 'so_tien', 'nguoi_tao'], 'integer'],
            [['ngay_thang_bao_hanh', 'thoi_gian_tao'], 'safe'],
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
            'so_tien' => 'So Tien',
            'ngay_thang_bao_hanh' => 'Ngay Thang Bao Hanh',
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
