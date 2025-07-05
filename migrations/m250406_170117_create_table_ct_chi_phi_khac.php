<?php

use yii\db\Migration;

/**
 * Class m250406_170117_create_table_ct_chi_phi_khac
 */
class m250406_170117_create_table_ct_chi_phi_khac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('ct_chi_phi_khac_thanh_toan',[
            'id'=>$this->primaryKey(),
            'id_cong_trinh'=>$this->integer()->notNull(),
            'ten_chi_phi'=>$this->string()->notNull(),
            'so_tien'=>$this->double()->notNull(),
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
        $this->dropTable('ct_chi_phi_khac_thanh_toan');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250406_170117_create_table_ct_chi_phi_khac cannot be reverted.\n";

        return false;
    }
    */
}
