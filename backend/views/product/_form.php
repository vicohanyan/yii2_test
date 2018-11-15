<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Category;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">
<div class="col-md-12">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="col-md-8">
        <?= $form->field($model, 'product_code')->textInput(['type' => 'number']) ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'count')->textInput(['type' => 'number']) ?>

        <?= $form->field($model, 'brand')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'size')->textInput() ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'category_id')->dropDownList(ArrayHelper::map(Category::find()->all(), 'id', 'name'),['prompt'=>'Select Category ...']) ?>

        <?= $form->field($model, 'attachment[]')->fileInput(['multiple' => true]) ?>

        <div>
            <h2>Uploaded Photos and Videos</h2>
<!--            --><?php //foreach($model->attachment as $file):?>
<!--                <div class="item">-->
<!--<!--                    -->--><?php ////if ($file) {
////                        $file = realpath(Yii::app()->basePath . '/../tmp_path/') . '/' . $file;
////                        $img = null;
////                        if (file_exists($file)) {
////                            $img = Yii::app()->baseUrl . '/tmp_path/' . $lm->image;
////                        }
////                        else {
////                            $img = Yii::app()->baseUrl . '/images/slider/' . $lm->image;
////                        }
////                        $ext = explode('.',$lm->image);
////                        if ($ext[1] == 'jpg' || $ext[1] == 'jpeg' || $ext[1] == 'png' || $ext[1] == 'gif') {
////                            echo '<img src="'.$img .'" id="file-img_'.$lm->lang_id.'">
////                                  <video controls width="100%" height="100%" autoplay="autoplay" style="display:none" id="file-video_'.$lm->lang_id.'" muted>
////                                      <source src="'.$img.'" type="video/mp4">
////                                      <source src="'.$img.'" type="video/ogg">
////                                      Your browser does not support the video tag.
////                                  </video>
////                                  ';
////                        } elseif($ext[1] == 'mp4' || $ext[1] == 'ogg') {
////                            echo '
////                                 <img src="'.$img .'" id="file-img_'.$lm->lang_id.'" style="display:none">
////                                 <video controls width="100%" height="100%" autoplay="autoplay" id="file-video_'.$lm->lang_id.'" muted>
////                                     <source src="'.$img.'" type="video/mp4">
////                                     <source src="'.$img.'" type="video/ogg">
////                                     Your browser does not support the video tag.
////                                 </video>
////                                ';
////                        }else{
////                            echo Yii::app()->Translator->translate('File format not supported.');
////                        }
////                    }?>
<!---->
<!--                </div>-->
<!--            --><?php //endforeach;?>
        </div>
    </div>
</div>
    <div class="form-group" style="text-align: center">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
