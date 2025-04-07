<?php

use yii\db\Migration;

/**
 * Class m250406_133847_create_fk_tb_luong_nhan_vien_boc_vac
 */
class m250406_133847_create_fk_tb_luong_nhan_vien_boc_vac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk-id_nhan_vien_boc_vac',
            'nv_luong_nhan_vien_boc_vac',
            'id_nhan_vien_boc_vac',
            'nv_nhan_vien_boc_vac',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-id_nhan_vien_boc_vac',
            'nv_luong_nhan_vien_boc_vac'
        );
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250406_133847_create_fk_tb_luong_nhan_vien_boc_vac cannot be reverted.\n";

        return false;
    }
    */
}
