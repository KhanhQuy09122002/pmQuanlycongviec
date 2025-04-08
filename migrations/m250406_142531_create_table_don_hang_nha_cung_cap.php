<?php

use yii\db\Migration;

/**
 * Class m250406_142531_create_table_don_hang_nha_cung_cap
 */
class m250406_142531_create_table_don_hang_nha_cung_cap extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('ncc_don_hang_nha_cung_cap',[
            'id'=>$this->primaryKey(),
            'id_nha_cung_cap'=>$this->integer()->notNull(),
            'so_don_hang'=>$this->integer()->notNull(),
            'ngay_dat_hang'=>$this->date()->notNull(),
            'tong_tien'=>$this->integer(),
            'da_giao_hang'=>$this->integer(),
            'ngay_giao_hang'=>$this->date(),
            'nguoi_tao'=>$this->integer(),
            'thoi_gian_tao'=>$this->datetime(),
           ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('ncc_don_hang_nha_cung_cap');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250406_142531_create_table_don_hang_nha_cung_cap cannot be reverted.\n";

        return false;
    }
    */
}
