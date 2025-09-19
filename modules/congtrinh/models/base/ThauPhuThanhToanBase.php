<?php

namespace app\modules\congtrinh\models\base;

use Yii;
use app\modules\congtrinh\models\CongTrinh;
use app\modules\congtrinh\models\ThauPhuThanhToanLs;
/**
 * This is the model class for table "ct_thau_phu_thanh_toan".
 *
 * @property int $id
 * @property int $id_cong_trinh
 * @property string $ten_cong_viec
 * @property string|null $ten_thau_phu
 * @property string|null $so_hop_dong
 * @property float $tong_hop_dong
 * @property int|null $da_thanh_toan khong dung
 * @property string|null $ghi_chu
 * @property int|null $con_lai khong dung
 * @property int|null $nguoi_tao
 * @property string|null $thoi_gian_tao
 *
 * @property CtCongTrinh $congTrinh
 * @property CtThauPhuThanhToanLichSu[] $ctThauPhuThanhToanLichSus
 */
class ThauPhuThanhToanBase extends \app\models\CtThauPhuThanhToan 
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ten_thau_phu', 'so_hop_dong', 'da_thanh_toan', 'ghi_chu', 'con_lai', 'nguoi_tao', 'thoi_gian_tao'], 'default', 'value' => null],
            [['id_cong_trinh', 'ten_cong_viec', 'tong_hop_dong'], 'required'],
            [['id_cong_trinh', 'da_thanh_toan', 'con_lai', 'nguoi_tao'], 'integer'],
            [['tong_hop_dong'], 'number'],
            [['ghi_chu'], 'string'],
            [['thoi_gian_tao'], 'safe'],
            [['ten_cong_viec', 'ten_thau_phu', 'so_hop_dong'], 'string', 'max' => 255],
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
            'ten_cong_viec' => 'Tên công việc',
            'ten_thau_phu' => 'Tên thầu phụ',
            'tong_hop_dong' => 'Tổng hợp đồng',
            'da_thanh_toan' => 'Đã thanh toán',
            'so_hop_dong' => 'Số hợp đồng',
            'ghi_chu' => 'Ghi chú',
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
    
        /* $tongHopDong = $this->tong_hop_dong ?? 0;
        $daThanhToan = $this->da_thanh_toan ?? 0;
    
        $this->con_lai = $tongHopDong - $daThanhToan; */
    
        return parent::beforeSave($insert);
    }
    
    public function getCongTrinh()
    {
        return $this->hasOne(CongTrinh::class, ['id' => 'id_cong_trinh']);
    }
    
    public function getChiTietThanhToan()
    {
        return $this->hasMany(ThauPhuThanhToanLs::class, ['id_thau_phu_thanh_toan' => 'id']);
    }
    
    public function getTongDaThanhToan(){
        return (float) $this->getChiTietThanhToan()->sum('so_tien');
    }
    
    public function getTongChuaThanhToan(){
        return (float)$this->tong_hop_dong - $this->tongDaThanhToan;
    }
    
}
