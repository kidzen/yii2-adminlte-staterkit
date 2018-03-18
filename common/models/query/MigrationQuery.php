<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\query\Migration]].
 *
 * @see \common\models\query\Migration
 */
class MigrationQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        if(!\Yii::$app->user->can('Administrator')) {
            $this->andWhere('[[status]]=1');
        }
        return $this;
    }*/

    public function mine()
    {
            $this->andWhere('[[created_by]]='.\Yii::$app->user->id);
        return $this;
    }

    /**
     * @inheritdoc
     * @return \common\models\query\Migration[]|array
     */
    public function all($db = null, $bypass = false)
    {
        if($bypass) {
            return parent::all($db);
        }
        if(!\Yii::$app->user->can('Administrator')) {
            $this->mine();
        }
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\Migration|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
