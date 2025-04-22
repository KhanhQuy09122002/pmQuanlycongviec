<?php

use yii\db\Migration;

/**
 * Class m250406_170352_create_ct_nhan_cong_thanh_toan
 */
class m250406_170352_create_ct_nhan_cong_thanh_toan extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('ct_nhan_cong_thanh_toan',[
            'id'=>$this->primaryKey(),
            'id_cong_trinh'=>$this->integer()->notNull(),
            'ho_ten'=>$this->string()->notNull(),
            'tong_hop_dong'=>$this->double()->notNull(),
            'da_thanh_toan'=>$this->double(),
            'con_lai'=>$this->double(),
            'nguoi_tao'=>$this->integer(),
            'thoi_gian_tao'=>$this->datetime(),
           ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('ct_nhan_cong_thanh_toan');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250406_170352_create_ct_nhan_cong_thanh_toan cannot be reverted.\n";

        return false;
    }
    */
}
