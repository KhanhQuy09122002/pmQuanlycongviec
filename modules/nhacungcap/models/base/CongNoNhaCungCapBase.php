<?php

namespace app\modules\nhacungcap\models\base;

use Yii;
use app\modules\nhacungcap\models\NhaCungCap;
use app\custom\CustomFunc;
/**
 * This is the model class for table "ncc_cong_no_nha_cung_cap".
 *
 * @property int $id
 * @property int $id_nha_cung_cap
 * @property string $loai_cong_no
 * @property int $so_tien
 * @property string|null $ghi_chu
 * @property string|null $ngay_phat_sinh
 * @property int|null $nguoi_tao
 * @property string|null $thoi_gian_tao
 *
 * @property NccNhaCungCap $nhaCungCap
 */
class CongNoNhaCungCapBase extends \app\models\NccCongNoNhaCungCap 
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ncc_cong_no_nha_cung_cap';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_nha_cung_cap', 'loai_cong_no', 'so_tien'], 'required'],
            [['id_nha_cung_cap', 'so_tien', 'nguoi_tao'], 'integer'],
            [['ghi_chu'], 'string'],
            [['ngay_phat_sinh', 'thoi_gian_tao'], 'safe'],
            [['loai_cong_no'], 'string', 'max' => 255],
            [['id_nha_cung_cap'], 'exist', 'skipOnError' => true, 'targetClass' => NhaCungCap::class, 'targetAttribute' => ['id_nha_cung_cap' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_nha_cung_cap' => 'Nhà cung cấp',
            'loai_cong_no' => 'Loại công nợ',
            'so_tien' => 'Số tiền',
            'ghi_chu' => 'Ghi chú',
            'ngay_phat_sinh' => 'Ngày phát sinh',
            'nguoi_tao' => 'Người tạo',
            'thoi_gian_tao' => 'Thời gian tạo',
        ];
    }

    public function beforeSave($insert) {
        $this->ngay_phat_sinh = CustomFunc::convertDMYToYMD($this->ngay_phat_sinh);
        if ($this->isNewRecord) {
            $this->nguoi_tao = Yii::$app->user->identity->id;
            $this->thoi_gian_tao = date('Y-m-d H:i:s');        
        }
        return parent::beforeSave($insert);
    }
 
}
