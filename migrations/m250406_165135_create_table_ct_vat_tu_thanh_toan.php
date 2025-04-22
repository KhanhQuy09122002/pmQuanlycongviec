<?php

use yii\db\Migration;

/**
 * Class m250406_165135_create_table_ct_vat_tu_thanh_toan
 */
class m250406_165135_create_table_ct_vat_tu_thanh_toan extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('ct_vat_tu_thanh_toan',[
            'id'=>$this->primaryKey(),
            'id_cong_trinh'=>$this->integer()->notNull(),
            'ten_vat_tu'=>$this->string()->notNull(),
            'so_luong'=>$this->integer()->notNull(),
            'don_vi_tinh'=>$this->string(50),
            'don_gia'=>$this->integer()->notNull(),
            'thanh_tien'=>$this->double()->notNull(),
            'nguoi_tao'=>$this->integer(),
            'thoi_gian_tao'=>$this->datetime(),
           ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('ct_vat_tu_thanh_toan');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250406_165135_create_table_ct_vat_tu_thanh_toan cannot be reverted.\n";

        return false;
    }
    */
}
