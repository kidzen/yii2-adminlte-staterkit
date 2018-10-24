<div class="form-group" id="add-order-item">
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
        'formName' => 'OrderItem',
        'checkboxColumn' => false,
        'actionColumn' => false,
        'attributeDefaults' => [
            'type' => TabularForm::INPUT_TEXT,
        ],
        'attributes' => [
            "id" => ['type' => TabularForm::INPUT_HIDDEN, 'columnOptions' => ['hidden'=>true]],
            'item_id' => [
                'label' => 'Item',
                'type' => TabularForm::INPUT_WIDGET,
                'widgetClass' => \kartik\widgets\DepDrop::className(),
                'options' => [
                    'options' => ['placeholder' => 'Choose Item'],
                    'pluginOptions'=>[
                        'depends'=>['order-item-type-id'],
                        'placeholder'=>'Select...',
                        'allowClear' => true,
                        'url'=> \yii\helpers\Url::to(['/site/prod'])
                    ]
                ],
            ],
            'rq_quantity' => [
                'type' => TabularForm::INPUT_TEXT,
                'columnOptions' => ['width' => '200px']
            ],
            'remark' => [
                'type' => TabularForm::INPUT_TEXT,
                'columnOptions' => ['width' => '200px']
            ],
            'del' => [
                'type' => 'raw',
                'label' => '',
                'value' => function($model, $key) {
                    return
                    Html::hiddenInput('Children[' . $key . '][id]', (!empty($model['id'])) ? $model['id'] : "") .
                    Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' =>  'Delete', 'onClick' => 'delRowOrderItem(' . $key . '); return false;', 'id' => 'order-item-del-btn']);
                },
            ],
        ],
        'gridSettings' => [
            'panel' => [
                'heading' => false,
                'type' => GridView::TYPE_DEFAULT,
                'before' => false,
                'footer' => false,
                'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . 'Add Order Item', ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowOrderItem()']),
            ]
        ]
    ]);
    echo  "    </div>\n\n";
    ?>
