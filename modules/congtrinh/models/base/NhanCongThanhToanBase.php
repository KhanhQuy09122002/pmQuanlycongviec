<?php

namespace app\modules\congtrinh\models\base;
use Yii;
use app\modules\congtrinh\models\CongTrinh;
use app\modules\congtrinh\models\NhanCongThanhToanLs;
/**
 * This is the model class for table "ct_nhan_cong_thanh_toan".
 *
 * @property int $id
 * @property int $id_cong_trinh
 * @property string $ho_ten
 * @property string|null $so_hop_dong
 * @property float $tong_hop_dong
 * @property string|null $ghi_chu
 * @property int|null $da_thanh_toan khong xai
 * @property int|null $con_lai khong xai
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
    public function rules()
    {
        return [
            [['so_hop_dong', 'ghi_chu', 'da_thanh_toan', 'con_lai', 'nguoi_tao', 'thoi_gian_tao'], 'default', 'value' => null],
            [['id_cong_trinh', 'ho_ten', 'tong_hop_dong'], 'required'],
            [['id_cong_trinh', 'da_thanh_toan', 'con_lai', 'nguoi_tao'], 'integer'],
            [['tong_hop_dong'], 'number'],
            [['ghi_chu'], 'string'],
            [['thoi_gian_tao'], 'safe'],
            [['ho_ten'], 'string', 'max' => 255],
            [['so_hop_dong'], 'string', 'max' => 250],
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
            'so_hop_dong' => 'Số hợp đồng',
            'ghi_chu' => 'Ghi chú',
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
    
        /* $tongHopDong = $this->tong_hop_dong ?? 0;
        $daThanhToan = $this->da_thanh_toan ?? 0;
    
        $this->con_lai = $tongHopDong - $daThanhToan; */
    
        return parent::beforeSave($insert);
    }
    
    /**
     * Gets query for [[CongTrinh]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCongTrinh()
    {
        return $this->hasOne(CongTrinh::class, ['id' => 'id_cong_trinh']);
    }
    
    /**
     * Gets query for [[CtNhanCongThanhToanLichSus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChiTietThanhToan()
    {
        return $this->hasMany(NhanCongThanhToanLs::class, ['id_nhan_cong_thanh_toan' => 'id']);
    }
    
    public function getTongDaThanhToan(){
        return (float) $this->getChiTietThanhToan()->sum('so_tien');
    }
    
    public function getTongChuaThanhToan(){
        return (float)$this->tong_hop_dong - $this->tongDaThanhToan;
    }

}
