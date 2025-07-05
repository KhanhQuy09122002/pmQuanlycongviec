<?php

use yii\db\Migration;

/**
 * Class m250406_164313_create_table_ct_gia_tri_bao_hanh
 */
class m250406_164313_create_table_ct_gia_tri_bao_hanh extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('ct_gia_tri_bao_hanh',[
            'id'=>$this->primaryKey(),
            'id_cong_trinh'=>$this->integer()->notNull(),
            'so_tien'=>$this->double()->notNull(),
            'ngay_thang_bao_hanh'=>$this->date()->notNull(),
            'nguoi_tao'=>$this->integer(),
            'thoi_gian_tao'=>$this->datetime(),
           ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('ct_gia_tri_bao_hanh');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250406_164313_create_table_ct_gia_tri_bao_hanh cannot be reverted.\n";

        return false;
    }
    */
}
