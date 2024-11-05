<?php

namespace app\modules\thuexe\models;

use Yii;
use app\custom\CustomFunc;
use app\modules\hocvien\models\HocVien;
use app\modules\nhanvien\models\NhanVien;

/**
 * This is the model class for table "ptx_nop_phi_thue_xe".
 *
 * @property int $id
 * @property int|null $id_phieu_thue_xe
 * @property int|null $id_hoc_vien
 * @property string|null $ho_ten_nguoi_thue
 * @property string|null $so_cccd_nguoi_thue
 * @property string|null $dia_chi_nguoi_thue
 * @property string|null $so_dien_thoai_nguoi_thue
 * @property float|null $so_tien_nop
 * @property int|null $nguoi_thu
 * @property string|null $bien_lai
 * @property string|null $ngay_nop
 * @property int|null $nguoi_tao
 * @property int|null $thoi_gian_tao
 */
class NopPhiThueXe extends \app\models\PtxNopPhiThueXe
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ptx_nop_phi_thue_xe';
    }
    public $file;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_phieu_thue_xe', 'id_hoc_vien', 'nguoi_thu', 'nguoi_tao', 'thoi_gian_tao'], 'integer'],
            [['so_tien_nop'], 'number'],
            [['ngay_nop'], 'safe'],
            [['ho_ten_nguoi_thue'], 'string', 'max' => 50],
            [['so_cccd_nguoi_thue'], 'string', 'max' => 15],
            [['dia_chi_nguoi_thue', 'bien_lai'], 'string', 'max' => 255],
            [['so_dien_thoai_nguoi_thue'], 'string', 'max' => 12],
            [['file'], 'file','extensions' => 'png, jpg, jfif'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_phieu_thue_xe' => 'Id Phieu Thue Xe',
            'id_hoc_vien' => 'Học viên',
            'ho_ten_nguoi_thue' => 'Họ tên người thuê',
            'so_cccd_nguoi_thue' => 'Số CCCD người thuê',
            'dia_chi_nguoi_thue' => 'Địa chỉ người thuê',
            'so_dien_thoai_nguoi_thue' => 'Số điện thoại người thuê',
            'so_tien_nop' => 'Phí thuê',
            'nguoi_thu' => 'Người thu',
            'bien_lai' => 'Biên lai',
            'ngay_nop' => 'Ngày thu',
            'nguoi_tao' => 'Người tạo',
            'thoi_gian_tao' => 'Thời gian tạo',
            'file' => 'Chọn biên lai',
        ];
    }
    public function beforeSave($insert)
    {     
        $this->ngay_nop = CustomFunc::convertDMYToYMD($this->ngay_nop);   
        if ($this->isNewRecord) {
            $this->nguoi_tao = Yii::$app->user->identity->id;
            $this->thoi_gian_tao = date('Y-m-d H:i:s'); 
            if (!empty($this->id_phieu_thue_xe)) {
                $phieuThueXe = PhieuThueXe::findOne($this->id_phieu_thue_xe);
                if ($phieuThueXe && $phieuThueXe->chi_phi_thue_phat_sinh === null) {
                    $this->trang_thai = 'Phí thuê xe'; 
                }
                if ($phieuThueXe && $phieuThueXe ->chi_phi_thue_phat_sinh > 0)
                {
                    $this->trang_thai = 'Phí phát sinh';
                }
                if ($phieuThueXe && $phieuThueXe ->chi_phi_thue_phat_sinh === 0)
                {
                    $this->trang_thai = 'Không tồn tại phí phát sinh';
                }
                
            }
        }
        return parent::beforeSave($insert);
    }

    public function getHocVien()
     {
         return $this->hasOne(HocVien::class, ['id' => 'id_hoc_vien']);
     }
     public function getNguoiThu()
     {
        return $this->hasOne(NhanVien:: class, ['id'=>'nguoi_thu']);
     }
    

    
}
