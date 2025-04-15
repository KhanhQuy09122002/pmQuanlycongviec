<?php

namespace app\modules\luongnhanvien\controllers;

use Yii;
use app\modules\luongnhanvien\models\LuongNhanVienBocVac;
use app\modules\luongnhanvien\models\search\LuongNhanVienBocVacSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\filters\AccessControl;
use app\modules\luongnhanvien\models\NhanVienBocVac;

use yii\base\DynamicModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


/**
 * LuongNhanVienBocVacController implements the CRUD actions for LuongNhanVienBocVac model.
 */
class LuongNhanVienBocVacController extends Controller
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
						'actions' => ['index', 'view', 'update','create','delete','bulkdelete','get-luong','choose-print','choose-excel','get-print-content','export-excel'],
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
     * Lists all LuongNhanVienBocVac models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new LuongNhanVienBocVacSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single LuongNhanVienBocVac model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "Tính lương #".$id,
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
     * Creates a new LuongNhanVienBocVac model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new LuongNhanVienBocVac();  

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Tính lương",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Đóng lại',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                                Html::button('Lưu lại',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Tính lương",
                    'content'=>'<span class="text-success">Thêm lương thành công !</span>',
                    'footer'=> Html::button('Đóng lại',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                            Html::a('Tiếp tục tạo',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> "Tính lương",
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

    /**
     * Updates an existing LuongNhanVienBocVac model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
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
                    'title'=> "Cập nhật #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Đóng lại',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                                Html::button('Lưu lại',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Lương nhân viên #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Đóng lại',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                            Html::a('Sửa',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Cập nhật #".$id,
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
     * Delete an existing LuongNhanVienBocVac model.
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
     * Delete multiple existing LuongNhanVienBocVac model.
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
     * Finds the LuongNhanVienBocVac model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return LuongNhanVienBocVac the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LuongNhanVienBocVac::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    public function actionGetLuong($id)
{
    Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    $nhanVien = NhanVienBocVac::findOne($id);
    if ($nhanVien) {
        return ['muc_luong' => $nhanVien->muc_luong];
    }
    return ['muc_luong' => 0];
}

public function actionChoosePrint()
{
    $request = Yii::$app->request;
    $model = new \yii\base\DynamicModel(['id_nhan_vien', 'thang', 'tu_ngay', 'den_ngay']);
    $model->addRule(['id_nhan_vien'], 'required')
          ->addRule(['thang', 'tu_ngay', 'den_ngay'], 'safe');

    $nhanVienList = \yii\helpers\ArrayHelper::map(
        NhanVienBocVac::find()->all(), 
        'id', 
        'ho_ten'
    );

    if ($request->isAjax) {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return [
            'title' => 'Chọn thông tin để in',
            'content' => $this->renderAjax('_form_choose_print', [
                'model' => $model,
                'nhanVienList' => $nhanVienList
            ]),
            'footer' => 
                Html::button('Đóng lại', ['class'=>'btn btn-secondary', 'data-bs-dismiss'=>'modal']) 
               
        ];
    }

    return $this->render('_form_choose_print', [
        'model' => $model,
        'nhanVienList' => $nhanVienList
    ]);
}


public function actionChooseExcel()
{
    $request = Yii::$app->request;
    $model = new \yii\base\DynamicModel(['id_nhan_vien', 'thang', 'tu_ngay', 'den_ngay']);
    $model->addRule(['id_nhan_vien'], 'required')
          ->addRule(['thang', 'tu_ngay', 'den_ngay'], 'safe');

    $nhanVienList = \yii\helpers\ArrayHelper::map(
        NhanVienBocVac::find()->all(), 
        'id', 
        'ho_ten'
    );

    if ($request->isAjax) {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return [
            'title' => 'Chọn thông tin để in',
            'content' => $this->renderAjax('_form_choose_excel', [
                'model' => $model,
                'nhanVienList' => $nhanVienList
            ]),
            'footer' => 
                Html::button('Đóng lại', ['class'=>'btn btn-secondary', 'data-bs-dismiss'=>'modal']) 
               
        ];
    }

    return $this->render('_form_choose_print', [
        'model' => $model,
        'nhanVienList' => $nhanVienList
    ]);
}



public function actionGetPrintContent($id, $kieu, $thang = null, $tu_ngay = null, $den_ngay = null)
{
    Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

    $nhanVien = NhanVienBocVac::findOne($id);

    if (!$nhanVien) {
        return ['status' => 'error', 'message' => 'Không tìm thấy nhân viên'];
    }

    $query = LuongNhanVienBocVac::find()->where(['id_nhan_vien_boc_vac' => $id]);

    if ($kieu == 'thang' && $thang) {
        $query->andWhere(['like', 'ngay_thang', $thang]); // format YYYY-MM
    } elseif ($kieu == 'khoang' && $tu_ngay && $den_ngay) {
        $query->andWhere(['between', 'ngay_thang', $tu_ngay, $den_ngay]);
    }

    $dsLuong = $query->orderBy(['ngay_thang' => SORT_ASC])->all();

    $html = $this->renderPartial('_print_bang_luong', [
        'nhanVien' => $nhanVien,
        'dsLuong' => $dsLuong
    ]);

    return ['status' => 'success', 'content' => $html];
}


public function actionExportExcel()
    {
        // Lấy dữ liệu từ request (người dùng chọn tháng, ngày, nhân viên...)
        $idNhanVien = Yii::$app->request->get('id');
        $kieu = Yii::$app->request->get('kieu');
        $thang = Yii::$app->request->get('thang');
        $tuNgay = Yii::$app->request->get('tu_ngay');
        $denNgay = Yii::$app->request->get('den_ngay');

        // Xây dựng query dựa trên các tham số người dùng
        $query = NhanVienBocVac::find();  // Giả sử bạn có model NhanVien

        // Nếu chọn xuất theo tháng
        if ($kieu == 'thang' && $thang) {
            $query->andWhere(['MONTH(ngay_tao)' => (int)date('m', strtotime($thang))]);
        }

        // Nếu chọn xuất theo khoảng ngày
        if ($kieu == 'khoang' && $tuNgay && $denNgay) {
            $query->andWhere(['between', 'ngay_tao', $tuNgay, $denNgay]);
        }

        // Lấy dữ liệu nhân viên (có thể thêm các điều kiện khác nếu cần)
        $data = $query->all();  // Lấy tất cả nhân viên

        // Khởi tạo một Spreadsheet mới
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Ghi tiêu đề
        $sheet->setCellValue('A1', 'ID Nhân viên')
              ->setCellValue('B1', 'Tên nhân viên')
              ->setCellValue('C1', 'Ngày tạo')
              ->setCellValue('D1', 'Lương');

        // Dữ liệu từ CSDL
        $rowIndex = 2;  // Dòng bắt đầu ghi dữ liệu (dòng 1 là tiêu đề)
        foreach ($data as $nhanVien) {
            $sheet->setCellValue('A' . $rowIndex, $nhanVien->id)
                  ->setCellValue('B' . $rowIndex, $nhanVien->ten)  // Giả sử có trường 'ten'
                  ->setCellValue('C' . $rowIndex, $nhanVien->ngay_tao)  // Giả sử có trường 'ngay_tao'
                  ->setCellValue('D' . $rowIndex, $nhanVien->luong);  // Giả sử có trường 'luong'
            $rowIndex++;
        }

        // Khởi tạo một đối tượng Writer
        $writer = new Xlsx($spreadsheet);

        // Lưu file vào server hoặc trả về trực tiếp cho người dùng
        $filePath = 'exports/bang_luong.xlsx';
        $writer->save($filePath);

        // Trả về URL của file để tải về
        return $this->asJson(['status' => 'success', 'fileUrl' => Yii::$app->getUrlManager()->createUrl($filePath)]);
    }
}
