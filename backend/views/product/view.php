<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'product_code',
            'name',
            'description:ntext',
            'count',
            'brand',
            'size',
        ],
    ]) ?>
    <div class="col-md-12" style="display: flex;justify-content: center;align-items: center;flex-wrap: wrap">
        <?php if(!empty($modelAttachment)):?>
            <?php foreach ($modelAttachment as $file):?>
                <div class="col-md-4" style="margin: 10px auto ;overflow: hidden;">
                <?php $ext = explode('.',$file->attachment);
                if ($ext[1] == 'jpg' || $ext[1] == 'jpeg' || $ext[1] == 'png' || $ext[1] == 'gif') {?>
                    <img src="<?=Yii::$app->getUrlManager()->getBaseUrl().'/uploads/'. $file->attachment ?>" style="width: 100%">
                <?php }elseif($ext[1] == 'mp4' || $ext[1] == 'ogg'){ ?>
                    <video preload="auto" autoplay="autoplay" controls="true" muted >
                        <source src="<?=Yii::$app->getUrlManager()->getBaseUrl().'/uploads/' . $file->attachment?>" type="video/mp4">
                        <source src="<?=Yii::$app->getUrlManager()->getBaseUrl().'/uploads/' . $file->attachment?>" type="video/ogg">
                    </video>
                    <?php
                }
                ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

    </div>

</div>
