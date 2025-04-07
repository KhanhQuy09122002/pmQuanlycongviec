<?php

use yii\db\Migration;

/**
 * Class m250406_153034_create_table_kh_khach_hang
 */
class m250406_153034_create_table_kh_khach_hang extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('kh_khach_hang',[
            'id'=>$this->primaryKey(),
            'ho_ten'=>$this->string(50)->notNull(),
            'so_dien_thoai'=>$this->string(12),
            'dia_chi'=>$this->string(),
            'tong_cong_no'=>$this->integer(),
            'da_thanh_toan'=>$this->integer(),
            'con_lai'=>$this->integer(),
            'nguoi_tao'=>$this->integer(),
            'thoi_gian_tao'=>$this->datetime(),
           ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('kh_khach_hang');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250406_153034_create_table_kh_khach_hang cannot be reverted.\n";

        return false;
    }
    */
}
