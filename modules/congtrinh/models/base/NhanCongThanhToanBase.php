<?php

namespace app\modules\congtrinh\models\base;
use Yii;
use app\modules\congtrinh\models\CongTrinh;
/**
 * This is the model class for table "ct_nhan_cong_thanh_toan".
 *
 * @property int $id
 * @property int $id_cong_trinh
 * @property string $ho_ten
 * @property double $tong_hop_dong
 * @property double $da_thanh_toan
 * @property double $con_lai
 * @property int|null $nguoi_tao
 * @property string|null $thoi_gian_tao
 *
 * @property CtCongTrinh $congTrinh
 * @property CtNhanCongThanhToanLichSu[] $ctNhanCongThanhToanLichSus
 */
class NhanCongThanhToanBase extends \app\models\CtNhanCongThanhToan 
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ct_nhan_cong_thanh_toan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_cong_trinh', 'ho_ten', 'tong_hop_dong'], 'required'],
            [['id_cong_trinh', 'nguoi_tao'], 'integer'],
            [['tong_hop_dong','da_thanh_toan','con_lai'],'number'],
            [['thoi_gian_tao'], 'safe'],
            [['ho_ten'], 'string', 'max' => 255],
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
            'ho_ten' => 'Họ tên',
            'tong_hop_dong' => 'Tổng hợp đồng',
            'da_thanh_toan' => 'Đã thanh toán',
            'con_lai' => 'Còn lại',
            'nguoi_tao' => 'Người tạo',
            'thoi_gian_tao' => 'Thời gian tạo',
        ];
    }
    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            $this->nguoi_tao = Yii::$app->user->identity->id;
            $this->thoi_gian_tao = date('Y-m-d H:i:s');        
        }
    
        $tongHopDong = $this->tong_hop_dong ?? 0;
        $daThanhToan = $this->da_thanh_toan ?? 0;
    
        $this->con_lai = $tongHopDong - $daThanhToan;
    
        return parent::beforeSave($insert);
    }
    

}
