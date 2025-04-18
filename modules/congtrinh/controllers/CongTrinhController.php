<?php

namespace app\modules\congtrinh\controllers;

use Yii;
use app\modules\congtrinh\models\CongTrinh;
use app\modules\congtrinh\models\search\CongTrinhSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\filters\AccessControl;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

/**
 * CongTrinhController implements the CRUD actions for CongTrinh model.
 */
class CongTrinhController extends Controller
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
						'actions' => ['index', 'view', 'update','create','delete','bulkdelete','choose-print','choose-excel','get-print-content','export-excel'],
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
     * Lists all CongTrinh models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new CongTrinhSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single CongTrinh model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "CongTrinh #".$id,
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
     * Creates a new CongTrinh model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new CongTrinh();  

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Thêm công trình",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Đóng lại',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                                Html::button('Lưu lại',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Thêm công trình",
                    'content'=>'<span class="text-success">Thêm công trình thành công !</span>',
                    'footer'=> Html::button('Đóng lại',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                            Html::a('Tiếp tục tạo',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> "Thêm công trình",
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
     * Updates an existing CongTrinh model.
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
                    'title'=> "Cập nhật CongTrinh #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Đóng lại',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                                Html::button('Lưu lại',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "CongTrinh #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Đóng lại',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                            Html::a('Sửa',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Cập nhật CongTrinh #".$id,
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
     * Delete an existing CongTrinh model.
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
     * Delete multiple existing CongTrinh model.
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
     * Finds the CongTrinh model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CongTrinh the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CongTrinh::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }



    public function actionChoosePrint()
    {
        $request = Yii::$app->request;
        $model = new \yii\base\DynamicModel(['id_cong_trinh']);
        $model->addRule(['id_cong_trinh'], 'required');
    
        $congTrinhList = \yii\helpers\ArrayHelper::map(
            CongTrinh::find()->all(), 
            'id', 
            'ten_cong_trinh'
        );
    
        if ($request->isAjax) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return [
                'title' => 'Chọn thông tin để in',
                'content' => $this->renderAjax('_form_choose_print', [
                    'model' => $model,
                    'congTrinhList' => $congTrinhList
                ]),
                'footer' => 
                    Html::button('Đóng lại', ['class'=>'btn btn-secondary', 'data-bs-dismiss'=>'modal']) 
                   
            ];
        }
    
        return $this->render('_form_choose_print', [
            'model' => $model,
            'congTrinhList' => $congTrinhList
        ]);
    }
    
    


public function actionChooseExcel()
{
    $request = Yii::$app->request;
    $model = new \yii\base\DynamicModel(['id_cong_trinh']);
    $model->addRule(['id_cong_trinh'], 'required');

    $congTrinhList = \yii\helpers\ArrayHelper::map(
        CongTrinh::find()->all(), 
        'id', 
        'ten_cong_trinh'
    );

    if ($request->isAjax) {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return [
            'title' => 'Chọn thông tin để xuất',
            'content' => $this->renderAjax('_form_choose_excel', [
                'model' => $model,
                'congTrinhList' => $congTrinhList
            ]),
            'footer' => 
                Html::button('Đóng lại', ['class'=>'btn btn-secondary', 'data-bs-dismiss'=>'modal']) 
               
        ];
    }

    return $this->render('_form_choose_print', [
        'model' => $model,
        'congTrinhList' => $congTrinhList
    ]);
}
public function actionGetPrintContent($id)
{
    Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

    $model = CongTrinh::findOne($id);
    if ($model === null) {
        return ['status' => 'error', 'message' => 'Không tìm thấy công trình.'];
    }

    return [
        'status' => 'success',
        'content' => $this->renderPartial('_print_content', ['model' => $model])
    ];
}



public function actionExportExcel($id)
{
    $model = CongTrinh::findOne($id);
    if (!$model) {
        throw new NotFoundHttpException("Không tìm thấy công trình.");
    }

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $sheet->setCellValue('A1', 'Chi tiết công trình');
    $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14)->getColor()->setRGB('FF0000');
    $sheet->mergeCells('A1:C1');

    $sheet->setCellValue('A3', 'Tên công trình:');
    $sheet->setCellValue('B3', $model->ten_cong_trinh);
    $sheet->setCellValue('A4', 'Địa điểm:');
    $sheet->setCellValue('B4', $model->dia_diem);
    $sheet->setCellValue('A5', 'Thời hạn hợp đồng:');
    $sheet->setCellValue('B5', Yii::$app->formatter->asDate($model->thoi_han_hop_dong_tu_ngay, 'php:d/m/Y') . ' - ' . Yii::$app->formatter->asDate($model->thoi_han_hop_dong_den_ngay, 'php:d/m/Y'));

    $sheet->getStyle('B3:B5')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
    foreach (range('A', 'C') as $col) {
        $sheet->getColumnDimension($col)->setAutoSize(true);
    }

    $filename = 'thong_tin_cong_trinh.xlsx';
    $writer = new Xlsx($spreadsheet);

    // Dọn dẹp mọi output trước khi gửi file
    if (ob_get_length()) ob_end_clean();

    header('Content-Description: File Transfer');
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');

    $writer->save('php://output');
    exit;
}
}
