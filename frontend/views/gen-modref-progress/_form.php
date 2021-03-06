<?php

use kartik\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\GenModrefProgress */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="gen-modref-progress-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

<div class="col-md-4">
    <?= $form->field($model, 'code')->textInput(['maxlength' => true, 'placeholder' => 'Code']) ?>
</div>

<div class="col-md-4">
    <?= $form->field($model, 'next')->textInput(['maxlength' => true, 'placeholder' => 'Next']) ?>
</div>

<div class="col-md-4">
    <?= $form->field($model, 'return')->textInput(['maxlength' => true, 'placeholder' => 'Return']) ?>
</div>

<div class="col-md-4">
    <?= $form->field($model, 'description')->textInput(['maxlength' => true, 'placeholder' => 'Description']) ?>
</div>

<div class="col-md-4">
    <?= $form->field($model, 'remark')->textInput(['maxlength' => true, 'placeholder' => 'Remark']) ?>
</div>

<div class="col-md-4">
    <?= $form->field($model, 'status')->widget(\kartik\widgets\Select2::classname(), [
            'data' => [1 => 'Active', 0 => 'Inactive'],
            'options' => ['placeholder' => 'Select status ...'],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ]); ?>
</div>

    <div class="clearfix"></div>
    <div class="clearfix"></div>
    <div class="col-md-4">
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
