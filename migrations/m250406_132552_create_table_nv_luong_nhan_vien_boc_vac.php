<?php

use yii\db\Migration;

/**
 * Class m250406_132552_create_table_nv_luong_nhan_vien_boc_vac
 */
class m250406_132552_create_table_nv_luong_nhan_vien_boc_vac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('nv_luong_nhan_vien_boc_vac',[
            'id'=>$this->primaryKey(),
            'id_nhan_vien_boc_vac'=>$this->integer()->notNull(),
            'ngay_thang'=>$this->integer()->notNull(),
            'so_tien'=>$this->integer()->notNull(),
            'ghi_chu'=>$this->text(),
            'da_nhan'=>$this->integer(),
            'nguoi_tao'=>$this->integer(),
            'thoi_gian_tao'=>$this->datetime(),
           ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('nv_luong_nhan_vien_boc_vac');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250406_132552_create_table_nv_luong_nhan_vien_boc_vac cannot be reverted.\n";

        return false;
    }
    */
}
