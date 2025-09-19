<?php

namespace app\modules\congtrinh\controllers;

use Yii;
use app\modules\congtrinh\models\NhanCongThanhToanLs;
use app\modules\congtrinh\models\NhanCongThanhToan;
use app\modules\congtrinh\models\search\NhanCongThanhToanLsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\filters\AccessControl;
use app\modules\congtrinh\models\CongTrinh;

/**
 * NhanCongThanhToanLsController implements the CRUD actions for NhanCongThanhToanLs model.
 */
class NhanCongThanhToanLsController extends Controller
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
     * Lists all NhanCongThanhToanLs models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new NhanCongThanhToanLsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single NhanCongThanhToanLs model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "NhanCongThanhToanLs #".$id,
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
     * Creates a new NhanCongThanhToanLs model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($idCongTrinh)
    {
        $request = Yii::$app->request;
        $model = new NhanCongThanhToanLs();  
       
        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Thêm nhân công thanh toán",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'idCongTrinh'=>$idCongTrinh 
                    ]),
                    'footer'=> Html::button('Đóng lại',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                                Html::button('Lưu lại',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->save()){
                  // Lấy danh sách NhanCongThanhToan theo công trình
                  $dsNCTT = NhanCongThanhToan::find()
                  ->where(['id_cong_trinh' => $idCongTrinh])
                  ->all();

               $ids = array_column($dsNCTT, 'id');

               // Tránh lỗi nếu $ids rỗng
               $NCTTLS = [];
                 if (!empty($ids)) {
                  $NCTTLS = NhanCongThanhToanLs::find()
                 ->where(['in', 'id_nhan_cong_thanh_toan', $ids])
                 ->all();
            }
                return [
                    'forceClose'=>true,   
                     'reloadType'=>'CT',
                     'reloadBlock'=>'#ncttlsContent',
                     'reloadContent'=>$this->renderAjax('list', [
                        'idCongTrinh'=>$idCongTrinh,
                        /* 'dsNCTT'=> $dsNCTT,
                        'ids'=> $ids,
                        'NCTTLS'=> $NCTTLS */
                     ]),
                    'reloadType2'=>'NCTT',
                    'reloadBlock2'=>'#ncttContent',
                    'reloadContent2'=>$this->renderAjax('../nhan-cong-thanh-toan/list', [
                        'model'=>CongTrinh::findOne($idCongTrinh),
                    ]),
                     'tcontent'=>'Thêm lS nhân công thanh toán thành công!',
                    'reloadBlockSum'=>'#dThongKeSum',
                    'reloadContentSum'=>$this->renderAjax('../cong-trinh/thong_ke_sum', [
                        'model'=>CongTrinh::findOne($idCongTrinh),
                    ]),
                 ];          
            }else{           
                return [
                    'title'=> "Thêm chi tiết thanh toán nhân công",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'idCongTrinh' => $idCongTrinh
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
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
                    'idCongTrinh' => $idCongTrinh
                ]);
            }
        }
       
    }

    /**
     * Updates an existing NhanCongThanhToanLs model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id, $idCongTrinh)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);       
      
        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Cập nhật chi tiết thanh toán nhân công",
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'idCongTrinh'=>$idCongTrinh,
                    ]),
                    'footer'=> Html::button('Đóng lại',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                                Html::button('Lưu lại',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                  // Lấy danh sách NhanCongThanhToan theo công trình
                 $dsNCTT = NhanCongThanhToan::find()
                   ->where(['id_cong_trinh' => $idCongTrinh])
                   ->all();

                $ids = array_column($dsNCTT, 'id');

                // Tránh lỗi nếu $ids rỗng
                $NCTTLS = [];
                  if (!empty($ids)) {
                   $NCTTLS = NhanCongThanhToanLs::find()
                  ->where(['in', 'id_nhan_cong_thanh_toan', $ids])
                  ->all();
             }
                return [
                    'forceClose'=>true,   
                     'reloadType'=>'CT',
                     'reloadBlock'=>'#ncttlsContent',
                     'reloadContent'=>$this->renderAjax('list', [
                        'idCongTrinh'=>$idCongTrinh,
                        /* 'dsNCTT'=> $dsNCTT,
                        'ids'=> $ids,
                        'NCTTLS'=> $NCTTLS */
                     ]),  
                    'reloadType2'=>'NCTT',
                    'reloadBlock2'=>'#ncttContent',
                    'reloadContent2'=>$this->renderAjax('../nhan-cong-thanh-toan/list', [
                        'model'=>CongTrinh::findOne($idCongTrinh),
                    ]),
                     'tcontent'=>'Cập nhật chi tiết thanh toán nhân công thành công!',
                    'reloadBlockSum'=>'#dThongKeSum',
                    'reloadContentSum'=>$this->renderAjax('../cong-trinh/thong_ke_sum', [
                        'model'=>CongTrinh::findOne($idCongTrinh),
                    ]),
                 ];  
            }else{
                 return [
                    'title'=> "Cập nhật chi tiết nhân công thanh toán",
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
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
     * Delete an existing NhanCongThanhToanLs model.
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
     * Delete multiple existing NhanCongThanhToanLs model.
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
                    $idct = $model->nhanCongThanhToan->id_cong_trinh;
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
                    'reloadBlock'=>'#ncttlsContent',
                    'reloadContent'=>$this->renderAjax('list', [
                        'idCongTrinh'=>$idct,
                        /* 'dsNCTT'=> $dsNCTT,
                         'ids'=> $ids,
                         'NCTTLS'=> $NCTTLS */
                    ]),
                    'reloadType2'=>'NCTT',
                    'reloadBlock2'=>'#ncttContent',
                    'reloadContent2'=>$this->renderAjax('../nhan-cong-thanh-toan/list', [
                        'model'=>$modelCT,
                    ]),
                    'tcontent'=>'Đã xóa chi tiết nhân công thanh toán!',
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
     * Finds the NhanCongThanhToanLs model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return NhanCongThanhToanLs the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = NhanCongThanhToanLs::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
