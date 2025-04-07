<?php

use yii\db\Migration;

/**
 * Class m250406_143526_create_table_ncc_cong_no_nha_cung_cap
 */
class m250406_143526_create_table_ncc_cong_no_nha_cung_cap extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('ncc_cong_no_nha_cung_cap',[
            'id'=>$this->primaryKey(),
            'id_nha_cung_cap'=>$this->integer()->notNull(),
            'loai_cong_no'=>$this->string()->notNull(),
            'so_tien'=>$this->integer()->notNull(),
            'ghi_chu'=>$this->text(),
            'ngay_phat_sinh'=>$this->date(),
            'nguoi_tao'=>$this->integer(),
            'thoi_gian_tao'=>$this->datetime(),
           ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('ncc_cong_no_nha_cung_cap');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250406_143526_create_table_ncc_cong_no_nha_cung_cap cannot be reverted.\n";

        return false;
    }
    */
}
