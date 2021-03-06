<div class="form-group" id="add-diposal">
<?php
use kartik\grid\GridView;
use kartik\builder\TabularForm;
use yii\data\ArrayDataProvider;
use kartik\helpers\Html;
use yii\widgets\Pjax;

$dataProvider = new ArrayDataProvider([
    'allModels' => $row,
    'pagination' => [
        'pageSize' => -1
    ]
]);
echo TabularForm::widget([
    'dataProvider' => $dataProvider,
    'formName' => 'Diposal',
    'checkboxColumn' => false,
    'actionColumn' => false,
    'attributeDefaults' => [
        'type' => TabularForm::INPUT_TEXT,
    ],
    'attributes' => [
        "id" => ['type' => TabularForm::INPUT_HIDDEN, 'columnOptions' => ['hidden'=>true]],
        'transaction_id' => [
            'label' => 'Transaction',
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\widgets\Select2::className(),
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map(\common\models\Transaction::find()->orderBy('id')->asArray()->all(), 'id', 'id'),
                'options' => ['placeholder' => 'Choose Transaction'],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ],
            'columnOptions' => ['width' => '200px']
        ],
        'order_no' => ['type' => TabularForm::INPUT_TEXT],
        'order_date' => ['type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\datecontrol\DateControl::classname(),
            'options' => [
                'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                'saveFormat' => 'php:Y-m-d',
                'ajaxConversion' => true,
                'options' => [
                    'pluginOptions' => [
                        'placeholder' => 'Choose Order Date',
                        'autoclose' => true
                    ]
                ],
            ]
        ],
        'attend_date' => ['type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\datecontrol\DateControl::classname(),
            'options' => [
                'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                'saveFormat' => 'php:Y-m-d',
                'ajaxConversion' => true,
                'options' => [
                    'pluginOptions' => [
                        'placeholder' => 'Choose Attend Date',
                        'autoclose' => true
                    ]
                ],
            ]
        ],
        'type_id' => [
            'label' => 'Gen value',
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\widgets\Select2::className(),
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map(\common\models\GenValue::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
                'options' => ['placeholder' => 'Choose Gen value'],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ],
            'columnOptions' => ['width' => '200px']
        ],
        'order_by' => [
            'label' => 'Profile',
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\widgets\Select2::className(),
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map(\common\models\Profile::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
                'options' => ['placeholder' => 'Choose Profile'],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ],
            'columnOptions' => ['width' => '200px']
        ],
        'attend_by' => [
            'label' => 'Profile',
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\widgets\Select2::className(),
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map(\common\models\Profile::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
                'options' => ['placeholder' => 'Choose Profile'],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ],
            'columnOptions' => ['width' => '200px']
        ],
        'approved_at' => ['type' => TabularForm::INPUT_TEXT],
        'approved_by' => [
            'label' => 'Profile',
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\widgets\Select2::className(),
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map(\common\models\Profile::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
                'options' => ['placeholder' => 'Choose Profile'],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ],
            'columnOptions' => ['width' => '200px']
        ],
        'disposed_at' => ['type' => TabularForm::INPUT_TEXT],
        'disposed_by' => [
            'label' => 'Profile',
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\widgets\Select2::className(),
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map(\common\models\Profile::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
                'options' => ['placeholder' => 'Choose Profile'],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ],
            'columnOptions' => ['width' => '200px']
        ],
        'remark' => ['type' => TabularForm::INPUT_TEXT],
        'status_id' => [
            'label' => 'Gen value',
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\widgets\Select2::className(),
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map(\common\models\GenValue::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
                'options' => ['placeholder' => 'Choose Gen value'],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ],
            'columnOptions' => ['width' => '200px']
        ],
        'del' => [
            'type' => 'raw',
            'label' => '',
            'value' => function($model, $key) {
                return
                    Html::hiddenInput('Children[' . $key . '][id]', (!empty($model['id'])) ? $model['id'] : "") .
                    Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' =>  'Delete', 'onClick' => 'delRowDiposal(' . $key . '); return false;', 'id' => 'diposal-del-btn']);
            },
        ],
    ],
    'gridSettings' => [
        'panel' => [
            'heading' => false,
            'type' => GridView::TYPE_DEFAULT,
            'before' => false,
            'footer' => false,
            'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . 'Add Diposal', ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowDiposal()']),
        ]
    ]
]);
echo  "    </div>\n\n";
?>

