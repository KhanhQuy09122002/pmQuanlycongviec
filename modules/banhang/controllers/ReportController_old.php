<?php

namespace app\modules\banhang\controllers;

use Yii;
use app\modules\banhang\models\HoaDon;
use app\modules\banhang\models\search\HoaDonSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\filters\AccessControl;

/**
 * HoaDonBanHangController implements the CRUD actions for HoaDon model.
 */
class ReportController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'ghost-access'=> [
                'class' => 'webvimark\modules\UserManagement\components\GhostAccessControl',
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
    
    /**
     * in danh sách thống kê
     */
    public function actionRpThongKeBanHang(){
        $request = Yii::$app->request;
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            
            return [
                'title' => "Thống kê bán hàng",
                'content' => $this->renderAjax('rp_thong_ke_ban_hang', [
                    
                ]),
                'footer' => Html::button('Đóng lại', ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => "modal"])
            ];
        }
    }
    
    /**
     * in danh sách thống kê theo hàng hóa
     */
    public function actionRpThongKeTheoHangHoa(){
        $request = Yii::$app->request;
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            
            return [
                'title' => "Thống kê bán hàng",
                'content' => $this->renderAjax('rp_thong_ke_theo_hang_hoa', [
                    
                ]),
                'footer' => Html::button('Đóng lại', ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => "modal"])
            ];
        }
    }
    
}