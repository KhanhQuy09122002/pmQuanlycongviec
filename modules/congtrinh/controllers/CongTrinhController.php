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
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;


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

    // Tiêu đề chính
    $sheet->mergeCells('A1:E1');
    $sheet->setCellValue('A1', 'CHI TIẾT CÔNG TRÌNH');
    $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16)->getColor()->setRGB('FF0000');
    $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

   // Thông tin cơ bản
   $sheet->setCellValue('A3', 'Tên công trình:');
    $sheet->setCellValue('B3', $model->ten_cong_trinh);
    $sheet->setCellValue('A4', 'Địa điểm:');
    $sheet->setCellValue('B4', $model->dia_diem);
    $sheet->setCellValue('A5', 'Thời hạn HĐ:');
    $sheet->setCellValue('B5', Yii::$app->formatter->asDate($model->thoi_han_hop_dong_tu_ngay, 'php:d/m/Y') . ' - ' . Yii::$app->formatter->asDate($model->thoi_han_hop_dong_den_ngay, 'php:d/m/Y'));

    // Đặt màu chữ
    $sheet->getStyle('A3')->getFont()->getColor()->setRGB('FF0000'); 
    $sheet->getStyle('A4')->getFont()->getColor()->setRGB('FF0000');
    $sheet->getStyle('A5')->getFont()->getColor()->setRGB('FF0000');

    $sheet->getStyle('B3')->getFont()->getColor()->setRGB('0000FF');
    $sheet->getStyle('B4')->getFont()->getColor()->setRGB('0000FF');
    $sheet->getStyle('B5')->getFont()->getColor()->setRGB('0000FF');

    foreach (range('A', 'E') as $col) {
        $sheet->getColumnDimension($col)->setAutoSize(true);
    }

    $row = 7;

    // Hàm tạo tiêu đề mục
    $setSectionTitle = function($title) use (&$sheet, &$row) {
        $sheet->setCellValue("A$row", $title);
        $sheet->mergeCells("A$row:E$row");
        $sheet->getStyle("A$row")->getFont()->setBold(true)->setSize(12)->getColor()->setRGB('0000FF');
        $sheet->getStyle("A$row")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
        $row++;
    };

    // Hàm tạo tiêu đề cột
    $setTableHeader = function(array $headers) use (&$sheet, &$row) {
        $col = 'A';
        foreach ($headers as $header) {
            $sheet->setCellValue($col . $row, $header);
            $sheet->getStyle($col . $row)->getFont()->setBold(true)->setItalic(true);
            $sheet->getStyle($col . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $col++;
        }
        $row++;
    };

    $applyBorder = function($startRow, $endRow, $cols = 'A:E') use ($sheet) {
        [$startCol, $endCol] = explode(':', $cols);
        $sheet->getStyle("{$startCol}{$startRow}:{$endCol}{$endRow}")
              ->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
    };
    

    $setSectionTitle('Giá trị tạm ứng');
    $startRow = $row;
    $setTableHeader(['STT', 'Số tiền', 'Ngày tháng bảo lãnh']);
    foreach ($model->giaTriTamUng as $index => $item) {
        // Cài đặt giá trị cho các ô
        $sheet->setCellValue("A$row", $index + 1);
        $sheet->setCellValue("B$row", Yii::$app->formatter->asDecimal($item->so_tien, 0) . ' VNĐ');
        $sheet->setCellValue("C$row", Yii::$app->formatter->asDate($item->ngay_thang_bao_lanh, 'php:d/m/Y'));
        
        // Căn giữa cho các ô
        $sheet->getStyle("A$row")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("B$row")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("C$row")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        
        $row++;
    }
    
    // Áp dụng viền cho cột A, B, và C
    $applyBorder($startRow, $row - 1, 'A:C');
    $row++;
    
    
    // Giá trị thực hiện HĐ
    $setSectionTitle('Giá trị thực hiện hợp đồng');
    $startRow = $row;
    $setTableHeader(['STT', 'Số tiền', 'Ngày bảo lãnh']);
    foreach ($model->giaTriThucHienHopDong as $index => $item) {
    // Cài đặt giá trị cho các ô
    $sheet->setCellValue("A$row", $index + 1);
    $sheet->setCellValue("B$row", Yii::$app->formatter->asDecimal($item->so_tien, 0) . ' VNĐ');
    $sheet->setCellValue("C$row", Yii::$app->formatter->asDate($item->ngay_thang_bao_lanh, 'php:d/m/Y'));

    // Căn giữa cho các ô
    $sheet->getStyle("A$row")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle("B$row")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle("C$row")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    
    $row++;
    }   

    // Áp dụng viền cho cột A, B, và C
    $applyBorder($startRow, $row - 1, 'A:C');
    $row++;


    // Giá trị bảo hành
    $setSectionTitle('Giá trị bảo hành');
    $startRow = $row;
    $setTableHeader(['STT', 'Số tiền', 'Ngày bảo hành']);
    foreach ($model->giaTriBaoHanh as $index => $item) {
    // Cài đặt giá trị cho các ô
    $sheet->setCellValue("A$row", $index + 1);
    $sheet->setCellValue("B$row", Yii::$app->formatter->asDecimal($item->so_tien, 0) . ' VNĐ');
    $sheet->setCellValue("C$row", Yii::$app->formatter->asDate($item->ngay_thang_bao_hanh, 'php:d/m/Y'));

    // Căn giữa cho các ô
    $sheet->getStyle("A$row")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle("B$row")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle("C$row")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    
    $row++;
    }

    // Áp dụng viền cho cột A, B, và C
    $applyBorder($startRow, $row - 1, 'A:C');
    $row++;


    // Các lần thanh toán
    $setSectionTitle('Giá trị đã thanh toán');
    $startRow = $row;
    $setTableHeader(['Tên lần thanh toán', 'Số tiền']);
    foreach ($model->giaTriDaThanhToan as $item) {
    // Cài đặt giá trị cho các ô
    $sheet->setCellValue("A$row", $item->ten_lan_thanh_toan);
    $sheet->setCellValue("B$row", Yii::$app->formatter->asDecimal($item->so_tien, 0) . ' VNĐ');
    
    // Căn giữa cho các ô
    $sheet->getStyle("A$row")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle("B$row")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    
    $row++;
    }

    // Áp dụng viền cho cột A và B
    $applyBorder($startRow, $row - 1, 'A:B');
    $row++;


    // Thanh toán nhân công
    $setSectionTitle('Thanh toán nhân công');
    $startRow = $row;
    $setTableHeader(['Họ tên', 'Tổng HĐ', 'Đã TT', 'Còn lại']);
    foreach ($model->nhanCongThanhToan as $item) {
    // Cài đặt giá trị cho các ô
    $sheet->setCellValue("A$row", $item->ho_ten);
    $sheet->setCellValue("B$row", Yii::$app->formatter->asDecimal($item->tong_hop_dong, 0) . ' VNĐ');
    $sheet->setCellValue("C$row", Yii::$app->formatter->asDecimal($item->da_thanh_toan, 0) . ' VNĐ');
    $sheet->setCellValue("D$row", Yii::$app->formatter->asDecimal($item->con_lai, 0) . ' VNĐ');
    
    
    // Căn giữa cho các ô
    $sheet->getStyle("A$row")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle("B$row")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle("C$row")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle("D$row")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    
    $row++;
    }

    // Áp dụng viền cho cột A đến D
    $applyBorder($startRow, $row - 1, 'A:D');
    $row++;
    // Thanh toán vật tư
    $setSectionTitle('Thanh toán vật tư');
    $startRow = $row;
    $setTableHeader(['Tên vật tư', 'Số lượng', 'Đơn giá', 'Thành tiền']);
    foreach ($model->vatTuThanhToan as $item) {
    // Cài đặt giá trị cho các ô
    $sheet->setCellValue("A$row", $item->ten_vat_tu);
    $sheet->setCellValue("B$row", $item->so_luong);
    $sheet->setCellValue("C$row", Yii::$app->formatter->asDecimal($item->don_gia, 0) . ' VNĐ');
    $sheet->setCellValue("D$row", Yii::$app->formatter->asDecimal($item->thanh_tien, 0) . ' VNĐ');
    
    
    // Căn giữa cho các ô
    $sheet->getStyle("A$row")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle("B$row")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle("C$row")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle("D$row")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    
    $row++;
    }

    // Áp dụng viền cho cột A đến D
    $applyBorder($startRow, $row - 1, 'A:D');
    $row++;


    // Thanh toán thầu phụ
    $setSectionTitle('Thanh toán thầu phụ');
    $startRow = $row;
    $setTableHeader(['Công việc', 'Tổng HĐ', 'Đã TT', 'Còn lại']);
    foreach ($model->thauPhuThanhToan as $item) {
    // Cài đặt giá trị cho các ô
    $sheet->setCellValue("A$row", $item->ten_cong_viec);
    $sheet->setCellValue("B$row", Yii::$app->formatter->asDecimal($item->tong_hop_dong, 0) . ' VNĐ');
    $sheet->setCellValue("C$row", Yii::$app->formatter->asDecimal($item->da_thanh_toan, 0) . ' VNĐ');
    $sheet->setCellValue("D$row", Yii::$app->formatter->asDecimal($item->con_lai, 0) . ' VNĐ');
    
    
    // Căn giữa cho các ô
    $sheet->getStyle("A$row")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle("B$row")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle("C$row")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle("D$row")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    
    $row++;
    }

    // Áp dụng viền cho cột A đến D
    $applyBorder($startRow, $row - 1, 'A:D');
    $row++;

    // Thanh toán ca máy
    $setSectionTitle('Thanh toán ca máy');
    $startRow = $row;
    $setTableHeader(['Tên ca máy', 'Số tiền']);
    foreach ($model->caMayThanhToan as $item) {
    // Cài đặt giá trị cho các ô
    $sheet->setCellValue("A$row", $item->ten_ca_may);
    $sheet->setCellValue("B$row", Yii::$app->formatter->asDecimal($item->so_tien, 0) . ' VNĐ');
    
    // Căn giữa cho các ô
    $sheet->getStyle("A$row")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle("B$row")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    
    $row++;
    }

    // Áp dụng viền cho cột A và B
    $applyBorder($startRow, $row - 1, 'A:B');
    $row++;

    // Chi phí khác
    $setSectionTitle('Chi phí khác');
    $startRow = $row;
    $setTableHeader(['Tên chi phí', 'Số tiền', 'Ghi chú']);
    foreach ($model->chiPhiKhacThanhToan as $item) {
    // Cài đặt giá trị cho các ô
    $sheet->setCellValue("A$row", $item->ten_chi_phi);
    $sheet->setCellValue("B$row", Yii::$app->formatter->asDecimal($item->so_tien, 0) . ' VNĐ');
    $sheet->setCellValue("C$row", $item->ghi_chu);
    
    // Căn giữa cho các ô
    $sheet->getStyle("A$row")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle("B$row")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle("C$row")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    
    $row++;
    }

    // Áp dụng viền cho cột A, B, C
    $applyBorder($startRow, $row - 1, 'A:C');
    $row++;


    // Xuất file
    $filename = 'thong_tin_cong_trinh.xlsx';
    $writer = new Xlsx($spreadsheet);

    if (ob_get_length()) ob_end_clean();
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Cache-Control: max-age=0');
    $writer->save('php://output');
    exit;
}
}
