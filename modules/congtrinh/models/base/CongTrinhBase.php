<?php

namespace app\modules\congtrinh\models\base;

use Yii;

/**
 * This is the model class for table "ct_cong_trinh".
 *
 * @property int $id
 * @property string $ten_cong_trinh
 * @property string $dia_diem
 * @property int|null $gia_tri_hop_dong
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
            [['gia_tri_hop_dong', 'gia_tri_tam_ung', 'gia_tri_bao_lanh_thoi_han_hop_dong', 'gia_tri_bao_hanh', 'gia_tri_da_thanh_toan', 'gia_tri_hop_dong_con_lai', 'khoi_luong_phat_sinh_tang_giam', 'nguoi_tao'], 'integer'],
            [['thoi_han_hop_dong_tu_ngay', 'thoi_han_hop_dong_den_ngay', 'thoi_gian_tao'], 'safe'],
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
            'ten_cong_trinh' => 'Ten Cong Trinh',
            'dia_diem' => 'Dia Diem',
            'gia_tri_hop_dong' => 'Gia Tri Hop Dong',
            'thoi_han_hop_dong_tu_ngay' => 'Thoi Han Hop Dong Tu Ngay',
            'thoi_han_hop_dong_den_ngay' => 'Thoi Han Hop Dong Den Ngay',
            'gia_tri_tam_ung' => 'Gia Tri Tam Ung',
            'gia_tri_bao_lanh_thoi_han_hop_dong' => 'Gia Tri Bao Lanh Thoi Han Hop Dong',
            'gia_tri_bao_hanh' => 'Gia Tri Bao Hanh',
            'gia_tri_da_thanh_toan' => 'Gia Tri Da Thanh Toan',
            'gia_tri_hop_dong_con_lai' => 'Gia Tri Hop Dong Con Lai',
            'khoi_luong_phat_sinh_tang_giam' => 'Khoi Luong Phat Sinh Tang Giam',
            'trang_thai' => 'Trang Thai',
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
