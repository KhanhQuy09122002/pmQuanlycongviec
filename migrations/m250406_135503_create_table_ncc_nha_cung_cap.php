<?php

use yii\db\Migration;

/**
 * Class m250406_135503_create_table_ncc_nha_cung_cap
 */
class m250406_135503_create_table_ncc_nha_cung_cap extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('ncc_nha_cung_cap',[
            'id'=>$this->primaryKey(),
            'ten_nha_cung_cap'=>$this->string()->notNull(),
            'so_dien_thoai'=>$this->string(12)->notNull(),
            'dia_chi'=>$this->string(),
            'tong_hop_cong_no'=>$this->integer(),
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
        $this->dropTable('ncc_nha_cung_cap');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250406_135503_create_table_ncc_nha_cung_cap cannot be reverted.\n";

        return false;
    }
    */
}
