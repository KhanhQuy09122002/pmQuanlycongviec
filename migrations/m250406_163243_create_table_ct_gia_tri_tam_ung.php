<?php

use yii\db\Migration;

/**
 * Class m250406_163243_create_table_ct_gia_tri_tam_ung
 */
class m250406_163243_create_table_ct_gia_tri_tam_ung extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('ct_gia_tri_tam_ung',[
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
        $this->dropTable('ct_gia_tri_tam_ung');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250406_163243_create_table_ct_gia_tri_tam_ung cannot be reverted.\n";

        return false;
    }
    */
}
