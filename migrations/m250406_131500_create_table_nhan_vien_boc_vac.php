<?php

use yii\db\Migration;

/**
 * Class m250406_131500_create_table_nhan_vien_boc_vac
 */
class m250406_131500_create_table_nhan_vien_boc_vac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('nv_nhan_vien_boc_vac',[
            'id'=>$this->primaryKey(),
            'ho_ten'=>$this->string()->notNull(),
            'so_dien_thoai'=>$this->string(12)->notNull(),
            'so_cccd'=>$this->string(15)->notNull(),
            'hinh_anh'=>$this->string(),
            'trang_thai'=>$this->string(30),
            'nguoi_tao'=>$this->integer(),
            'thoi_gian_tao'=>$this->datetime(),
           ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('nv_nhan_vien_boc_vac');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250406_131500_create_table_nhan_vien_boc_vac cannot be reverted.\n";

        return false;
    }
    */
}
