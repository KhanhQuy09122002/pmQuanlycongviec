<?php

use yii\db\Migration;

/**
 * Class m250408_011841_create_table_kh_chi_tiet_don_hang_kh
 */
class m250408_011841_create_table_kh_chi_tiet_don_hang_kh extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('kh_chi_tiet_don_hang_kh',[
            'id'=>$this->primaryKey(),
            'id_don_hang'=>$this->integer()->notNull(),
            'id_hang_hoa'=>$this->integer()->notNull(),
            'so_luong'=>$this->integer()->notNull(),
            'thanh_tien'=>$this->integer()->notNull(),
            'nguoi_tao'=>$this->integer(),
            'thoi_gian_tao'=>$this->datetime(),
           ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('kh_chi_tiet_don_hang_kh');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250408_011841_create_table_kh_chi_tiet_don_hang_kh cannot be reverted.\n";

        return false;
    }
    */
}
