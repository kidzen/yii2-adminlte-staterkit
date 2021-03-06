<?php

use kartik\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CompanyPic */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="company-pic-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

<div class="col-md-4">
    <?= $form->field($model, 'company_id')->textInput(['placeholder' => 'Company']) ?>
</div>

<div class="col-md-4">
    <?= $form->field($model, 'branch_id')->textInput(['placeholder' => 'Branch']) ?>
</div>

<div class="col-md-4">
    <?= $form->field($model, 'profile_id')->textInput(['placeholder' => 'Profile']) ?>
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
        <?= Html::a(Yii::t('app', 'Cancel'), Yii::$app->request->referrer , ['class'=> 'btn btn-danger']) ?>
    </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
