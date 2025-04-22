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
						'actions' => ['index', 'view', 'update','create','delete','bulkdelete','choose-print','choose-excel','get-print-content','export-excel','update-gtct'],
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

    public function actionUpdateGtct($id)
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
                    'content'=>$this->renderAjax('updateGTCT', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Đóng lại',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                                Html::button('Lưu lại',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceClose'=>true,   
                     'reloadType'=>'GTHD',
                     'reloadBlock'=>'#gthdContent',
                     'reloadContent'=>$this->renderAjax('gia_tri_hop_dong', [
                        'model'=>$model,
                     ]),
                     
                     'tcontent'=>'Cập nhật giá trị bảo hành thành công!',
                 ]; 
            }else{
                 return [
                    'title'=> "Cập nhật CongTrinh #".$id,
                    'content'=>$this->renderAjax('updateGTCT', [
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
                return $this->render('updateGTCT', [
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
    $sheet->setCellValue('A1', 'THEO DÕI CÔNG TRÌNH');
    $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16)->getColor()->setRGB('FF0000');
    $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

    // Thông tin cơ bản
    $sheet->mergeCells('A3:B3'); // Gộp ô A3 và B3
    $sheet->setCellValue('A3', 'Công trình: ' . $model->ten_cong_trinh); 


    $sheet->setCellValue('A4', '      - Giá trị hợp đồng:');
    $sheet->getStyle('A4')->getFont()->setBold(true); 
    $sheet->setCellValue('B4', Yii::$app->formatter->asDecimal($model->gia_tri_hop_dong, 0) . ' VNĐ');

    $sheet->setCellValue('A5', '      - Thời hạn hợp đồng:');
    $sheet->getStyle('A5')->getFont()->setBold(true); 
    $sheet->setCellValue('B5', Yii::$app->formatter->asDate($model->thoi_han_hop_dong_tu_ngay, 'php:d/m/Y') . ' - ' . Yii::$app->formatter->asDate($model->thoi_han_hop_dong_den_ngay, 'php:d/m/Y'));

    // Thông tin tạm ứng
    $sheet->setCellValue('A6', '      - Giá trị tạm ứng:');
    $sheet->getStyle('A6')->getFont()->setBold(true); 

    // Tính tổng số tiền tạm ứng
    $tongTamUng = 0;
      foreach ($model->giaTriTamUng as $tamUng) {
         $tongTamUng += $tamUng->so_tien;
      }
    $sheet->setCellValue('B6', Yii::$app->formatter->asDecimal($tongTamUng, 0) . ' VNĐ');

    // Chi tiết từng dòng tạm ứng
    $row = 7;
    foreach ($model->giaTriTamUng as $index => $tamUng) {
    $sheet->setCellValue('A' . $row, '                  + Số tiền:');
    $sheet->setCellValue('B' . $row, Yii::$app->formatter->asDecimal($tamUng->so_tien, 0) . ' VNĐ');
    $sheet->getStyle('A' . $row)->getFont()->getColor()->setRGB('FF0000');
    $row++;

    $sheet->setCellValue('A' . $row, '                  + Ngày tháng bảo lãnh:');
    $sheet->setCellValue('B' . $row, Yii::$app->formatter->asDate($tamUng->ngay_thang_bao_lanh, 'php:d/m/Y'));
    $sheet->getStyle('A' . $row)->getFont()->getColor()->setRGB('FF0000');
    $row++;
    }

    

    // Thông tin bảo lãnh thực hiện hợp đồng
    $sheet->setCellValue('A9', '      - Giá trị bảo lãnh thực hiện hợp đồng:');
    $sheet->getStyle('A9')->getFont()->setBold(true); 

    // Tính tổng giá trị bảo lãnh thực hiện hợp đồng
    $tongThucHien = 0;
      foreach ($model->giaTriThucHienHopDong as $thucHien) {
      $tongThucHien += $thucHien->so_tien;
    }
    $sheet->setCellValue('B9', Yii::$app->formatter->asDecimal($tongThucHien, 0) . ' VNĐ');

    // Chi tiết từng dòng bảo lãnh thực hiện hợp đồng
    $row = 10;
    foreach ($model->giaTriThucHienHopDong as $thucHien) {
    $sheet->setCellValue('A' . $row, '                  + Số tiền:');
    $sheet->setCellValue('B' . $row, Yii::$app->formatter->asDecimal($thucHien->so_tien, 0) . ' VNĐ');
    $sheet->getStyle('A' . $row)->getFont()->getColor()->setRGB('FF0000');
    $row++;

    $sheet->setCellValue('A' . $row, '                  + Ngày tháng bảo lãnh:');
    $sheet->setCellValue('B' . $row, Yii::$app->formatter->asDate($thucHien->ngay_thang_bao_lanh, 'php:d/m/Y'));
    $sheet->getStyle('A' . $row)->getFont()->getColor()->setRGB('FF0000');
    $row++;
    }

    // Thông tin bảo hành
    $sheet->setCellValue('A12', '     - Giá trị bảo hành:');
    $sheet->getStyle('A12')->getFont()->setBold(true);

    // Tính tổng giá trị bảo hành
    $tongBaoHanh = 0;
     foreach ($model->giaTriBaoHanh as $baoHanh) {
     $tongBaoHanh += $baoHanh->so_tien;
    }
    $sheet->setCellValue('B12', Yii::$app->formatter->asDecimal($tongBaoHanh, 0) . ' VNĐ');

    // Chi tiết từng dòng bảo hành
    $row = 13;
    foreach ($model->giaTriBaoHanh as $baoHanh) {
    $sheet->setCellValue('A' . $row, '                  + Số tiền:');
    $sheet->setCellValue('B' . $row, Yii::$app->formatter->asDecimal($baoHanh->so_tien, 0) . ' VNĐ');
    $sheet->getStyle('A' . $row)->getFont()->getColor()->setRGB('FF0000');
    $row++;

    $sheet->setCellValue('A' . $row, '                  + Ngày tháng bảo lãnh:');
    $sheet->setCellValue('B' . $row, 'Khi CT hoàn thành');
    $sheet->getStyle('A' . $row)->getFont()->getColor()->setRGB('FF0000');
    $row++;
    }


    // Thông tin thanh toán
    $sheet->setCellValue('A15', '     - Giá trị đã thanh toán:');
    $sheet->getStyle('A15')->getFont()->setBold(true); 

    // Tính tổng giá trị đã thanh toán
    $tongDaThanhToan = 0;
    foreach ($model->giaTriDaThanhToan as $thanhToan) {
        $tongDaThanhToan += $thanhToan->so_tien;
    }
    $sheet->setCellValue('B15', Yii::$app->formatter->asDecimal($tongDaThanhToan, 0) . ' VNĐ');

    $row = 16;
    foreach ($model->giaTriDaThanhToan as $thanhToan) {
        $sheet->setCellValue('A' . $row, '            + ' . $thanhToan->ten_lan_thanh_toan . ':');
        $sheet->setCellValue('B' . $row, Yii::$app->formatter->asDecimal($thanhToan->so_tien, 0) . ' VNĐ');
        $sheet->getStyle('A' . $row)->getFont()->getColor()->setRGB('FF0000');
        $sheet->getStyle('A' . $row)->getAlignment()->setIndent(2); // Thụt lề
        $row++;
    }
    

    //Giá trị hợp đồng còn lạilại
    $conLai = $model->gia_tri_hop_dong - $tongDaThanhToan;
    // Thông tin còn lại
    $sheet->setCellValue('A' . $row, '    - Giá trị hợp đồng còn lại:');
    $sheet->getStyle('A' . $row)->getFont()->setBold(true); 
    $sheet->setCellValue('B' . $row, Yii::$app->formatter->asDecimal($conLai, 0) . ' VNĐ');

 

   $row++;

   // Tổng chi phí thi công thực tế
   $tongVatTu = array_sum(array_column($model->vatTuThanhToan, 'thanh_tien'));
   $tongThauPhu = array_sum(array_column($model->thauPhuThanhToan, 'da_thanh_toan'));
   $tongNhanCong = array_sum(array_column($model->nhanCongThanhToan, 'da_thanh_toan'));
   $tongCaMay = array_sum(array_column($model->caMayThanhToan, 'so_tien'));
   $tongChiPhiKhac = array_sum(array_column($model->chiPhiKhacThanhToan, 'so_tien'));
   $tongChiPhi = $tongVatTu + $tongNhanCong + $tongThauPhu + $tongCaMay + $tongChiPhiKhac;
   $sheet->setCellValue('A' . $row, '    - Chi phí thi công thực tế đến hiện tại:');
   $sheet->setCellValue('B' . $row, Yii::$app->formatter->asDecimal($tongChiPhi, 0) . ' VNĐ');
   $sheet->getStyle('A' . $row)->getFont()->setBold(true);
   $row++;

   // ===== VẬT TƯ =====
   $sheet->setCellValue('A' . $row, '                 + Vật tư thanh toán:');
   $sheet->getStyle('A' . $row)->getFont()->getColor()->setRGB('FF0000');
   $sheet->setCellValue('B' . $row, Yii::$app->formatter->asDecimal($tongVatTu, 0) . ' VNĐ');
   $sheet->getStyle('B' . $row)->getFont()->getColor()->setRGB('0000FF'); 

   $row++;

    foreach ($model->vatTuThanhToan as $vatTu) {
    $moTa = "                 ● {$vatTu->ten_vat_tu}: số lượng, thành tiền";
    $chiTiet = Yii::$app->formatter->asDecimal($vatTu->thanh_tien, 0) . ' VNĐ';
    $ghiChu = "{$vatTu->so_luong} ({$vatTu->don_vi_tinh}) x " . Yii::$app->formatter->asDecimal($vatTu->don_gia, 0) . ' VNĐ';


    $sheet->setCellValue('A' . $row, $moTa);
    $sheet->setCellValue('B' . $row, $chiTiet);
    $sheet->setCellValue('C' . $row, $ghiChu);
    $row++;
    }

    // ===== NHÂN CÔNG =====
    $sheet->setCellValue('A' . $row, '                 + Nhân công đã thanh toán:');
    $sheet->getStyle('A' . $row)->getFont()->getColor()->setRGB('FF0000');
    $sheet->setCellValue('B' . $row, Yii::$app->formatter->asDecimal($tongNhanCong, 0) . ' VNĐ');
    $sheet->getStyle('B' . $row)->getFont()->getColor()->setRGB('0000FF');

    $row++;

    foreach ($model->nhanCongThanhToan as $nhanCong) {
    $sheet->setCellValue('A' . $row, "                 ● {$nhanCong->ho_ten}");
    $sheet->setCellValue('B' . $row, Yii::$app->formatter->asDecimal($nhanCong->da_thanh_toan, 0) . ' VNĐ');
    $row++;

    $sheet->setCellValue('A' . $row, '                 ✓ Tổng hợp đồng:');
    $sheet->setCellValue('B' . $row, Yii::$app->formatter->asDecimal($nhanCong->tong_hop_dong, 0) . ' VNĐ');
    $row++;

    $sheet->setCellValue('A' . $row, '                 ✓ Đã thanh toán:');
    $sheet->setCellValue('B' . $row, Yii::$app->formatter->asDecimal($nhanCong->da_thanh_toan, 0) . ' VNĐ');
    $row++;

    $sheet->setCellValue('A' . $row, '                 ✓ Còn lại:');
    $sheet->setCellValue('B' . $row, Yii::$app->formatter->asDecimal($nhanCong->con_lai, 0) . ' VNĐ');
    $row++;
    }

    // ===== THẦU PHỤ =====
    $sheet->setCellValue('A' . $row, '                 + Thầu phụ đã thanh toán:');
    $sheet->getStyle('A' . $row)->getFont()->getColor()->setRGB('FF0000');
    $sheet->setCellValue('B' . $row, Yii::$app->formatter->asDecimal($tongThauPhu, 0) . ' VNĐ');
    $sheet->getStyle('B' . $row)->getFont()->getColor()->setRGB('0000FF');
    $row++;

    foreach ($model->thauPhuThanhToan as $thauPhu) {
    $sheet->setCellValue('A' . $row, "                 ● {$thauPhu->ten_cong_viec}");
    $row++;

    $sheet->setCellValue('A' . $row, '                 ✓ Tổng hợp đồng:');
    $sheet->setCellValue('B' . $row, Yii::$app->formatter->asDecimal($thauPhu->tong_hop_dong, 0) . ' VNĐ');
    $row++;

    $sheet->setCellValue('A' . $row, '                 ✓ Đã thanh toán:');
    $sheet->setCellValue('B' . $row, Yii::$app->formatter->asDecimal($thauPhu->da_thanh_toan, 0) . ' VNĐ');
    $row++;

    $sheet->setCellValue('A' . $row, '                 ✓ Còn lại:');
    $sheet->setCellValue('B' . $row, Yii::$app->formatter->asDecimal($thauPhu->con_lai, 0) . ' VNĐ');
    $row++;
    }

    // ===== CA MÁY =====
    $sheet->setCellValue('A' . $row, '                 + Ca máy đã thanh toán:');
    $sheet->getStyle('A' . $row)->getFont()->getColor()->setRGB('FF0000');
    $sheet->setCellValue('B' . $row, Yii::$app->formatter->asDecimal($tongCaMay, 0) . ' VNĐ');
    $sheet->getStyle('B' . $row)->getFont()->getColor()->setRGB('0000FF');
    $row++;

    foreach ($model->caMayThanhToan as $caMay) {
    $sheet->setCellValue('A' . $row, "                 ● {$caMay->ten_ca_may}:");
    $sheet->setCellValue('B' . $row, Yii::$app->formatter->asDecimal($caMay->so_tien, 0) . ' VNĐ');
    $row++;
    }

    // ===== CHI PHÍ KHÁC =====
   $sheet->setCellValue('A' . $row, '                 + Chi phí khác thanh toán:');
   $sheet->getStyle('A' . $row)->getFont()->getColor()->setRGB('FF0000');
   $sheet->setCellValue('B' . $row, Yii::$app->formatter->asDecimal($tongChiPhiKhac, 0) . ' VNĐ');
   $sheet->getStyle('B' . $row)->getFont()->getColor()->setRGB('0000FF');
   $row++;

    foreach ($model->chiPhiKhacThanhToan as $chiPhi) {
    $sheet->setCellValue('A' . $row, "                 ● {$chiPhi->ten_chi_phi}:");
    $sheet->setCellValue('B' . $row, Yii::$app->formatter->asDecimal($chiPhi->so_tien, 0) . ' VNĐ');
    $row++;
    }
    

   // Tính khối lượng phát sinh
   $khoiLuongPhatSinh = $model->gia_tri_hop_dong - $tongChiPhi;

   // Thông tin phát sinh
   $sheet->setCellValue('A' . $row, ' - Khối lượng phát sinh tăng/giảm:');
   $sheet->getStyle('A' . $row)->getFont()->setBold(true);
   $sheet->getStyle('A' . $row)->getAlignment()->setIndent(1); // Thụt đầu dòng

    $sheet->setCellValue('B' . $row, Yii::$app->formatter->asDecimal($khoiLuongPhatSinh, 0) . ' VNĐ');

    // Đặt chiều rộng cột tự động
    foreach (range('A', 'B') as $col) {
    $sheet->getColumnDimension($col)->setAutoSize(true);
    }


    // Xuất file
    $filename = 'thong_tin_cong_trinh.xlsx';
    $writer = new Xlsx($spreadsheet);

    if (ob_get_length()) ob_end_clean();
    header('Content-Type: application/VND.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Cache-Control: max-age=0');
    $writer->save('php://output');
    exit;
}


}
