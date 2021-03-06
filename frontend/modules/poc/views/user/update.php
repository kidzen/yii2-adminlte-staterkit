<?php

use kartik\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Update User: ' . ' ' . $model->username;
//$this->params['breadcrumbs'][] = ['label' => 'User', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->id]];
//$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-update">
	<div class="panel panel-danger">
		<div class="panel-heading">
		    <h1 class="panel-title"><?= Html::encode($this->title) ?></h1>
		</div>
		<div class="panel-body">
		    <?= $this->render('_form', [
		        'model' => $model,
		    ]) ?>
		</div>
	</div>
</div>
