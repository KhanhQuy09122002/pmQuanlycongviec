<?php

use yii\db\Migration;

/**
 * Class m250406_172016_create_fk_cong_trinh
 */
class m250406_172016_create_fk_cong_trinh extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk-tam_ung_cong_trinh',
            'ct_gia_tri_tam_ung',
            'id_cong_trinh',
            'ct_cong_trinh',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-gia_tri_thuc_hien_cong_trinh',
            'ct_gia_tri_thuc_hien_hop_dong',
            'id_cong_trinh',
            'ct_cong_trinh',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-bao_hanh_cong_trinh',
            'ct_gia_tri_bao_hanh',
            'id_cong_trinh',
            'ct_cong_trinh',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-da_thanh_toan_cong_trinh',
            'ct_gia_tri_da_thanh_toan',
            'id_cong_trinh',
            'ct_cong_trinh',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-nhan_cong_cong_trinh',
            'ct_nhan_cong_thanh_toan',
            'id_cong_trinh',
            'ct_cong_trinh',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-vat_tu_cong_trinh',
            'ct_vat_tu_thanh_toan',
            'id_cong_trinh',
            'ct_cong_trinh',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-thau_phu_cong_trinh',
            'ct_thau_phu_thanh_toan',
            'id_cong_trinh',
            'ct_cong_trinh',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-ca_may_cong_trinh',
            'ct_ca_may_thanh_toan',
            'id_cong_trinh',
            'ct_cong_trinh',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-chi_phi_khac_cong_trinh',
            'ct_chi_phi_khac_thanh_toan',
            'id_cong_trinh',
            'ct_cong_trinh',
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
            'fk-tam_ung_cong_trinh',
            'ct_gia_tri_tam_ung'
        );
        $this->dropForeignKey(
            'fk-gia_tri_thuc_hien_cong_trinh',
            'ct_gia_tri_thuc_hien_hop_dong'
        );

        $this->dropForeignKey(
            'fk-bao_hanh_cong_trinh',
            'ct_gia_tri_bao_hanh'
        );
        $this->dropForeignKey(
            'fk-da_thanh_toan_cong_trinh',
            'ct_gia_tri_da_thanh_toan'
        );

        $this->dropForeignKey(
            'fk-nhan_cong_cong_trinh',
            'ct_nhan_cong_thanh_toan'
        );

        $this->dropForeignKey(
            'fk-vat_tu_cong_trinh',
            'ct_vat_tu_thanh_toan'
        );
       
        
        $this->dropForeignKey(
            'fk-thau_phu_cong_trinh',
            'ct_thau_phu_thanh_toan'
        );

        $this->dropForeignKey(
            'fk-ca_may_cong_trinh',
            'ct_ca_may_thanh_toan'
        );

        $this->dropForeignKey(
            'fk-chi_phi_khac_cong_trinh',
            'ct_chi_phi_khac_thanh_toan'
        );
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250406_172016_create_fk_cong_trinh cannot be reverted.\n";

        return false;
    }
    */
}
