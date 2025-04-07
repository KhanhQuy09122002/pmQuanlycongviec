<?php

use yii\db\Migration;

/**
 * Class m250406_163602_create_table_ct_gia_tri_thuc_hien_hop_dong
 */
class m250406_163602_create_table_ct_gia_tri_thuc_hien_hop_dong extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('ct_gia_tri_thuc_hien_hop_dong',[
            'id'=>$this->primaryKey(),
            'id_cong_trinh'=>$this->integer()->notNull(),
            'so_tien'=>$this->integer()->notNull(),
            'ngay_thang_bao_lanh'=>$this->date()->notNull(),
            'nguoi_tao'=>$this->integer(),
            'thoi_gian_tao'=>$this->datetime(),
           ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('ct_gia_tri_thuc_hien_hop_dong');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250406_163602_create_table_ct_gia_tri_thuc_hien_hop_dong cannot be reverted.\n";

        return false;
    }
    */
}
