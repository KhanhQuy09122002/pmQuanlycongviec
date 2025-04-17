<?php

namespace app\modules\congtrinh\controllers;

use Yii;
use app\modules\congtrinh\models\ThauPhuThanhToanLs;
use app\modules\congtrinh\models\ThauPhuThanhToan;
use app\modules\congtrinh\models\search\ThauPhuThanhToanLsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\filters\AccessControl;

/**
 * ThauPhuThanhToanLsController implements the CRUD actions for ThauPhuThanhToanLs model.
 */
class ThauPhuThanhToanLsController extends Controller
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
     * Lists all ThauPhuThanhToanLs models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new ThauPhuThanhToanLsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single ThauPhuThanhToanLs model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "ThauPhuThanhToanLs #".$id,
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
     * Creates a new ThauPhuThanhToanLs model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($idCongTrinh)
    {
        $request = Yii::$app->request;
        $model = new ThauPhuThanhToanLs();  

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
                        'idCongTrinh'=>$idCongTrinh 
                    ]),
                    'footer'=> Html::button('Đóng lại',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                                Html::button('Lưu lại',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->save()){
                // Lấy danh sách NhanCongThanhToan theo công trình
                $dsTPTT = ThauPhuThanhToan::find()
                ->where(['id_cong_trinh' => $idCongTrinh])
                ->all();

             $ids = array_column($dsTPTT, 'id');

             // Tránh lỗi nếu $ids rỗng
             $TPTTLS = [];
               if (!empty($ids)) {
                $TPTTLS = ThauPhuThanhToanLs::find()
               ->where(['in', 'id_thau_phu_thanh_toan', $ids])
               ->all();
          }
              return [
                  'forceClose'=>true,   
                   'reloadType'=>'TPTTLS',
                   'reloadBlock'=>'#tpttlsContent',
                   'reloadContent'=>$this->renderAjax('_thau_phu_thanh_toan_ls', [
                      'idCongTrinh'=>$idCongTrinh,
                      'dsNCTT'=> $dsTPTT,
                      'ids'=> $ids,
                      'TPTTLS'=> $TPTTLS
                   ]),
                   
                   'tcontent'=>'Thêm lS thầu phụ thanh toán thành công!',
               ];          
          }else{           
                return [
                    'title'=> "Create new ThauPhuThanhToanLs",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'idCongTrinh'=>$idCongTrinh 
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
                ]);
            }
        }
       
    }

    /**
     * Updates an existing ThauPhuThanhToanLs model.
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
                    'title'=> "Cập nhật ThauPhuThanhToanLs #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'idCongTrinh'=>$idCongTrinh 
                    ]),
                    'footer'=> Html::button('Đóng lại',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                                Html::button('Lưu lại',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                // Lấy danh sách NhanCongThanhToan theo công trình
                $dsTPTT = ThauPhuThanhToan::find()
                ->where(['id_cong_trinh' => $idCongTrinh])
                ->all();

             $ids = array_column($dsTPTT, 'id');

             // Tránh lỗi nếu $ids rỗng
             $TPTTLS = [];
               if (!empty($ids)) {
                $TPTTLS = ThauPhuThanhToanLs::find()
               ->where(['in', 'id_thau_phu_thanh_toan', $ids])
               ->all();
          }
              return [
                  'forceClose'=>true,   
                   'reloadType'=>'TPTTLS',
                   'reloadBlock'=>'#tpttlsContent',
                   'reloadContent'=>$this->renderAjax('_thau_phu_thanh_toan_ls', [
                      'idCongTrinh'=>$idCongTrinh,
                      'dsNCTT'=> $dsTPTT,
                      'ids'=> $ids,
                      'TPTTLS'=> $TPTTLS
                   ]),
                   
                   'tcontent'=>'Cập nhật lS thầu phụ thanh toán thành công!',
               ];          
          }else{
                 return [
                    'title'=> "Update ThauPhuThanhToanLs #".$id,
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
     * Delete an existing ThauPhuThanhToanLs model.
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
     * Delete multiple existing ThauPhuThanhToanLs model.
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
     * Finds the ThauPhuThanhToanLs model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ThauPhuThanhToanLs the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ThauPhuThanhToanLs::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
