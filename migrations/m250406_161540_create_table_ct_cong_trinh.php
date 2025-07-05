<?php

use yii\db\Migration;

/**
 * Class m250406_161540_create_table_ct_cong_trinh
 */
class m250406_161540_create_table_ct_cong_trinh extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('ct_cong_trinh',[
            'id'=>$this->primaryKey(),
            'ten_cong_trinh'=>$this->string()->notNull(),
            'dia_diem'=>$this->string()->notNull(),
            'gia_tri_hop_dong'=>$this->double(),
            'thoi_han_hop_dong_tu_ngay'=>$this->date()->notNull(),
            'thoi_han_hop_dong_den_ngay'=>$this->date()->notNull(),
            'gia_tri_tam_ung'=>$this->integer(),
            'gia_tri_bao_lanh_thoi_han_hop_dong'=>$this->integer(),
            'gia_tri_bao_hanh'=>$this->integer(),
            'gia_tri_da_thanh_toan'=>$this->integer(),
            'gia_tri_hop_dong_con_lai'=>$this->integer(),
            'khoi_luong_phat_sinh_tang_giam'=>$this->integer(),
            'trang_thai'=>$this->string(30),
            'nguoi_tao'=>$this->integer(),
            'thoi_gian_tao'=>$this->datetime(),
           ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('ct_cong_trinh');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250406_161540_create_table_ct_cong_trinh cannot be reverted.\n";

        return false;
    }
    */
}
