<?php
namespace app\modules\user\models;

use yii\helpers\ArrayHelper;
use PhpParser\Node\Stmt\Expression;

class User extends UserBase{
    /**
     * get list nhan vien
     */
    public static function getListUsers(){
        $users = User::find()->all();
        return ArrayHelper::map($users, 'id', function($model) {
            return $model->ho_ten . ' (' . $model->username . ')';
        });
    }
    
    /**
     * lay danh sach tai khoan chua duoc lien ket voi nhan vien
     * @param string $tenMacDinh
     * @return array
     */
    public function getListUnused($tenMacDinh=NULL){
        
       
    }
    /**
     * lay ho ten cua user by id_user
     * @param id of user $id
     * @return string
     */
    public static function getHoTenByID($id){
        $model = User::findOne($id);
        if($model)
            return $model->ho_ten;
        else 
            return '';
    }
    
    /**
     * lay nhan vien co lien ket voi tai khoan
     * @return \yii\db\ActiveRecord|array|NULL
     */
    public function getNhanVien(){
        return 'test';
    }
    
    /**
     * hien thi ten nhan vien duoc lien ket voi tai khoan
     * @return string
     */
    public function getTenNhanVien(){
        return 'test';
    }
    
    /**
     * lay id nhan vien duoc lien ket voi tai khoan
     * @return string
     */
    public function getIdNhanVien(){
        return 'test';
    }
    
    /**
     * lay id bo phan duoc lien ket voi tai khoan
     * @return string
     */
    public function getIdBoPhan(){
        return 'test';
    }
    
    /**
     * hien thi chuc vu nhan vien duoc lien ket voi tai khoan
     * @return string
     */
    public function getChucVu(){
        return 'test';
    }
    
    /**
     * hien thi link den bang nhan vien
     * @return string
     */
    public function getShowLinkNhanVien(){
        return 'test';
    }
    
}