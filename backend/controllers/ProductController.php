<?php

namespace backend\controllers;

use app\models\ProductAttachment;
use yii\imagine\Image;
use Yii;
use app\models\Product;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Product::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $modelAttachment = ProductAttachment::find()->where(['product_id'=>$id])->all();

        return $this->render('view', [
            'model' => $this->findModel($id),
            'modelAttachment' => $modelAttachment,
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
                if(!empty($model->attachment)) {
                    $path = 'uploads/';
                    if(!file_exists('uploads/')) {
                        mkdir($path, 0777, true);
                    }
                    $model->attachment = UploadedFile::getInstances($model, 'attachment');
                    $check = '';
                    foreach ($model->attachment as $file) {
                        $file->saveAs($path . $file->baseName . '.' . $file->extension);
                        $originFile = $path . $file->baseName . '.' . $file->extension;
                        if($file->extension == 'jpg' || $file->extension == 'jpeg' || $file->extension == 'png') {
                            Image::thumbnail($originFile, 400, 400)->save($originFile, ['quality' => 100]);
                        }else{
                            $file->saveAs($path . $file->baseName . '.' . $file->extension);
                        }
                        $modelAttachment = new ProductAttachment();
                        $modelAttachment->product_id = $model->id;
                        $modelAttachment->attachment = $file->baseName . '.' . $file->extension;
                        if($modelAttachment->validate() && $modelAttachment->save()){
                            $check = true;
                        }else{
                            $check = false;
                        }
                    }
                }
                if($check){
                    return $this->redirect(['view', 'id' => $model->id]);
                }else{
                    throw new NotFoundHttpException('File Not Uploaded Something Went Wrong');
                }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelAttachment = ProductAttachment::find()->where(['product_id'=>$id])->all();
        $oldAttachment = $modelAttachment;
        $oldProductCode = $model->product_code;
        if ($model->load(Yii::$app->request->post())) {
            var_dump($model->product_code);
            var_dump($oldProductCode);
//            die;
            if(intval($model->product_code) !== intval($oldProductCode)){
                var_dump(Yii::$app->request->post('Product'));
                $model = new Product();
                $model->load(Yii::$app->request->post('Product'));
            }
            $model->save();
            $path = 'uploads/';
            $model->attachment = UploadedFile::getInstances($model, 'attachment');
            $check = true;
            if(!empty($model->attachment)) {
                foreach ($oldAttachment as $file){
                    @unlink($path. $file->attachment);
                    $file->delete();
                }
                foreach ($model->attachment as $file) {
                    $file->saveAs($path . $file->baseName . '.' . $file->extension);
                    $originFile = $path . $file->baseName . '.' . $file->extension;
                    if($file->extension == 'jpg' || $file->extension == 'jpeg' || $file->extension == 'png') {
                        Image::thumbnail($originFile, 400, 400)->save($originFile, ['quality' => 100]);
                    }else{
                        $file->saveAs($path . $file->baseName . '.' . $file->extension);
                    }
                    $modelAttachment = new ProductAttachment();
                    $modelAttachment->product_id = $model->id;
                    $modelAttachment->attachment = $file->baseName . '.' . $file->extension;
                    if($modelAttachment->validate() && $modelAttachment->save()){
                        $check = true;
                    }else{
                        $check = false;
                    }
                }
            }
            if($check){
                return $this->redirect(['view', 'id' => $model->id]);
            }else{
                throw new NotFoundHttpException('File Not Uploaded Something Went Wrong');
            }
        }
        return $this->render('update', [
            'model'           => $model,
            'modelAttachment' => $modelAttachment,
        ]);
    }
    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $modelAttachment = ProductAttachment::find()->where(['product_id'=>$id])->all();
        foreach ($modelAttachment as $file){
            $path = 'uploads/';
            @unlink($path. $file->attachment);
            $file->delete();
        }
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
