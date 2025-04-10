<?php

namespace app\modules\congtrinh\models\base;

use Yii;
use app\modules\congtrinh\models\ThauPhuThanhToan;

/**
 * This is the model class for table "ct_thau_phu_thanh_toan_lich_su".
 *
 * @property int $id
 * @property int $id_thau_phu_thanh_toan
 * @property string $ngay_thanh_toan
 * @property int $so_tien
 * @property string|null $ghi_chu
 * @property int|null $nguoi_tao
 * @property string|null $thoi_gian_tao
 *
 * @property CtThauPhuThanhToan $thauPhuThanhToan
 */
class ThauPhuThanhToanLsBase extends \app\models\CtThauPhuThanhToanLichSu 
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
            [['id_thau_phu_thanh_toan', 'so_tien', 'nguoi_tao'], 'integer'],
            [['ngay_thanh_toan', 'thoi_gian_tao'], 'safe'],
            [['ghi_chu'], 'string'],
            [['id_thau_phu_thanh_toan'], 'exist', 'skipOnError' => true, 'targetClass' => ThauPhuThanhToan::class, 'targetAttribute' => ['id_thau_phu_thanh_toan' => 'id']],
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

    public function beforeSave($insert) {
        if ($this->isNewRecord) {
            $this->nguoi_tao = Yii::$app->user->identity->id;
            $this->thoi_gian_tao = date('Y-m-d H:i:s');        
        }
        return parent::beforeSave($insert);
    }
}
