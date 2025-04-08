<?php

use yii\db\Migration;

/**
 * Class m250408_012933_create_table_ncc_chi_tiet_don_hang_ncc
 */
class m250408_012933_create_table_ncc_chi_tiet_don_hang_ncc extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('ncc_chi_tiet_don_hang_ncc',[
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
        $this->dropTable('ncc_chi_tiet_don_hang_ncc');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250408_012933_create_table_ncc_chi_tiet_don_hang_ncc cannot be reverted.\n";

        return false;
    }
    */
}
