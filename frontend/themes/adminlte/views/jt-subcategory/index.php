<?php

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\JtSubcategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use kartik\helpers\Html;
use kartik\export\ExportMenu;
use kartik\dynagrid\DynaGrid;
use kartik\grid\GridView;

$this->title = 'Jt Subcategory';
$this->params['breadcrumbs'][] = $this->title;
$search = "$('.search-button').click(function(){
	$('.search-form').toggle(500);
	return false;
});";
$this->registerJs($search);
?>
<div class="jt-subcategory-index">

    <div class="search-form" style="display:none">
        <?=  $this->render('_search', ['model' => $searchModel]); ?>
    </div>
    <?php 
    $gridColumn = [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'class' => 'kartik\grid\ExpandRowColumn',
            'width' => '50px',
            'value' => function ($model, $key, $index, $column) {
                return GridView::ROW_COLLAPSED;
            },
            'detail' => function ($model, $key, $index, $column) {
                return Yii::$app->controller->renderPartial('_expand', ['model' => $model]);
            },
            'headerOptions' => ['class' => 'kartik-sheet-style'],
            'expandOneOnly' => true,
            'visible' => true,
        ],
        [
                'attribute' => 'category_id',
                'label' => 'Category',
                'value' => function($model){
                    return $model->category->name;
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => \yii\helpers\ArrayHelper::map(\common\models\Category::find()->asArray()->all(), 'id', 'name'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Category', 'id' => 'grid-jt-subcategory-search-category_id']
            ],
        [
                'attribute' => 'subcategory_id',
                'label' => 'Subcategory',
                'value' => function($model){
                    return $model->subcategory->name;
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => \yii\helpers\ArrayHelper::map(\common\models\Subcategory::find()->asArray()->all(), 'id', 'name'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Subcategory', 'id' => 'grid-jt-subcategory-search-subcategory_id']
            ],
        'remark',
        [
                'attribute' => 'status_id',
                'label' => 'Status',
                'value' => function($model){
                    if ($model->status)
                    {return $model->status->name;}
                    else
                    {return NULL;}
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => \yii\helpers\ArrayHelper::map(\common\models\GenValue::find()->asArray()->all(), 'id', 'name'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Gen value', 'id' => 'grid-jt-subcategory-search-status_id']
            ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view} {update} {delete} {delete-permanent}',
            'buttons' => [
                'delete-permanent' => function ($url) {
                    return Html::a('<span class="glyphicon glyphicon-trash" style="color:red"></span>', $url, ['title' => 'Delete Permanent']);
                },
            ],
            'visibleButtons' => [
                'delete-permanent' => \Yii::$app->user->can('admin'),
            ]
        ],
    ];
    ?>
    <?= DynaGrid::widget([
        'columns'=>$gridColumn,
        'storage'=>DynaGrid::TYPE_COOKIE,
        'theme'=>'panel-danger',
        'showPersonalize'=>true,
        'gridOptions'=>[
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'filterSelector' => 'select[name="per-page"]',
            // 'showPageSummary'=>true,
            //'floatHeader'=>true,
            //'responsiveWrap'=>false,
            'pjax' => true,
            'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-jt-subcategory']],
            'panel' => [
                'heading' => '<span class="glyphicon glyphicon-book"></span>  ' . Html::encode($this->title),
                'before' =>  '<div style="padding-top: 7px;"><em>* The table header sticks to the top in this demo as you scroll</em></div>',
                'after' => false,
            ],
            // 'export' => false,
            // your toolbar can include the additional full export menu
            'toolbar' => [
                ['content'=>
                    Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'], ['class' => 'btn btn-success', 'title'=>'Create Jt Subcategory']) . ' '.
                    Html::a('Advance Search', '#', ['class' => 'btn btn-info search-button'])
                ],
                ['content'=>'{dynagridFilter}{dynagridSort}{dynagrid}'],
                '{export}',
                '{toggleData}',
                'exportConfig' => [
                    // ExportMenu::FORMAT_PDF => false
                ]
            ],
        ],
        'options'=>['id'=>'dynagrid-1'] // a unique identifier is important
    ]); ?>

</div>
