<?php

namespace app\modules\luongnhanvien\controllers;

use Yii;
use app\modules\luongnhanvien\models\NhanVienBocVac;
use app\modules\luongnhanvien\models\search\NhanVienBocVacSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\filters\AccessControl;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;

/**
 * NhanVienBocVacController implements the CRUD actions for NhanVienBocVac model.
 */
class NhanVienBocVacController extends Controller
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
     * Lists all NhanVienBocVac models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new NhanVienBocVacSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single NhanVienBocVac model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "Nhân viên bóc vác / vận chuyển #".$id,
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
     * Creates a new NhanVienBocVac model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new NhanVienBocVac();
    
        // Hàm xử lý upload
        $handleUpload = function () use ($model) {
            $file = UploadedFile::getInstance($model, 'file'); // ← sử dụng thuộc tính "file"
            if ($file) {
                $dir = Yii::getAlias('@webroot/upImages/');
                if (!is_dir($dir)) {
                    FileHelper::createDirectory($dir, 0775, true);
                }
    
                $fileName = uniqid('nv_') . '.' . $file->extension;
                if ($file->saveAs($dir . $fileName)) {
                    $model->hinh_anh = 'upImages/' . $fileName;
                }
            }
        };
    
        // AJAX request
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
    
            if ($request->isGet) {
                return [
                    'title' => "Thêm nhân viên",
                    'content' => $this->renderAjax('create', ['model' => $model]),
                    'footer' => Html::button('Đóng lại', ['class' => 'btn btn-secondary', 'data-bs-dismiss' => "modal"]) .
                                Html::button('Lưu lại', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            }
    
            if ($model->load($request->post())) {
                $handleUpload();
                if ($model->save()) {
                    return [
                        'forceReload' => '#crud-datatable-pjax',
                        'title' => "Thêm nhân viên",
                        'content' => '<span class="text-success">Thêm thành công !</span>',
                        'footer' => Html::button('Đóng lại', ['class' => 'btn btn-secondary', 'data-bs-dismiss' => "modal"]) .
                                    Html::a('Tiếp tục tạo', ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                    ];
                }
            }
    
            return [
                'title' => "Thêm nhân viên",
                'content' => $this->renderAjax('create', ['model' => $model]),
                'footer' => Html::button('Đóng lại', ['class' => 'btn btn-secondary', 'data-bs-dismiss' => "modal"]) .
                            Html::button('Lưu lại', ['class' => 'btn btn-primary', 'type' => "submit"])
            ];
        }
    
        // Non-AJAX
        if ($model->load($request->post())) {
            $handleUpload();
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
    
        return $this->render('create', ['model' => $model]);
    }
    
    
    /**
     * Updates an existing NhanVienBocVac model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $oldImage = $model->hinh_anh; // Lưu lại ảnh cũ
    
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
    
            if ($request->isGet) {
                return [
                    'title' => "Cập nhật nhân viên #" . $id,
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Đóng lại', ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => "modal"]) .
                                Html::button('Lưu lại', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            } else {
                // Load dữ liệu post
                $model->load($request->post());
    
                // Xử lý file upload
                $file = UploadedFile::getInstance($model, 'file');
                if ($file) {
                    $dir = Yii::getAlias('@webroot/upImages/');
                    FileHelper::createDirectory($dir);
    
                    $fileName = uniqid('nv_') . '.' . $file->extension;
                    if ($file->saveAs($dir . $fileName)) {
                        $model->hinh_anh = 'upImages/' . $fileName;
                    }
                } else {
                    $model->hinh_anh = $oldImage;
                }
    
                if ($model->save(false)) {
                    return [
                        'forceReload' => '#crud-datatable-pjax',
                        'title' => "Nhân viên #" . $id,
                        'content' => $this->renderAjax('view', [
                            'model' => $model,
                        ]),
                        'footer' => Html::button('Đóng lại', ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => "modal"]) .
                                    Html::a('Sửa', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                    ];
                } else {
                    return [
                        'title' => "Cập nhật nhân viên #" . $id,
                        'content' => $this->renderAjax('update', [
                            'model' => $model,
                        ]),
                        'footer' => Html::button('Đóng lại', ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => "modal"]) .
                                    Html::button('Lưu lại', ['class' => 'btn btn-primary', 'type' => "submit"])
                    ];
                }
            }
        } else {
            // Non-Ajax
            if ($model->load($request->post())) {
                $file = UploadedFile::getInstance($model, 'file');
                if ($file) {
                    $dir = Yii::getAlias('@webroot/upImages/');
                    FileHelper::createDirectory($dir);
    
                    $fileName = uniqid('nv_') . '.' . $file->extension;
                    if ($file->saveAs($dir . $fileName)) {
                        $model->hinh_anh = 'upImages/' . $fileName;
                    }
                } else {
                    $model->hinh_anh = $oldImage;
                }
    
                if ($model->save(false)) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
    
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Delete an existing NhanVienBocVac model.
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
     * Delete multiple existing NhanVienBocVac model.
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
     * Finds the NhanVienBocVac model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return NhanVienBocVac the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = NhanVienBocVac::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
