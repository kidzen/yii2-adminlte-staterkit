<?php

use kartik\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\JtSubcategory */

?>
<div class="jt-subcategory-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Html::encode($model->category_id) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        [
            'attribute' => 'category.name',
            'label' => 'Category',
        ],
        [
            'attribute' => 'subcategory.name',
            'label' => 'Subcategory',
        ],
        'remark',
        [
            'attribute' => 'status.name',
            'label' => 'Status',
        ],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]);
?>
    </div>
</div>
