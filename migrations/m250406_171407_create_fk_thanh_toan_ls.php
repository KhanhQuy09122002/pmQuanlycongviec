<?php

use yii\db\Migration;

/**
 * Class m250406_171407_create_fk_thanh_toan_ls
 */
class m250406_171407_create_fk_thanh_toan_ls extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk-thau_phu_thanh_toan-ls',
            'ct_thau_phu_thanh_toan_lich_su',
            'id_thau_phu_thanh_toan',
            'ct_thau_phu_thanh_toan',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-nhan_cong_thanh_toan-ls',
            'ct_nhan_cong_thanh_toan_lich_su',
            'id_nhan_cong_thanh_toan',
            'ct_nhan_cong_thanh_toan',
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
            'fk-thau_phu_thanh_toan-ls',
            'ct_thau_phu_thanh_toan_lich_su'
        );
        $this->dropForeignKey(
            'fk-nhan_cong_thanh_toan-ls',
            'ct_nhan_cong_thanh_toan_lich_su'
        );
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250406_171407_create_fk_thanh_toan_ls cannot be reverted.\n";

        return false;
    }
    */
}
