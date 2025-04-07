<?php

use yii\db\Migration;

/**
 * Class m250406_160010_create_table_kh_cong_no
 */
class m250406_160010_create_table_kh_cong_no extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('kh_cong_no_khach_hang',[
            'id'=>$this->primaryKey(),
            'id_khach_hang'=>$this->integer()->notNull(),
            'loai_cong_no'=>$this->string()->notNull(),
            'so_tien'=>$this->integer()->notNull(),
            'ghi_chu'=>$this->text(),
            'ngay_phat_sinh'=>$this->date(),
            'nguoi_tao'=>$this->integer(),
            'thoi_gian_tao'=>$this->datetime(),
           ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('kh_cong_no_khach_hang');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250406_160010_create_table_kh_cong_no cannot be reverted.\n";

        return false;
    }
    */
}
