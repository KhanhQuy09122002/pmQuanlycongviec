<?php

use yii\db\Migration;

/**
 * Class m250406_144034_create_fk_nha_cung_cap
 */
class m250406_144034_create_fk_nha_cung_cap extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk-don_hang-nha_cung_cap',
            'ncc_don_hang_nha_cung_cap',
            'id_nha_cung_cap',
            'ncc_nha_cung_cap',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-cong_no-nha_cung_cap',
            'ncc_cong_no_nha_cung_cap',
            'id_nha_cung_cap',
            'ncc_nha_cung_cap',
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
            'fk-don_hang-nha_cung_cap',
            'ncc_don_hang_nha_cung_cap'
        );
        $this->dropForeignKey(
            'fk-cong_no-nha_cung_cap',
            'ncc_cong_no_nha_cung_cap'
        );
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250406_144034_create_fk_nha_cung_cap cannot be reverted.\n";

        return false;
    }
    */
}
