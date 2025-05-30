<?php

namespace app\modules\congtrinh\models\base;

use Yii;
use app\modules\congtrinh\models\CongTrinh;
use app\custom\CustomFunc;
/**
 * This is the model class for table "ct_gia_tri_thuc_hien_hop_dong".
 *
 * @property int $id
 * @property int $id_cong_trinh
 * @property double $so_tien
 * @property string $ngay_thang_bao_lanh
 * @property int|null $nguoi_tao
 * @property string|null $thoi_gian_tao
 *
 * @property CtCongTrinh $congTrinh
 */
class GiaTriThucHienHopDongBase extends \app\models\CtGiaTriThucHienHopDong 
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ct_gia_tri_thuc_hien_hop_dong';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_cong_trinh', 'so_tien', 'ngay_thang_bao_lanh'], 'required'],
            [['id_cong_trinh','nguoi_tao'], 'integer'],
            [['so_tien'],'number'],
            [['ngay_thang_bao_lanh', 'thoi_gian_tao'], 'safe'],
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
            'ngay_thang_bao_lanh' => 'Ngày tháng  bảo lãnh',
            'nguoi_tao' => 'Người tạo',
            'thoi_gian_tao' => 'Thời gian tạo',
        ];
    }
 

    public function beforeSave($insert) {
        $this->ngay_thang_bao_lanh = CustomFunc::convertDMYToYMD($this->ngay_thang_bao_lanh);
        if ($this->isNewRecord) {
            $this->nguoi_tao = Yii::$app->user->identity->id;
            $this->thoi_gian_tao = date('Y-m-d H:i:s');        
        }
        return parent::beforeSave($insert);
    }
}
