<?php

namespace app\modules\khachhang\models\base;

use Yii;
use app\modules\khachhang\models\LoaiKhachHang;
use app\modules\banhang\models\HoaDon;

/**
 * This is the model class for table "kh_khach_hang".
 *
 * @property int $id
 * @property int|null $id_loai_khach_hang
 * @property string $ho_ten
 * @property string|null $so_dien_thoai
 * @property string|null $dia_chi
 * @property string|null $email
 * @property int|null $tong_cong_no
 * @property int|null $da_thanh_toan
 * @property int|null $con_lai
 * @property int|null $nguoi_tao
 * @property string|null $thoi_gian_tao
 *
 * @property KhCongNoKhachHang[] $khCongNoKhachHangs
 * @property KhDonHang[] $khDonHangs
 * @property KhLoaiKhachHang $loaiKhachHang
 */
class KhachHangBase extends \app\models\KhKhachHang 
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ho_ten'], 'required'],
            [['tong_cong_no', 'da_thanh_toan', 'con_lai', 'nguoi_tao'], 'integer'],
            [['thoi_gian_tao'], 'safe'],
            [['ho_ten'], 'string', 'max' => 50],
            [['so_dien_thoai'], 'string', 'max' => 12],
            [['dia_chi'], 'string', 'max' => 255],
        ];
        
        return [
            [['id_loai_khach_hang', 'so_dien_thoai', 'dia_chi', 'email', 'tong_cong_no', 'da_thanh_toan', 'con_lai', 'nguoi_tao', 'thoi_gian_tao'], 'default', 'value' => null],
            [['id_loai_khach_hang', 'tong_cong_no', 'da_thanh_toan', 'con_lai', 'nguoi_tao'], 'integer'],
            [['ho_ten'], 'required'],
            [['thoi_gian_tao'], 'safe'],
            [['ho_ten'], 'string', 'max' => 50],
            [['so_dien_thoai'], 'string', 'max' => 12],
            [['dia_chi'], 'string', 'max' => 255],
            [['email'], 'string', 'max' => 200],
            [['id_loai_khach_hang'], 'exist', 'skipOnError' => true, 'targetClass' => LoaiKhachHang::class, 'targetAttribute' => ['id_loai_khach_hang' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_loai_khach_hang' => 'Loại KH',
            'ho_ten' => 'Họ tên',
            'so_dien_thoai' => 'Số điện thoại',
            'dia_chi' => 'Địa chỉ',
            'tong_cong_no' => 'Tổng công nợ',
            'da_thanh_toan' => 'Đã thanh toán',
            'con_lai' => 'Còn lại',
            'nguoi_tao' => 'Người tạo',
            'thoi_gian_tao' => 'Thời gian tạo',
        ];
    }

    public function beforeSave($insert) {
        if($this->id_loai_khach_hang == null){
            $this->id_loai_khach_hang = 1;//1 is chưa phân loại
        }
        if ($this->isNewRecord) {
            $this->nguoi_tao = Yii::$app->user->identity->id;
            $this->thoi_gian_tao = date('Y-m-d H:i:s');    
        }
        return parent::beforeSave($insert);
    }
    /**
     * Gets query for [[KhCongNoKhachHangs]].
     *
     * @return \yii\db\ActiveQuery
     */
    /* public function getKhCongNoKhachHangs()
    {
        return $this->hasMany(KhCongNoKhachHang::class, ['id_khach_hang' => 'id']);
    }
     */
    /**
     * Gets query for [[KhDonHangs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHoaDons()
    {
        return $this->hasMany(HoaDon::class, ['id_khach_hang' => 'id']);
    }
    /**
     * Gets query for [[LoaiKhachHang]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLoaiKhachHang()
    {
        return $this->hasOne(LoaiKhachHang::class, ['id' => 'id_loai_khach_hang']);
    }
}
