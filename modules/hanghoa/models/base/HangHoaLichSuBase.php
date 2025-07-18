<?php

namespace app\modules\hanghoa\models\base;
use Yii;
use app\modules\hanghoa\models\HangHoa;
use app\modules\nhacungcap\models\NhaCungCap;

/**
 * This is the model class for table "hh_hang_hoa_lich_su".
 *
 * @property int $id
 * @property int $id_hang_hoa
 * @property int|null $id_nha_cung_cap
 * @property string|null $ghi_chu
 * @property float $so_luong số lượng thay đổi tăng/giảm
 * @property float $so_luong_cu
 * @property float $so_luong_moi
 * @property int|null $nguoi_tao
 * @property string|null $thoi_gian_tao
 *
 * @property HhHangHoa $hangHoa
 * @property NccNhaCungCap $nhaCungCap
 */
class HangHoaLichSuBase extends \app\models\HhHangHoaLichSu
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_nha_cung_cap', 'ghi_chu', 'nguoi_tao', 'thoi_gian_tao'], 'default', 'value' => null],
            [['id_hang_hoa', 'so_luong', 'so_luong_cu', 'so_luong_moi', 'ghi_chu'], 'required'],
            [['id_hang_hoa', 'id_nha_cung_cap', 'nguoi_tao'], 'integer'],
            [['ghi_chu'], 'string'],
            [['so_luong', 'so_luong_cu', 'so_luong_moi'], 'number'],
            [['thoi_gian_tao'], 'safe'],
            [['id_hang_hoa'], 'exist', 'skipOnError' => true, 'targetClass' => HangHoa::class, 'targetAttribute' => ['id_hang_hoa' => 'id']],
            [['id_nha_cung_cap'], 'exist', 'skipOnError' => true, 'targetClass' => NhaCungCap::class, 'targetAttribute' => ['id_nha_cung_cap' => 'id']],
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_hang_hoa' => 'Hàng hóa',
            'id_nha_cung_cap' => 'Nhà cung cấp',
            'ghi_chu' => 'Ghi chú',
            'so_luong' => 'Số lượng',
            'so_luong_cu' => 'Số lượng cũ',
            'so_luong_moi' => 'Số lượng mới',
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
    
    /**
     * Gets query for [[HangHoa]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHangHoa()
    {
        return $this->hasOne(HangHoa::class, ['id' => 'id_hang_hoa']);
    }
    
    /**
     * Gets query for [[NhaCungCap]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNhaCungCap()
    {
        return $this->hasOne(NhaCungCap::class, ['id' => 'id_nha_cung_cap']);
    }
    
}