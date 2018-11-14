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
    </div>
</div>
    <div class="form-group" style="text-align: center">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
