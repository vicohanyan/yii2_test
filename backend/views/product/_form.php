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
            <h3 >Uploaded Photos and Videos</h3>
            <?php if(!empty($modelAttachment)):?>
                <?php foreach($modelAttachment as $file):?>
                    <div class="item col-md-4">
                        <?php if ($file) {
                            $img = Yii::$app->getUrlManager()->getBaseUrl() . '/uploads/' . '/' . $file->attachment;
                            $ext = explode('.',$file->attachment);
                            if ($ext[1] == 'jpg' || $ext[1] == 'jpeg' || $ext[1] == 'png' || $ext[1] == 'gif') {
                                echo '<img src="'.$img .'" style="width: 100%;height: auto;">
                                      <video controls width="100%" height="100%" autoplay="autoplay" style="display:none"  muted>
                                          <source src="'.$img.'" type="video/mp4">
                                          <source src="'.$img.'" type="video/ogg">
                                          Your browser does not support the video tag.
                                      </video>
                                      ';
                            } elseif($ext[1] == 'mp4' || $ext[1] == 'ogg') {
                                echo '
                                     <img src="'.$img .'"  style="display:none">
                                     <video controls width="100%" height="100%" autoplay="autoplay"" muted>
                                         <source src="'.$img.'" type="video/mp4">
                                         <source src="'.$img.'" type="video/ogg">
                                         Your browser does not support the video tag.
                                     </video>
                                    ';
                            }else{
                                echo Yii::app()->Translator->translate('File format not supported.');
                            }
                        }?>
                    </div>
                <?php endforeach;?>
            <?php endif;?>
        </div>
    </div>
</div>
    <div class="form-group" style="text-align: center">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
