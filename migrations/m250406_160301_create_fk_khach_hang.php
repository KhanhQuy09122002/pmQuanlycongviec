<?php

use yii\db\Migration;

/**
 * Class m250406_160301_create_fk_khach_hang
 */
class m250406_160301_create_fk_khach_hang extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk-don_hang-khach_hang',
            'kh_don_hang',
            'id_khach_hang',
            'kh_khach_hang',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-cong_no-khach_hang',
            'kh_cong_no_khach_hang',
            'id_khach_hang',
            'kh_khach_hang',
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
            'fk-don_hang-khach_hang',
            'kh_don_hang'
        );
        $this->dropForeignKey(
            'fk-cong_no-khach_hang',
            'kh_cong_no_khach_hang'
        );
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250406_160301_create_fk_khach_hang cannot be reverted.\n";

        return false;
    }
    */
}
