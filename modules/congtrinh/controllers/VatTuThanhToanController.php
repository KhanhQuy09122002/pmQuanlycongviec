<?php

namespace app\modules\congtrinh\controllers;

use Yii;
use app\modules\congtrinh\models\VatTuThanhToan;
use app\modules\congtrinh\models\search\VatTuThanhToanSearch;
use app\modules\congtrinh\models\CongTrinh;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\filters\AccessControl;
use app\modules\hanghoa\models\HangHoa;

/**
 * VatTuThanhToanController implements the CRUD actions for VatTuThanhToan model.
 */
class VatTuThanhToanController extends Controller
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
	 * lấy thông tin vật tư để tự động điền thông tin
	 * @param int $idkh
	 * @return string[]|NULL[]|string[]
	 */
	public function actionGetVatTuAjax($idvt){
	    Yii::$app->response->format = Response::FORMAT_JSON;
	    $vt = HangHoa::findOne($idvt);
	    if($vt != null){
	        return [
	            'status'=>'success',
	            'vtTenVatTu' => $vt->ten_hang_hoa,
	            'vtDonViTinh' => $vt->donViTinh?$vt->donViTinh->ten_dvt:'',
	            'vtDonGia' => $vt->don_gia
	        ];
	    } else {
	        return ['status'=>'failed'];
	    }
	}

    /**
     * Lists all VatTuThanhToan models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new VatTuThanhToanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single VatTuThanhToan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "VatTuThanhToan #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($id),
                    ]),
                    'footer'=> Html::button('Đóng lại',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                            Html::a('Sửa',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    /**
     * Creates a new VatTuThanhToan model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($idCT)
    {
        $request = Yii::$app->request;
        $model = new VatTuThanhToan();  
        $modelCT = CongTrinh::find()->where(['id' => $idCT])->one();
        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Thêm vật tư thanh toán",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Đóng lại',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                                Html::button('Lưu lại',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if ($model->load($request->post())) {
                $model->id_cong_trinh = $idCT; 
                if ($model->save()) {
                    return [
                        'forceClose'=>true,   
                         'reloadType'=>'CT',
                         'reloadBlock'=>'#vtttContent',
                         'reloadContent'=>$this->renderAjax('list', [
                            'model'=>$modelCT,
                         ]),
                         'tcontent'=>'Thêm giá trị thanh toán thành công!',
                        'reloadBlockSum'=>'#dThongKeSum',
                        'reloadContentSum'=>$this->renderAjax('../cong-trinh/thong_ke_sum', [
                            'model'=>$modelCT,
                        ]),
                     ];  
                }else{           
                return [
                    'title'=> "Thêm vật tư thanh toán",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Đóng lại',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                                Html::button('Lưu lại',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
    }
    }

    /**
     * Updates an existing VatTuThanhToan model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id, $idCT)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);       
        $modelCT = CongTrinh::find()->where(['id' => $idCT])->one();
        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Cập nhật vật tư thanh toán",
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Đóng lại',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                                Html::button('Lưu lại',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceClose'=>true,   
                     'reloadType'=>'CT',
                     'reloadBlock'=>'#vtttContent',
                     'reloadContent'=>$this->renderAjax('list', [
                        'model'=>$modelCT,
                     ]),
                     'tcontent'=>'Cập nhật vật tư thanh toán thành công!',
                    'reloadBlockSum'=>'#dThongKeSum',
                    'reloadContentSum'=>$this->renderAjax('../cong-trinh/thong_ke_sum', [
                        'model'=>$modelCT,
                    ]),
                 ];    
            }else{
                 return [
                    'title'=> "Cập nhật VatTuThanhToan #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Đóng lại',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                                Html::button('Lưu lại',['class'=>'btn btn-primary','type'=>"submit"])
                ];        
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Delete an existing VatTuThanhToan model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $this->findModel($id)->delete();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }

    }

     /**
     * Delete multiple existing VatTuThanhToan model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBulkdelete()
    {        
        $request = Yii::$app->request;
        if($request->isAjax){
            $pks = explode(',', $request->post( 'pks' )); // Array or selected records primary keys
            $idct = null;
            foreach ( $pks as $pk ) {
                $model = $this->findModel($pk);
                if($idct === null){
                    $idct = $model->id_cong_trinh;
                }
                $model->delete();
            }
            /*
             *   Process for ajax request
             */
            Yii::$app->response->format = Response::FORMAT_JSON;
            $modelCT = CongTrinh::findOne($idct);
            if($modelCT){
                return [
                    'forceClose'=>true,
                    'reloadType'=>'CT',
                    'reloadBlock'=>'#vtttContent',
                    'reloadContent'=>$this->renderAjax('list', [
                        'model'=>$modelCT,
                    ]),
                    'tcontent'=>'Đã xóa vật tư thanh toán!',
                    'reloadBlockSum'=>'#dThongKeSum',
                    'reloadContentSum'=>$this->renderAjax('../cong-trinh/thong_ke_sum', [
                        'model'=>$modelCT,
                    ]),
                ];
            } else {
                return [
                    'tcontent'=>'Có lỗi xảy ra!',
                ];
            }
        }
       
    }

    /**
     * Finds the VatTuThanhToan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return VatTuThanhToan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = VatTuThanhToan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
