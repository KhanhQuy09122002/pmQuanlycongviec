<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "van_ban".
 *
 * @property int $id
 * @property int $id_loai_van_ban
 * @property string $so_vb
 * @property string $ngay_ky
 * @property string $trich_yeu
 * @property string $nguoi_ky
 * @property string|null $vbden_ngay_den
 * @property int|null $vbden_so_den
 * @property int|null $vbden_nguoi_nhan
 * @property string|null $vbden_ngay_chuyen
 * @property string|null $vbdi_noi_nhan
 * @property int|null $vbdi_so_luong_ban
 * @property string|null $vbdi_ngay_chuyen
 * @property string|null $ghi_chu
 * @property int|null $nguoi_tao
 * @property string|null $thoi_gian_tao
 *
 * @property FileVanBan[] $fileVanBans
 * @property DmLoaiVanBan $loaiVanBan
 * @property VbDinhKem[] $vbDinhKems
 * @property NhanVien $vbdenNguoiNhan
 */
class VanBan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'van_ban';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_loai_van_ban', 'so_vb', 'ngay_ky', 'trich_yeu', 'nguoi_ky'], 'required'],
            [['id_loai_van_ban', 'vbden_so_den', 'vbden_nguoi_nhan', 'vbdi_so_luong_ban', 'nguoi_tao'], 'integer'],
            [['ngay_ky', 'vbden_ngay_den', 'vbden_ngay_chuyen', 'vbdi_ngay_chuyen', 'thoi_gian_tao'], 'safe'],
            [['so_vb', 'trich_yeu', 'nguoi_ky', 'vbdi_noi_nhan', 'ghi_chu'], 'string', 'max' => 255],
            [['id_loai_van_ban'], 'exist', 'skipOnError' => true, 'targetClass' => DmLoaiVanBan::class, 'targetAttribute' => ['id_loai_van_ban' => 'id']],
            [['vbden_nguoi_nhan'], 'exist', 'skipOnError' => true, 'targetClass' => NhanVien::class, 'targetAttribute' => ['vbden_nguoi_nhan' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_loai_van_ban' => 'Id Loai Van Ban',
            'so_vb' => 'So Vb',
            'ngay_ky' => 'Ngay Ky',
            'trich_yeu' => 'Trich Yeu',
            'nguoi_ky' => 'Nguoi Ky',
            'vbden_ngay_den' => 'Vbden Ngay Den',
            'vbden_so_den' => 'Vbden So Den',
            'vbden_nguoi_nhan' => 'Vbden Nguoi Nhan',
            'vbden_ngay_chuyen' => 'Vbden Ngay Chuyen',
            'vbdi_noi_nhan' => 'Vbdi Noi Nhan',
            'vbdi_so_luong_ban' => 'Vbdi So Luong Ban',
            'vbdi_ngay_chuyen' => 'Vbdi Ngay Chuyen',
            'ghi_chu' => 'Ghi Chu',
            'nguoi_tao' => 'Nguoi Tao',
            'thoi_gian_tao' => 'Thoi Gian Tao',
        ];
    }

    /**
     * Gets query for [[FileVanBans]].
     *
     * @return \yii\db\ActiveQuery
     */
    /*
    public function getFileVanBans()
    {
     return $this->hasMany(FileVanBan::class, ['id_van_ban' => 'id']);
    }

    /**
     * Gets query for [[LoaiVanBan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLoaiVanBan()
    {
        return $this->hasOne(DmLoaiVanBan::class, ['id' => 'id_loai_van_ban']);
    }

    /**
     * Gets query for [[VbDinhKems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVbDinhKems()
    {
        return $this->hasMany(VbDinhKem::class, ['id_van_ban' => 'id']);
    }

    /**
     * Gets query for [[VbdenNguoiNhan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVbdenNguoiNhan()
    {
        return $this->hasOne(NhanVien::class, ['id' => 'vbden_nguoi_nhan']);
    }
    
}
