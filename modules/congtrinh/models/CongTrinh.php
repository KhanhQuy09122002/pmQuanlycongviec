<?php
namespace app\modules\congtrinh\models;

use app\modules\congtrinh\models\base\CongTrinhBase;


class CongTrinh extends CongTrinhBase
{
    /**
     * lấy danh sách ghim bắt đầu
     * @return \yii\db\ActiveQuery
     */
    public static function getListGhimBatDau(){
        return CongTrinh::find()->where(['ghim_index'=>1])->limit(4)->all();
    }
    /**
     * lấy danh sách ghim menu
     * @return \yii\db\ActiveQuery
     */
    public static function getListGhimMenu(){
        return CongTrinh::find()->where(['ghim_menu'=>1])->limit(10)->all();
    }
    
    /**
     * lấy giá trị hợp đồng
     * @return \yii\db\ActiveQuery
     */
    public function getGiaTriHopDong(){
        return $this->gia_tri_hop_dong;
    }
    
    public function getCaMayThanhToan()
    {
        return $this->hasMany(CaMayThanhToan::class, ['id_cong_trinh' => 'id']);
    }

 
    public function getChiPhiKhacThanhToan()
    {
        return $this->hasMany(ChiPhiKhacThanhToan::class, ['id_cong_trinh' => 'id']);
    }

 
    public function getGiaTriBaoHanh()
    {
        return $this->hasMany(GiaTriBaoHanh::class, ['id_cong_trinh' => 'id']);
    }

    public function getGiaTriDaThanhToan()
    {
        return $this->hasMany(GiaTriDaThanhToan::class, ['id_cong_trinh' => 'id']);
    }

 
    public function getGiaTriTamUng()
    {
        return $this->hasMany(GiaTriTamUng::class, ['id_cong_trinh' => 'id']);
    }

    public function getGiaTriThucHienHopDong()
    {
        return $this->hasMany(GiaTriThucHienHopDong::class, ['id_cong_trinh' => 'id']);
    }

   
    public function getNhanCongThanhToan()
    {
        return $this->hasMany(NhanCongThanhToan::class, ['id_cong_trinh' => 'id']);
    }


    public function getThauPhuThanhToan()
    {
        return $this->hasMany(ThauPhuThanhToan::class, ['id_cong_trinh' => 'id']);
    }

    public function getVatTuThanhToan()
    {
        return $this->hasMany(VatTuThanhToan::class, ['id_cong_trinh' => 'id']);
    }
    
    /**
     * tính tổng
     */
    
    //tổng giá trị thực hiện hợp đồng
    public function getTongGiaTriThucHienHopDong(){
        return $this->getGiaTriThucHienHopDong()->sum('so_tien');
    }
    //tổng giá trị tạm ứng
    public function getTongGiaTriTamUng(){
        return $this->getGiaTriTamUng()->sum('so_tien');
    }
    //tổng giá trị bảo hành
    public function getTongGiaTriBaoHanh(){
        return $this->getGiaTriBaoHanh()->sum('so_tien');
    }
    //tổng giá trị đã thanh toán
    public function getTongGiaTriDaThanhToan(){
        return $this->getGiaTriDaThanhToan()->sum('so_tien');
    }
    
    /**
     * tổng cho nhân công thanh toán
     */    
    //tổng nhân công theo hợp đồng
    public function getTongNhanCong(){
        return (float) $this->getNhanCongThanhToan()->sum('tong_hop_dong');
    }
    //tổng nhân công đã thanh toán
    public function getTongNhanCongDaThanhToan(){
        $sum = NhanCongThanhToanLs::find()
            ->alias('t')
            ->innerJoin('ct_nhan_cong_thanh_toan nc', 'nc.id = t.id_nhan_cong_thanh_toan')
            ->where(['nc.id_cong_trinh' => $this->id])
            ->sum('t.so_tien');        
        return (float) $sum;        
    }
    //tổng nhân công chưa thanh toán
    public function getTongNhanCongChuaThanhToan(){
        return $this->tongNhanCong - $this->tongNhanCongDaThanhToan;
    }
    /**
     * tổng cho thầu phụ thanh toán
     */
    //tổng thầu phụ theo hợp đồng
    public function getTongThauPhu(){
        return (float) $this->getThauPhuThanhToan()->sum('tong_hop_dong');
    }
    //tổng thầu phụ đã thanh toán
    public function getTongThauPhuDaThanhToan(){
        $sum = ThauPhuThanhToanLs::find()
            ->alias('t')
            ->innerJoin('ct_thau_phu_thanh_toan nc', 'nc.id = t.id_thau_phu_thanh_toan')
            ->where(['nc.id_cong_trinh' => $this->id])
            ->sum('t.so_tien');        
        return (float) $sum;
    }
    
    //tổng vật tư thanh toán
    public function getTongVatTuThanhToan(){
        return $this->getVatTuThanhToan()->sum('thanh_tien');
    }
    //tổng thầu phụ chưa thanh toán
    public function getTongThauPhuChuaThanhToan(){
        return $this->tongThauPhu - $this->tongThauPhuDaThanhToan;
    } 
    
    //tổng ca máy
    public function getTongCaMayThanhToan(){
        return $this->getCaMayThanhToan()->sum('so_tien');
    }
    
    //tổng chi phi khác
    public function getTongChiPhiKhac(){
        return $this->getChiPhiKhacThanhToan()->sum('so_tien');
    }
   
}