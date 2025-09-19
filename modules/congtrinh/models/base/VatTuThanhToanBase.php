<?php

namespace app\modules\congtrinh\models\base;
use Yii;
use app\modules\congtrinh\models\CongTrinh;
use app\modules\hanghoa\models\HangHoa;
use app\custom\CustomFunc;

/**
 * This is the model class for table "ct_vat_tu_thanh_toan".
 *
 * @property int $id
 * @property int $id_cong_trinh
 * @property int $id_hang_hoa
 * @property string $ten_vat_tu
 * @property string|null $don_vi_tinh
 * @property float $so_luong
 * @property float $don_gia
 * @property float $thanh_tien
 * @property string|null $ngay_thanh_toan
 * @property string $ghi_chu
 * @property int|null $nguoi_tao
 * @property string|null $thoi_gian_tao
 *
 * @property CtCongTrinh $congTrinh
 * @property HhHangHoa $hangHoa
 */
class VatTuThanhToanBase extends \app\models\CtVatTuThanhToan 
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['don_vi_tinh', 'ngay_thanh_toan', 'nguoi_tao', 'thoi_gian_tao'], 'default', 'value' => null],
            [['id_cong_trinh', 'so_luong', 'don_gia'], 'required'],
            [['id_cong_trinh', 'id_hang_hoa', 'nguoi_tao'], 'integer'],
            [['so_luong', 'don_gia', 'thanh_tien'], 'number'],
            [['ngay_thanh_toan', 'thoi_gian_tao'], 'safe'],
            [['ten_vat_tu'], 'string', 'max' => 255],
            [['don_vi_tinh'], 'string', 'max' => 50],
            [['ghi_chu'], 'string'],
            [['id_hang_hoa'], 'exist', 'skipOnError' => true, 'targetClass' => HangHoa::class, 'targetAttribute' => ['id_hang_hoa' => 'id']],
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
            'id_hang_hoa' => 'Tên vật tư',
            'ten_vat_tu' => 'Tên vật tư',
            'so_luong' => 'Số lượng',
            'don_gia' => 'Đơn giá',
            'thanh_tien' => 'Thành tiền',
            'don_vi_tinh'=>'Đơn vị tính',
            'ngay_thanh_toan' => 'Ngày thanh toán',
            'nguoi_tao' => 'Người tạo',
            'thoi_gian_tao' => 'Thời gian tạo',
            'ghi_chu' => 'Ghi chú'
        ];
    }
    public function beforeSave($insert) {
        $this->ngay_thanh_toan = CustomFunc::convertDMYToYMD($this->ngay_thanh_toan);
        if($this->thanh_tien == null){
            $this->thanh_tien = $this->so_luong*$this->don_gia;
        }
        if ($this->isNewRecord) {
            $this->nguoi_tao = Yii::$app->user->identity->id;
            $this->thoi_gian_tao = date('Y-m-d H:i:s');        
        }
        return parent::beforeSave($insert);
    }
    
    public function getTenVatTu(){
        return $this->hangHoa?$this->hangHoa->ten_hang_hoa:$this->ten_vat_tu;
    }
    
    public function getDonViTinh(){
        return $this->hangHoa?$this->hangHoa->donViTinh->ten_dvt:$this->don_vi_tinh;
    }
    
    public function getTongTienAuto(){
        return $this->so_luong*$this->don_gia;
    }
   
}
