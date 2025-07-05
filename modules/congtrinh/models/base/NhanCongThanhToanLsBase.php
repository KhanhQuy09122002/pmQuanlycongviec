<?php

namespace app\modules\congtrinh\models\base;

use Yii;
use app\modules\congtrinh\models\NhanCongThanhToan;
use app\custom\CustomFunc;
/**
 * This is the model class for table "ct_nhan_cong_thanh_toan_lich_su".
 *
 * @property int $id
 * @property int $id_nhan_cong_thanh_toan
 * @property string $ngay_thanh_toan
 * @property double $so_tien
 * @property string|null $ghi_chu
 * @property int|null $nguoi_tao
 * @property string|null $thoi_gian_tao
 *
 * @property CtNhanCongThanhToan $nhanCongThanhToan
 */
class NhanCongThanhToanLsBase extends \app\models\CtNhanCongThanhToanLichSu 
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ct_nhan_cong_thanh_toan_lich_su';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_nhan_cong_thanh_toan', 'ngay_thanh_toan', 'so_tien'], 'required'],
            [['id_nhan_cong_thanh_toan', 'nguoi_tao'], 'integer'],
            [['so_tien'],'number'],
            [['ngay_thanh_toan', 'thoi_gian_tao'], 'safe'],
            [['ghi_chu'], 'string'],
            [['id_nhan_cong_thanh_toan'], 'exist', 'skipOnError' => true, 'targetClass' => NhanCongThanhToan::class, 'targetAttribute' => ['id_nhan_cong_thanh_toan' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_nhan_cong_thanh_toan' => 'Nhân công thanh toán',
            'ngay_thanh_toan' => 'Ngày thanh toán',
            'so_tien' => 'Số tiền',
            'ghi_chu' => 'Ghi chú',
            'nguoi_tao' => 'Người tạo',
            'thoi_gian_tao' => 'Thời gian tạo',
        ];
    }

    public function beforeSave($insert) {
        $this->ngay_thanh_toan = CustomFunc::convertDMYToYMD($this->ngay_thanh_toan);
        if ($this->isNewRecord) {
            $this->nguoi_tao = Yii::$app->user->identity->id;
            $this->thoi_gian_tao = date('Y-m-d H:i:s');        
        }
        return parent::beforeSave($insert);
    }

    public function afterSave($insert, $changedAttributes)
    {
      parent::afterSave($insert, $changedAttributes);

       // Tính tổng số tiền từ các bản ghi lịch sử
       $tongDaThanhToan = self::find()
        ->where(['id_nhan_cong_thanh_toan' => $this->id_nhan_cong_thanh_toan])
        ->sum('so_tien');

       // Cập nhật lại vào bảng NhanCongThanhToan
       $nctt = \app\modules\congtrinh\models\NhanCongThanhToan::findOne($this->id_nhan_cong_thanh_toan);
         if ($nctt) {
            $nctt->da_thanh_toan = $tongDaThanhToan;
            $nctt->save(false); 
          }
    }

   }
