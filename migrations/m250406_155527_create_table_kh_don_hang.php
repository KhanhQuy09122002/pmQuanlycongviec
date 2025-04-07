<?php

use yii\db\Migration;

/**
 * Class m250406_155527_create_table_kh_don_hang
 */
class m250406_155527_create_table_kh_don_hang extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('kh_don_hang',[
            'id'=>$this->primaryKey(),
            'id_khach_hang'=>$this->integer()->notNull(),
            'so_don_hang'=>$this->integer()->notNull(),
            'ngay_dat_hang'=>$this->date()->notNull(),
            'ten_hang'=>$this->string()->notNull(),
            'so_luong'=>$this->integer()->notNull(),
            'don_gia'=>$this->integer()->notNull(),
            'thanh_tien'=>$this->integer()->notNull(),
            'ngay_san_xuat'=>$this->date(),
            'da_giao_hang'=>$this->integer(),
            'ngay_giao_hang'=>$this->date(),
            'chi_phi_van_chuyen'=>$this->integer(),
            'nguoi_tao'=>$this->integer(),
            'thoi_gian_tao'=>$this->datetime(),
           ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('kh_don_hang');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250406_155527_create_table_kh_don_hang cannot be reverted.\n";

        return false;
    }
    */
}
