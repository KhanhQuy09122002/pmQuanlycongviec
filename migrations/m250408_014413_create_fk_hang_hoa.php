<?php

use yii\db\Migration;

/**
 * Class m250408_014413_create_fk_hang_hoa
 */
class m250408_014413_create_fk_hang_hoa extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk-chi_tiet-don_hang_kh',
            'kh_chi_tiet_don_hang_kh',
            'id_don_hang',
            'kh_don_hang',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-chi_tiet-don_hang_ncc',
            'ncc_chi_tiet_don_hang_ncc',
            'id_don_hang',
            'ncc_don_hang_nha_cung_cap',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-chi_tiet_don_hang_kh-hang_hoa',
            'kh_chi_tiet_don_hang_kh',  
            'id_hang_hoa',  
            'hh_hang_hoa',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-chi_tiet_don_hang_ncc-hang_hoa',
            'ncc_chi_tiet_don_hang_ncc',  
            'id_hang_hoa',  
            'hh_hang_hoa',
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
            'fk-chi_tiet-don_hang_kh',
            'kh_chi_tiet_don_hang_kh'
        );

        $this->dropForeignKey(
            'fk-chi_tiet-don_hang_ncc',
            'ncc_chi_tiet_don_hang_ncc'
        );
        $this->dropForeignKey(
            'fk-chi_tiet_don_hang_kh-hang_hoa',
            'kh_chi_tiet_don_hang_kh'
        );
        $this->dropForeignKey(
            'fk-chi_tiet_don_hang_ncc-hang_hoa',
            'ncc_chi_tiet_don_hang_ncc'
        );
    }
}
