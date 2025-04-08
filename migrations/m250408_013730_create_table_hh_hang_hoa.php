<?php

use yii\db\Migration;

/**
 * Class m250408_013730_create_table_hh_hang_hoa
 */
class m250408_013730_create_table_hh_hang_hoa extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('hh_hang_hoa',[
            'id'=>$this->primaryKey(),
            'ten_hang_hoa'=>$this->string()->notNull(),
            'ma_hang_hoa'=>$this->string(50),
            'ngay_san_xuat'=>$this->date()->notNull(),
            'so_luong_ton_kho'=>$this->integer(),
            'don_gia'=>$this->integer()->notNull(),
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
        $this->dropTable('hh_hang_hoa');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250408_013730_create_table_hh_hang_hoa cannot be reverted.\n";

        return false;
    }
    */
}
