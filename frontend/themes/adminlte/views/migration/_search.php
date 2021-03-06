<?php

use kartik\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\search\MigrationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-migration-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

<div class="col-md-4">
    <?= $form->field($model, 'version')->textInput(['maxlength' => true, 'placeholder' => 'Version']) ?>

</div>

<div class="col-md-4">
    <?= $form->field($model, 'apply_time')->textInput(['placeholder' => 'Apply Time']) ?>

</div>

    <div class="clearfix"></div>

    <div class="col-md-4">
        <div class="form-group">
            <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
            <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
        </div>
    </div>

    <div class="clearfix"></div>

    <?php ActiveForm::end(); ?>

</div>
