<?php

use yii\db\Migration;

/**
 * Class m250406_170703_create_table_ct_nhan_cong_thanh_toan_ls
 */
class m250406_170703_create_table_ct_nhan_cong_thanh_toan_ls extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('ct_nhan_cong_thanh_toan_lich_su',[
            'id'=>$this->primaryKey(),
            'id_nhan_cong_thanh_toan'=>$this->integer()->notNull(),
            'ngay_thanh_toan'=>$this->date()->notNull(),
            'so_tien'=>$this->double()->notNull(),
            'ghi_chu'=>$this->text(),
            'nguoi_tao'=>$this->integer(),
            'thoi_gian_tao'=>$this->datetime(),
           ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('ct_nhan_cong_thanh_toan_lich_su');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250406_170703_create_table_ct_nhan_cong_thanh_toan_ls cannot be reverted.\n";

        return false;
    }
    */
}
