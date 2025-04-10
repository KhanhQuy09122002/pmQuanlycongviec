<?php

namespace app\models;

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
class CtCongTrinh extends \yii\db\ActiveRecord
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

    /**
     * Gets query for [[CtCaMayThanhToans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCtCaMayThanhToans()
    {
        return $this->hasMany(CtCaMayThanhToan::class, ['id_cong_trinh' => 'id']);
    }

    /**
     * Gets query for [[CtChiPhiKhacThanhToans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCtChiPhiKhacThanhToans()
    {
        return $this->hasMany(CtChiPhiKhacThanhToan::class, ['id_cong_trinh' => 'id']);
    }

    /**
     * Gets query for [[CtGiaTriBaoHanhs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCtGiaTriBaoHanhs()
    {
        return $this->hasMany(CtGiaTriBaoHanh::class, ['id_cong_trinh' => 'id']);
    }

    /**
     * Gets query for [[CtGiaTriDaThanhToans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCtGiaTriDaThanhToans()
    {
        return $this->hasMany(CtGiaTriDaThanhToan::class, ['id_cong_trinh' => 'id']);
    }

    /**
     * Gets query for [[CtGiaTriTamUngs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCtGiaTriTamUngs()
    {
        return $this->hasMany(CtGiaTriTamUng::class, ['id_cong_trinh' => 'id']);
    }

    /**
     * Gets query for [[CtGiaTriThucHienHopDongs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCtGiaTriThucHienHopDongs()
    {
        return $this->hasMany(CtGiaTriThucHienHopDong::class, ['id_cong_trinh' => 'id']);
    }

    /**
     * Gets query for [[CtNhanCongThanhToans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCtNhanCongThanhToans()
    {
        return $this->hasMany(CtNhanCongThanhToan::class, ['id_cong_trinh' => 'id']);
    }

    /**
     * Gets query for [[CtThauPhuThanhToans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCtThauPhuThanhToans()
    {
        return $this->hasMany(CtThauPhuThanhToan::class, ['id_cong_trinh' => 'id']);
    }

    /**
     * Gets query for [[CtVatTuThanhToans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCtVatTuThanhToans()
    {
        return $this->hasMany(CtVatTuThanhToan::class, ['id_cong_trinh' => 'id']);
    }
}
