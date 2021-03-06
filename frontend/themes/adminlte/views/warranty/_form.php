<?php

use kartik\helpers\Html;
use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Warranty */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="warranty-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

<div class="col-md-4">
    <?= $form->field($model, 'item_id')->textInput(['placeholder' => 'Item']) ?>
</div>

<div class="col-md-4">
    <?= $form->field($model, 'supplier_id')->textInput(['placeholder' => 'Supplier']) ?>
</div>

<div class="col-md-4">
    <?= $form->field($model, 'type_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\GenValue::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
        'options' => ['placeholder' => 'Choose Gen value'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>
</div>

<div class="col-md-4">
    <?= $form->field($model, 'start_date')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
        'saveFormat' => 'php:Y-m-d',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose Start Date',
                'autoclose' => true
            ]
        ],
    ]); ?>
</div>

<div class="col-md-4">
    <?= $form->field($model, 'end_date')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
        'saveFormat' => 'php:Y-m-d',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose End Date',
                'autoclose' => true
            ]
        ],
    ]); ?>
</div>

<div class="col-md-4">
    <?= $form->field($model, 'remark')->textInput(['maxlength' => true, 'placeholder' => 'Remark']) ?>
</div>

<div class="col-md-4">
    <?= $form->field($model, 'status_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\GenValue::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
        'options' => ['placeholder' => 'Choose Gen value'],
        'pluginOptions' => [
            'allowClear' => true
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
