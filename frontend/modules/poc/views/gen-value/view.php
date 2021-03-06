<?php

use kartik\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\GenValue */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Gen Value', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gen-value-view">

    <div class="box">
        <div class="box-header">
            <h2 class="box-title"><?= 'Gen Value'.' '. Html::encode($this->title) ?></h2>
            <div class="pull-right">
                <?= Html::a(Yii::t('app', 'Back'), Yii::$app->request->referrer, ['class' => 'btn btn-sm btn-default']) ?>                        
                <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-sm btn-primary']) ?>
                <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-sm btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ])
                ?>
            </div>
        </div>
        <div class="box-body">

            <div class="nav-tabs-custom">

                <ul class="nav nav-tabs">
                    <li class="active"><a href="#GenValue" data-toggle="tab"><?= 'Gen Value' ?></a></li>
                    <li><a href="#Asset" data-toggle="tab"><?= 'Asset' ?></a></li>
                    <li><a href="#Category" data-toggle="tab"><?= 'Category' ?></a></li>
                    <li><a href="#Company" data-toggle="tab"><?= 'Company' ?></a></li>
                    <li><a href="#Diposal" data-toggle="tab"><?= 'Diposal' ?></a></li>
                    <li><a href="#DiposalItem" data-toggle="tab"><?= 'Diposal Item' ?></a></li>
                    <?php if ($model->createdBy) : ?>
                        <li><a href="#Profile" data-toggle="tab"><?= 'Profile' ?></a></li>
                    <?php endif; ?>
                    <?php if ($model->updatedBy) : ?>
                        <li><a href="#Profile" data-toggle="tab"><?= 'Profile' ?></a></li>
                    <?php endif; ?>
                    <li><a href="#Inventory" data-toggle="tab"><?= 'Inventory' ?></a></li>
                    <li><a href="#InventoryItem" data-toggle="tab"><?= 'Inventory Item' ?></a></li>
                    <li><a href="#JtSubcategory" data-toggle="tab"><?= 'Jt Subcategory' ?></a></li>
                    <li><a href="#Location" data-toggle="tab"><?= 'Location' ?></a></li>
                    <li><a href="#Maintenance" data-toggle="tab"><?= 'Maintenance' ?></a></li>
                    <li><a href="#Movement" data-toggle="tab"><?= 'Movement' ?></a></li>
                    <li><a href="#Order" data-toggle="tab"><?= 'Order' ?></a></li>
                    <li><a href="#OrderItem" data-toggle="tab"><?= 'Order Item' ?></a></li>
                    <li><a href="#PersonInCharge" data-toggle="tab"><?= 'Person In Charge' ?></a></li>
                    <li><a href="#Profile" data-toggle="tab"><?= 'Profile' ?></a></li>
                    <li><a href="#Setting" data-toggle="tab"><?= 'Setting' ?></a></li>
                    <li><a href="#Subcategory" data-toggle="tab"><?= 'Subcategory' ?></a></li>
                    <li><a href="#Transaction" data-toggle="tab"><?= 'Transaction' ?></a></li>
                    <li><a href="#User" data-toggle="tab"><?= 'User' ?></a></li>
                    <li><a href="#Warranty" data-toggle="tab"><?= 'Warranty' ?></a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="GenValue">
                        <?php 
                        $gridColumn = [
                        ['attribute' => 'id', 'visible' => false],
                        'code',
                        'name',
                        'description',
                        'remark',
                        [
            'attribute' => 'profiles.name',
            'label' => 'Status',
        ],
                        ];
                        echo DetailView::widget([
                            'model' => $model,
                            'attributes' => $gridColumn
                        ]);
                    ?>
                    </div>

                    <div class="tab-pane" id="Asset">
<?php
                    if($providerAsset->totalCount){
                        $gridColumnAsset = [
                            ['class' => 'yii\grid\SerialColumn'],
                            ['attribute' => 'id', 'visible' => false],
                            [
                'attribute' => 'category.name',
                'label' => 'Category'
            ],
                            [
                'attribute' => 'subcategory.name',
                'label' => 'Subcategory'
            ],
                            'asset_no',
                            'description',
                            [
                'attribute' => 'supplier.name',
                'label' => 'Supplier'
            ],
                            'supplier_code_no',
                            [
                'attribute' => 'manufacturer.name',
                'label' => 'Manufacturer'
            ],
                            'manufacturer_code_no',
                            'disposal_item_id',
                            'remark',
                                                    ];
                        echo Gridview::widget([
                            'dataProvider' => $providerAsset,
                            'pjax' => true,
                            'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-asset']],
                            'panel' => [
                                'type' => GridView::TYPE_PRIMARY,
                                'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Asset'),
                            ],
                            'export' => false,
                            'columns' => $gridColumnAsset
                        ]);
}
                        ?>

                        </div>

                    <div class="tab-pane" id="Category">
<?php
                    if($providerCategory->totalCount){
                        $gridColumnCategory = [
                            ['class' => 'yii\grid\SerialColumn'],
                            ['attribute' => 'id', 'visible' => false],
                            'name',
                            'description',
                            'remark',
                                                    ];
                        echo Gridview::widget([
                            'dataProvider' => $providerCategory,
                            'pjax' => true,
                            'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-category']],
                            'panel' => [
                                'type' => GridView::TYPE_PRIMARY,
                                'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Category'),
                            ],
                            'export' => false,
                            'columns' => $gridColumnCategory
                        ]);
}
                        ?>

                        </div>

                    <div class="tab-pane" id="Company">
<?php
                    if($providerCompany->totalCount){
                        $gridColumnCompany = [
                            ['class' => 'yii\grid\SerialColumn'],
                            ['attribute' => 'id', 'visible' => false],
                            'code',
                            'name',
                            'logo',
                            'remark',
                                                    ];
                        echo Gridview::widget([
                            'dataProvider' => $providerCompany,
                            'pjax' => true,
                            'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-company']],
                            'panel' => [
                                'type' => GridView::TYPE_PRIMARY,
                                'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Company'),
                            ],
                            'export' => false,
                            'columns' => $gridColumnCompany
                        ]);
}
                        ?>

                        </div>

                    <div class="tab-pane" id="Diposal">
<?php
                    if($providerDiposal->totalCount){
                        $gridColumnDiposal = [
                            ['class' => 'yii\grid\SerialColumn'],
                            ['attribute' => 'id', 'visible' => false],
                            [
                'attribute' => 'transaction.id',
                'label' => 'Transaction'
            ],
                            'order_no',
                            'order_date',
                            'attend_date',
                                                        [
                'attribute' => 'orderBy.name',
                'label' => 'Order By'
            ],
                            [
                'attribute' => 'attendBy.name',
                'label' => 'Attend By'
            ],
                            'approved_at',
                            [
                'attribute' => 'approvedBy.name',
                'label' => 'Approved By'
            ],
                            'disposed_at',
                            [
                'attribute' => 'disposedBy.name',
                'label' => 'Disposed By'
            ],
                            'remark',
                                                    ];
                        echo Gridview::widget([
                            'dataProvider' => $providerDiposal,
                            'pjax' => true,
                            'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-diposal']],
                            'panel' => [
                                'type' => GridView::TYPE_PRIMARY,
                                'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Diposal'),
                            ],
                            'export' => false,
                            'columns' => $gridColumnDiposal
                        ]);
}
                        ?>

                        </div>

                    <div class="tab-pane" id="DiposalItem">
<?php
                    if($providerDiposalItem->totalCount){
                        $gridColumnDiposalItem = [
                            ['class' => 'yii\grid\SerialColumn'],
                            ['attribute' => 'id', 'visible' => false],
                            'disposal_id',
                            'item_id',
                            'order_no',
                            'order_date',
                            'attend_date',
                                                                                                                [
                'attribute' => 'orderBy.name',
                'label' => 'Order By'
            ],
                            [
                'attribute' => 'attendBy.name',
                'label' => 'Attend By'
            ],
                            'approved_at',
                            [
                'attribute' => 'approvedBy.name',
                'label' => 'Approved By'
            ],
                            'remark',
                                                    ];
                        echo Gridview::widget([
                            'dataProvider' => $providerDiposalItem,
                            'pjax' => true,
                            'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-diposal-item']],
                            'panel' => [
                                'type' => GridView::TYPE_PRIMARY,
                                'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Diposal Item'),
                            ],
                            'export' => false,
                            'columns' => $gridColumnDiposalItem
                        ]);
}
                        ?>

                        </div>
                        <?php if ($model->createdBy) : ?>
                        <div class="tab-pane" id="Profile">
                        <?php 
                        $gridColumnProfile = [
                        ['attribute' => 'id', 'visible' => false],
                        'user_id',
                        'name',
                        'ic_no',
                        'contact',
                        'staff_no',
                        'email',
                        'remark',
                        [
            'attribute' => 'status.name',
            'label' => 'Status',
        ],
                        ];
                        echo DetailView::widget([
                            'model' => $model->createdBy,
                            'attributes' => $gridColumnProfile
                        ]);
                        ?>
                        </div>
                    <?php endif; ?>
                        <?php if ($model->updatedBy) : ?>
                        <div class="tab-pane" id="Profile">
                        <?php 
                        $gridColumnProfile = [
                        ['attribute' => 'id', 'visible' => false],
                        'user_id',
                        'name',
                        'ic_no',
                        'contact',
                        'staff_no',
                        'email',
                        'remark',
                        [
            'attribute' => 'status.name',
            'label' => 'Status',
        ],
                        ];
                        echo DetailView::widget([
                            'model' => $model->updatedBy,
                            'attributes' => $gridColumnProfile
                        ]);
                        ?>
                        </div>
                    <?php endif; ?>

                    <div class="tab-pane" id="Inventory">
<?php
                    if($providerInventory->totalCount){
                        $gridColumnInventory = [
                            ['class' => 'yii\grid\SerialColumn'],
                            ['attribute' => 'id', 'visible' => false],
                            'code_no',
                            'card_no',
                            [
                'attribute' => 'category.name',
                'label' => 'Category'
            ],
                            [
                'attribute' => 'subcategory.name',
                'label' => 'Subcategory'
            ],
                            'description',
                            'remark',
                                                    ];
                        echo Gridview::widget([
                            'dataProvider' => $providerInventory,
                            'pjax' => true,
                            'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-inventory']],
                            'panel' => [
                                'type' => GridView::TYPE_PRIMARY,
                                'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Inventory'),
                            ],
                            'export' => false,
                            'columns' => $gridColumnInventory
                        ]);
}
                        ?>

                        </div>

                    <div class="tab-pane" id="InventoryItem">
<?php
                    if($providerInventoryItem->totalCount){
                        $gridColumnInventoryItem = [
                            ['class' => 'yii\grid\SerialColumn'],
                            ['attribute' => 'id', 'visible' => false],
                            'code_no',
                            'card_no',
                            'serial_no',
                            [
                'attribute' => 'checkin.id',
                'label' => 'Checkin'
            ],
                            [
                'attribute' => 'checkout.id',
                'label' => 'Checkout'
            ],
                            [
                'attribute' => 'supplier.name',
                'label' => 'Supplier'
            ],
                            'supplier_code_no',
                            [
                'attribute' => 'manufacturer.name',
                'label' => 'Manufacturer'
            ],
                            'manufacturer_code_no',
                            [
                'attribute' => 'client.name',
                'label' => 'Client'
            ],
                            'client_code_no',
                            'disposal_item_id',
                            'remark',
                                                    ];
                        echo Gridview::widget([
                            'dataProvider' => $providerInventoryItem,
                            'pjax' => true,
                            'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-inventory-item']],
                            'panel' => [
                                'type' => GridView::TYPE_PRIMARY,
                                'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Inventory Item'),
                            ],
                            'export' => false,
                            'columns' => $gridColumnInventoryItem
                        ]);
}
                        ?>

                        </div>

                    <div class="tab-pane" id="JtSubcategory">
<?php
                    if($providerJtSubcategory->totalCount){
                        $gridColumnJtSubcategory = [
                            ['class' => 'yii\grid\SerialColumn'],
                            [
                'attribute' => 'category.name',
                'label' => 'Category'
            ],
                            [
                'attribute' => 'subcategory.name',
                'label' => 'Subcategory'
            ],
                            'remark',
                                                    ];
                        echo Gridview::widget([
                            'dataProvider' => $providerJtSubcategory,
                            'pjax' => true,
                            'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-jt-subcategory']],
                            'panel' => [
                                'type' => GridView::TYPE_PRIMARY,
                                'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Jt Subcategory'),
                            ],
                            'export' => false,
                            'columns' => $gridColumnJtSubcategory
                        ]);
}
                        ?>

                        </div>

                    <div class="tab-pane" id="Location">
<?php
                    if($providerLocation->totalCount){
                        $gridColumnLocation = [
                            ['class' => 'yii\grid\SerialColumn'],
                            ['attribute' => 'id', 'visible' => false],
                            'code',
                            [
                'attribute' => 'company.name',
                'label' => 'Company'
            ],
                            'name',
                            'address',
                            'city',
                            'poscode',
                            'state',
                            'country',
                            'contact',
                            'fax',
                            'email:email',
                            'email_secondary:email',
                            'remark',
                                                    ];
                        echo Gridview::widget([
                            'dataProvider' => $providerLocation,
                            'pjax' => true,
                            'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-location']],
                            'panel' => [
                                'type' => GridView::TYPE_PRIMARY,
                                'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Location'),
                            ],
                            'export' => false,
                            'columns' => $gridColumnLocation
                        ]);
}
                        ?>

                        </div>

                    <div class="tab-pane" id="Maintenance">
<?php
                    if($providerMaintenance->totalCount){
                        $gridColumnMaintenance = [
                            ['class' => 'yii\grid\SerialColumn'],
                            ['attribute' => 'id', 'visible' => false],
                            'item_id',
                                                        'date',
                            'supplier_id',
                            'remark',
                                                    ];
                        echo Gridview::widget([
                            'dataProvider' => $providerMaintenance,
                            'pjax' => true,
                            'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-maintenance']],
                            'panel' => [
                                'type' => GridView::TYPE_PRIMARY,
                                'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Maintenance'),
                            ],
                            'export' => false,
                            'columns' => $gridColumnMaintenance
                        ]);
}
                        ?>

                        </div>

                    <div class="tab-pane" id="Movement">
<?php
                    if($providerMovement->totalCount){
                        $gridColumnMovement = [
                            ['class' => 'yii\grid\SerialColumn'],
                            ['attribute' => 'id', 'visible' => false],
                            'item_id',
                                                        'date',
                            'from',
                            'to',
                            'remark',
                                                    ];
                        echo Gridview::widget([
                            'dataProvider' => $providerMovement,
                            'pjax' => true,
                            'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-movement']],
                            'panel' => [
                                'type' => GridView::TYPE_PRIMARY,
                                'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Movement'),
                            ],
                            'export' => false,
                            'columns' => $gridColumnMovement
                        ]);
}
                        ?>

                        </div>

                    <div class="tab-pane" id="Order">
<?php
                    if($providerOrder->totalCount){
                        $gridColumnOrder = [
                            ['class' => 'yii\grid\SerialColumn'],
                            ['attribute' => 'id', 'visible' => false],
                            [
                'attribute' => 'transaction.id',
                'label' => 'Transaction'
            ],
                            'order_no',
                            'order_date',
                            'attend_date',
                                                        [
                'attribute' => 'seller.name',
                'label' => 'Seller'
            ],
                            [
                'attribute' => 'buyyer.name',
                'label' => 'Buyyer'
            ],
                            [
                'attribute' => 'orderBy.name',
                'label' => 'Order By'
            ],
                            [
                'attribute' => 'attendBy.name',
                'label' => 'Attend By'
            ],
                            'approved_at',
                            [
                'attribute' => 'approvedBy.name',
                'label' => 'Approved By'
            ],
                            'remark',
                                                    ];
                        echo Gridview::widget([
                            'dataProvider' => $providerOrder,
                            'pjax' => true,
                            'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-order']],
                            'panel' => [
                                'type' => GridView::TYPE_PRIMARY,
                                'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Order'),
                            ],
                            'export' => false,
                            'columns' => $gridColumnOrder
                        ]);
}
                        ?>

                        </div>

                    <div class="tab-pane" id="OrderItem">
<?php
                    if($providerOrderItem->totalCount){
                        $gridColumnOrderItem = [
                            ['class' => 'yii\grid\SerialColumn'],
                            ['attribute' => 'id', 'visible' => false],
                                                        [
                'attribute' => 'order.id',
                'label' => 'Order'
            ],
                            'item_id',
                            'rq_quantity',
                            'app_quantity',
                            'approved_at',
                            [
                'attribute' => 'approvedBy.name',
                'label' => 'Approved By'
            ],
                            'remark',
                                                    ];
                        echo Gridview::widget([
                            'dataProvider' => $providerOrderItem,
                            'pjax' => true,
                            'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-order-item']],
                            'panel' => [
                                'type' => GridView::TYPE_PRIMARY,
                                'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Order Item'),
                            ],
                            'export' => false,
                            'columns' => $gridColumnOrderItem
                        ]);
}
                        ?>

                        </div>

                    <div class="tab-pane" id="PersonInCharge">
<?php
                    if($providerPersonInCharge->totalCount){
                        $gridColumnPersonInCharge = [
                            ['class' => 'yii\grid\SerialColumn'],
                            ['attribute' => 'id', 'visible' => false],
                            [
                'attribute' => 'location.name',
                'label' => 'Location'
            ],
                            [
                'attribute' => 'profile.name',
                'label' => 'Profile'
            ],
                            'remark',
                                                    ];
                        echo Gridview::widget([
                            'dataProvider' => $providerPersonInCharge,
                            'pjax' => true,
                            'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-person-in-charge']],
                            'panel' => [
                                'type' => GridView::TYPE_PRIMARY,
                                'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Person In Charge'),
                            ],
                            'export' => false,
                            'columns' => $gridColumnPersonInCharge
                        ]);
}
                        ?>

                        </div>

                    <div class="tab-pane" id="Profile">
<?php
                    if($providerProfile->totalCount){
                        $gridColumnProfile = [
                            ['class' => 'yii\grid\SerialColumn'],
                            ['attribute' => 'id', 'visible' => false],
                            [
                'attribute' => 'user.username',
                'label' => 'User'
            ],
                            'name',
                            'ic_no',
                            'contact',
                            'staff_no',
                            'email:email',
                            'remark',
                                                    ];
                        echo Gridview::widget([
                            'dataProvider' => $providerProfile,
                            'pjax' => true,
                            'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-profile']],
                            'panel' => [
                                'type' => GridView::TYPE_PRIMARY,
                                'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Profile'),
                            ],
                            'export' => false,
                            'columns' => $gridColumnProfile
                        ]);
}
                        ?>

                        </div>

                    <div class="tab-pane" id="Setting">
<?php
                    if($providerSetting->totalCount){
                        $gridColumnSetting = [
                            ['class' => 'yii\grid\SerialColumn'],
                            ['attribute' => 'id', 'visible' => false],
                            'label',
                            'description',
                            'key',
                            'value',
                            'start_date',
                            'end_date',
                            'remark',
                                                    ];
                        echo Gridview::widget([
                            'dataProvider' => $providerSetting,
                            'pjax' => true,
                            'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-setting']],
                            'panel' => [
                                'type' => GridView::TYPE_PRIMARY,
                                'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Setting'),
                            ],
                            'export' => false,
                            'columns' => $gridColumnSetting
                        ]);
}
                        ?>

                        </div>

                    <div class="tab-pane" id="Subcategory">
<?php
                    if($providerSubcategory->totalCount){
                        $gridColumnSubcategory = [
                            ['class' => 'yii\grid\SerialColumn'],
                            ['attribute' => 'id', 'visible' => false],
                            'name',
                            'description',
                            'remark',
                                                    ];
                        echo Gridview::widget([
                            'dataProvider' => $providerSubcategory,
                            'pjax' => true,
                            'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-subcategory']],
                            'panel' => [
                                'type' => GridView::TYPE_PRIMARY,
                                'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Subcategory'),
                            ],
                            'export' => false,
                            'columns' => $gridColumnSubcategory
                        ]);
}
                        ?>

                        </div>

                    <div class="tab-pane" id="Transaction">
<?php
                    if($providerTransaction->totalCount){
                        $gridColumnTransaction = [
                            ['class' => 'yii\grid\SerialColumn'],
                            ['attribute' => 'id', 'visible' => false],
                                                        'date',
                            'remark',
                                                    ];
                        echo Gridview::widget([
                            'dataProvider' => $providerTransaction,
                            'pjax' => true,
                            'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-transaction']],
                            'panel' => [
                                'type' => GridView::TYPE_PRIMARY,
                                'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Transaction'),
                            ],
                            'export' => false,
                            'columns' => $gridColumnTransaction
                        ]);
}
                        ?>

                        </div>

                    <div class="tab-pane" id="User">
<?php
                    if($providerUser->totalCount){
                        $gridColumnUser = [
                            ['class' => 'yii\grid\SerialColumn'],
                            ['attribute' => 'id', 'visible' => false],
                            'username',
                            'auth_key',
                            'password_hash',
                            'password_reset_token',
                            'email:email',
                            'remark',
                                                    ];
                        echo Gridview::widget([
                            'dataProvider' => $providerUser,
                            'pjax' => true,
                            'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-user']],
                            'panel' => [
                                'type' => GridView::TYPE_PRIMARY,
                                'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('User'),
                            ],
                            'export' => false,
                            'columns' => $gridColumnUser
                        ]);
}
                        ?>

                        </div>

                    <div class="tab-pane" id="Warranty">
<?php
                    if($providerWarranty->totalCount){
                        $gridColumnWarranty = [
                            ['class' => 'yii\grid\SerialColumn'],
                            ['attribute' => 'id', 'visible' => false],
                            'item_id',
                            'supplier_id',
                                                        'start_date',
                            'end_date',
                            'remark',
                                                    ];
                        echo Gridview::widget([
                            'dataProvider' => $providerWarranty,
                            'pjax' => true,
                            'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-warranty']],
                            'panel' => [
                                'type' => GridView::TYPE_PRIMARY,
                                'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Warranty'),
                            ],
                            'export' => false,
                            'columns' => $gridColumnWarranty
                        ]);
}
                        ?>

                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
