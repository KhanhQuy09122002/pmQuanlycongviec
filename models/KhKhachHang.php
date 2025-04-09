<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kh_khach_hang".
 *
 * @property int $id
 * @property string $ho_ten
 * @property string|null $so_dien_thoai
 * @property string|null $dia_chi
 * @property int|null $tong_cong_no
 * @property int|null $da_thanh_toan
 * @property int|null $con_lai
 * @property int|null $nguoi_tao
 * @property string|null $thoi_gian_tao
 *
 * @property KhCongNoKhachHang[] $khCongNoKhachHangs
 * @property KhDonHang[] $khDonHangs
 */
class KhKhachHang extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kh_khach_hang';
    }

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
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ho_ten' => 'Ho Ten',
            'so_dien_thoai' => 'So Dien Thoai',
            'dia_chi' => 'Dia Chi',
            'tong_cong_no' => 'Tong Cong No',
            'da_thanh_toan' => 'Da Thanh Toan',
            'con_lai' => 'Con Lai',
            'nguoi_tao' => 'Nguoi Tao',
            'thoi_gian_tao' => 'Thoi Gian Tao',
        ];
    }

    /**
     * Gets query for [[KhCongNoKhachHangs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKhCongNoKhachHangs()
    {
        return $this->hasMany(KhCongNoKhachHang::class, ['id_khach_hang' => 'id']);
    }

    /**
     * Gets query for [[KhDonHangs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKhDonHangs()
    {
        return $this->hasMany(KhDonHang::class, ['id_khach_hang' => 'id']);
    }
}
