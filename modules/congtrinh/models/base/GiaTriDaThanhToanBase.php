<?php

namespace app\modules\congtrinh\models\base;

use Yii;
use app\modules\congtrinh\models\CongTrinh;
use app\custom\CustomFunc;
/**
 * This is the model class for table "ct_gia_tri_da_thanh_toan".
 *
 * @property int $id
 * @property int $id_cong_trinh
 * @property float $so_tien
 * @property string|null $ngay_thanh_toan
 * @property string $ten_lan_thanh_toan
 * @property string|null $ghi_chu
 * @property int|null $nguoi_tao
 * @property string|null $thoi_gian_tao
 *
 * @property CtCongTrinh $congTrinh
 */
class GiaTriDaThanhToanBase extends \app\models\CtGiaTriDaThanhToan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_cong_trinh', 'so_tien', 'ten_lan_thanh_toan'], 'required'],
            [['id_cong_trinh', 'nguoi_tao'], 'integer'],
            [['so_tien'],'number'],  
            [['ghi_chu'], 'string'],
            [['ngay_thanh_toan', 'thoi_gian_tao'], 'safe'],
            [['ten_lan_thanh_toan'], 'string', 'max' => 255],
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
            'so_tien' => 'Số tiền',
            'ngay_thanh_toan' => 'Ngày thanh toán',
            'ten_lan_thanh_toan' => 'Tên lần thanh toán',
            'ghi_chu' => 'Ghi chú',
            'nguoi_tao' => 'Người tạo',
            'thoi_gian_tao' => 'Thời gian tạo',
        ];
    }
    public function beforeSave($insert) {
        $this->ngay_thanh_toan = CustomFunc::convertDMYToYMD($this->ngay_thanh_toan);
        if ($this->isNewRecord) {
            $this->nguoi_tao = Yii::$app->user->identity->id;
            $this->thoi_gian_tao = date('Y-m-d H:i:s');        
        }
        return parent::beforeSave($insert);
    }
}
