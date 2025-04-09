<?php

namespace app\modules\luongnhanvien\models\base;

use Yii;

/**
 * This is the model class for table "nv_nhan_vien_boc_vac".
 *
 * @property int $id
 * @property string $ho_ten
 * @property string $so_dien_thoai
 * @property string $so_cccd
 * @property string|null $hinh_anh
 * @property int $muc_luong
 * @property string|null $trang_thai
 * @property int|null $nguoi_tao
 * @property string|null $thoi_gian_tao
 *
 * @property NvLuongNhanVienBocVac[] $nvLuongNhanVienBocVacs
 */
class NhanVienBocVacBase extends \app\models\NvNhanVienBocVac
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nv_nhan_vien_boc_vac';
    }
    public $file;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ho_ten', 'so_dien_thoai', 'so_cccd', 'muc_luong'], 'required'],
            [['muc_luong', 'nguoi_tao'], 'integer'],
            [['thoi_gian_tao'], 'safe'],
            [['ho_ten', 'hinh_anh'], 'string', 'max' => 255],
            [['so_dien_thoai'], 'string', 'max' => 12],
            [['so_cccd'], 'string', 'max' => 15],
            [['trang_thai'], 'string', 'max' => 30],
            [['file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, gif'],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ho_ten' => 'Họ tên',
            'so_dien_thoai' => 'Số điện thoại',
            'so_cccd' => 'Số CCCD',
            'hinh_anh' => 'Hình ảnh',
            'muc_luong' => 'Mức lương',
            'trang_thai' => 'Trạng thái',
            'nguoi_tao' => 'Người tạo',
            'thoi_gian_tao' => 'Thời gian tạo',
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
