<?php

namespace app\modules\congtrinh\controllers;

use Yii;
use app\modules\congtrinh\models\GiaTriDaThanhToan;
use app\modules\congtrinh\models\search\GiaTriDaThanhToanSearch;
use app\modules\congtrinh\models\CongTrinh;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\filters\AccessControl;

/**
 * GiaTriDaThanhToanController implements the CRUD actions for GiaTriDaThanhToan model.
 */
class GiaTriDaThanhToanController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors() {
		return [
			'access' => [
				'class' => AccessControl::className(),
				'rules' => [
					[
						'actions' => ['index', 'view', 'update','create','delete','bulkdelete'],
						'allow' => true,
						'roles' => ['@'],
					],
				],
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
     * Lists all GiaTriDaThanhToan models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new GiaTriDaThanhToanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single GiaTriDaThanhToan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "GiaTriDaThanhToan #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($id),
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                            Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    /**
     * Creates a new GiaTriDaThanhToan model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($idCT)
    {
        $request = Yii::$app->request;
        $model = new GiaTriDaThanhToan();  
        $modelCT = CongTrinh::find()->where(['id' => $idCT])->one();
        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Thêm",
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
                         'reloadType'=>'GTDTT',
                         'reloadBlock'=>'#gtttContent',
                         'reloadContent'=>$this->renderAjax('_gia_tri_da_thanh_toan', [
                            'modelCT'=>$modelCT,
                            'GTTT' => $modelCT->giaTriDaThanhToan  
                            
                         ]),
                         
                         'tcontent'=>'Thêm giá trị thanh toán thành công!',
                     ];  
                }else{           
                return [
                    'title'=> "Thêm",
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
     * Updates an existing GiaTriDaThanhToan model.
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
                    'title'=> "Cập nhật GiaTriDaThanhToan #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Đóng lại',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                                Html::button('Lưu lại',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceClose'=>true,   
                     'reloadType'=>'GTDTT',
                     'reloadBlock'=>'#gtttContent',
                     'reloadContent'=>$this->renderAjax('_gia_tri_da_thanh_toan', [
                        'modelCT'=>$modelCT,
                        'GTTT' => $modelCT->giaTriDaThanhToan  
                        
                     ]),
                     
                     'tcontent'=>'Cập nhật giá trị thanh toán thành công!',
                 ];    
            }else{
                 return [
                    'title'=> "Cập nhật GiaTriDaThanhToan #".$id,
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
     * Delete an existing GiaTriDaThanhToan model.
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
     * Delete multiple existing GiaTriDaThanhToan model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBulkdelete()
    {        
        $request = Yii::$app->request;
        $pks = explode(',', $request->post( 'pks' )); // Array or selected records primary keys
        foreach ( $pks as $pk ) {
            $model = $this->findModel($pk);
            $model->delete();
        }

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
     * Finds the GiaTriDaThanhToan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return GiaTriDaThanhToan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GiaTriDaThanhToan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
