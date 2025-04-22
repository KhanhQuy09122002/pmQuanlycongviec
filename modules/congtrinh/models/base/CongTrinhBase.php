<?php

namespace app\modules\congtrinh\models\base;

use Yii;
use app\custom\CustomFunc;
/**
 * This is the model class for table "ct_cong_trinh".
 *
 * @property int $id
 * @property string $ten_cong_trinh
 * @property string $dia_diem
 * @property double|null $gia_tri_hop_dong
 * @property string $thoi_han_hop_dong_tu_ngay
 * @property string $thoi_han_hop_dong_den_ngay
 * @property int|null $gia_tri_tam_ung
 * @property int|null $gia_tri_bao_lanh_thoi_han_hop_dong
 * @property int|null $gia_tri_bao_hanh
 * @property int|null $gia_tri_da_thanh_toan
 * @property int|null $gia_tri_hop_dong_con_lai
 * @property int|null $khoi_luong_phat_sinh_tang_giam
 * @property string|null $trang_thai
 * @property int|null $nguoi_tao
 * @property string|null $thoi_gian_tao
 *
 * @property CtCaMayThanhToan[] $ctCaMayThanhToans
 * @property CtChiPhiKhacThanhToan[] $ctChiPhiKhacThanhToans
 * @property CtGiaTriBaoHanh[] $ctGiaTriBaoHanhs
 * @property CtGiaTriDaThanhToan[] $ctGiaTriDaThanhToans
 * @property CtGiaTriTamUng[] $ctGiaTriTamUngs
 * @property CtGiaTriThucHienHopDong[] $ctGiaTriThucHienHopDongs
 * @property CtNhanCongThanhToan[] $ctNhanCongThanhToans
 * @property CtThauPhuThanhToan[] $ctThauPhuThanhToans
 * @property CtVatTuThanhToan[] $ctVatTuThanhToans
 */
class CongTrinhBase extends \app\models\CtCongTrinh 
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ct_cong_trinh';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ten_cong_trinh', 'dia_diem', 'thoi_han_hop_dong_tu_ngay', 'thoi_han_hop_dong_den_ngay'], 'required'],
            [['gia_tri_tam_ung', 'gia_tri_bao_lanh_thoi_han_hop_dong', 'gia_tri_bao_hanh', 'gia_tri_da_thanh_toan', 'gia_tri_hop_dong_con_lai', 'khoi_luong_phat_sinh_tang_giam', 'nguoi_tao'], 'integer'],
            [['thoi_han_hop_dong_tu_ngay', 'thoi_han_hop_dong_den_ngay', 'thoi_gian_tao'], 'safe'],
            [['gia_tri_hop_dong'], 'number'],
            [['ten_cong_trinh', 'dia_diem'], 'string', 'max' => 255],
            [['trang_thai'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ten_cong_trinh' => 'Tên công trình',
            'dia_diem' => 'Địa điểm',
            'gia_tri_hop_dong' => 'Giá trị hợp đồng',
            'thoi_han_hop_dong_tu_ngay' => 'Thời hạn hợp đồng từ ngày',
            'thoi_han_hop_dong_den_ngay' => 'Thời hạn hợp đồng đến ngày',
            'gia_tri_tam_ung' => 'Gía trị tạm ứng',
            'gia_tri_bao_lanh_thoi_han_hop_dong' => 'Giá trị bảo lãnh thời hạn hợp đồng',
            'gia_tri_bao_hanh' => 'Gía trị bảo hành',
            'gia_tri_da_thanh_toan' => 'Giá trị đã thanh toán',
            'gia_tri_hop_dong_con_lai' => 'Giá trị hợp đồng còn lại',
            'khoi_luong_phat_sinh_tang_giam' => 'Khối lượng phát sinh',
            'trang_thai' => 'Trạng thái',
            'nguoi_tao' => 'Người tạo',
            'thoi_gian_tao' => 'Thời gian tạo',
        ];
    }
    public function beforeSave($insert) {
        $this->thoi_han_hop_dong_tu_ngay = CustomFunc::convertDMYToYMD($this->thoi_han_hop_dong_tu_ngay);
        $this->thoi_han_hop_dong_den_ngay = CustomFunc::convertDMYToYMD($this->thoi_han_hop_dong_den_ngay);
        if ($this->isNewRecord) {
            $this->nguoi_tao = Yii::$app->user->identity->id;
            $this->thoi_gian_tao = date('Y-m-d H:i:s');        
        }
        return parent::beforeSave($insert);
    }
}
