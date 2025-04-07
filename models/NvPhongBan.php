<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "nv_phong_ban".
 *
 * @property int $id
 * @property string $ten_phong_ban
 * @property string $ghi_chu
 *
 * @property NvNhanVien[] $nvNhanViens
 */
class NvPhongBan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nv_phong_ban';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ten_phong_ban', 'ghi_chu'], 'required'],
            [['ghi_chu'], 'string'],
            [['ten_phong_ban'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ten_phong_ban' => 'Ten Phong Ban',
            'ghi_chu' => 'Ghi Chu',
        ];
    }

    /**
     * Gets query for [[NvNhanViens]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNvNhanViens()
    {
        return $this->hasMany(NvNhanVien::class, ['id_phong_ban' => 'id']);
    }
}
