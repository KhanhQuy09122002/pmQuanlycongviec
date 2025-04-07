<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "nv_nhan_vien".
 *
 * @property int $id
 * @property int $id_phong_ban
 * @property string $ho_ten
 * @property string|null $chuc_vu
 * @property string|null $so_cccd
 * @property string|null $email
 * @property string|null $so_dien_thoai
 * @property string|null $dia_chi

 * @property int|null $tai_khoan
 * @property string|null $trinh_do
 * @property string|null $trang_thai
 * @property string|null $ngay_sinh
 * @property int|null $gioi_tinh
 * @property int|null nguoi_tao
 * @property string|null thoi_gian_tao 
 *
 * @property NvPhongBan $phongBan
 * @property User $taiKhoan
 */
class NvNhanVien extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nv_nhan_vien';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_phong_ban', 'ho_ten'], 'required'],
            [['id_phong_ban', 'tai_khoan','gioi_tinh','nguoi_taotao'], 'integer'],
      
            [['ho_ten', 'chuc_vu', 'email', 'dia_chi'], 'string', 'max' => 50],
            [['so_cccd'], 'string', 'max' => 15],
            [['thoi_gian_tao','ngay_sinh'], 'safe'],
            [['so_dien_thoai'], 'string', 'max' => 13],
            [['trinh_do', 'trang_thai'], 'string', 'max' => 20],
            [['id_phong_ban'], 'exist', 'skipOnError' => true, 'targetClass' => NvPhongBan::class, 'targetAttribute' => ['id_phong_ban' => 'id']],
            [['tai_khoan'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['tai_khoan' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_phong_ban' => 'Id Phong Ban',
            'ho_ten' => 'Ho Ten',
            'chuc_vu' => 'Chuc Vu',
            'so_cccd' => 'So Cccd',
            'email' => 'Email',
            'so_dien_thoai' => 'So Dien Thoai',
            'dia_chi' => 'Dia Chi',
            'vi_tri_cong_viec' => 'Vi Tri Cong Viec',
            'tai_khoan' => 'Tai Khoan',
            'trinh_do' => 'Trinh Do',
            'trang_thai' => 'Trang Thai',
            'ghi_chu' => 'Ghi Chu',
            'gioi_tinh'=>'Gioi Tinh',
            'nguoi_tao'=>'Nguoi Tao',
            'thoi_gian_tao' =>'Thoi Gian Tao',
        ];
    }

    /**
     * Gets query for [[PhongBan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPhongBan()
    {
        return $this->hasOne(NvPhongBan::class, ['id' => 'id_phong_ban']);
    }

    /**
     * Gets query for [[TaiKhoan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTaiKhoan()
    {
        return $this->hasOne(User::class, ['id' => 'tai_khoan']);
    }
}
