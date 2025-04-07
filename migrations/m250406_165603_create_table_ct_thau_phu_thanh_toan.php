<?php

use yii\db\Migration;

/**
 * Class m250406_165603_create_table_ct_thau_phu_thanh_toan
 */
class m250406_165603_create_table_ct_thau_phu_thanh_toan extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('ct_thau_phu_thanh_toan',[
            'id'=>$this->primaryKey(),
            'id_cong_trinh'=>$this->integer()->notNull(),
            'ten_cong_viec'=>$this->string()->notNull(),
            'tong_hop_dong'=>$this->integer()->notNull(),
            'da_thanh_toan'=>$this->integer()->notNull(),
            'con_lai'=>$this->integer()->notNull(),
            'nguoi_tao'=>$this->integer(),
            'thoi_gian_tao'=>$this->datetime(),
           ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('ct_thau_phu_thanh_toan');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250406_165603_create_table_ct_thau_phu_thanh_toan cannot be reverted.\n";

        return false;
    }
    */
}
