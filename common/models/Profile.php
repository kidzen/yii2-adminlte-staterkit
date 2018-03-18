<?php

namespace common\models;

use Yii;
use \common\models\base\Profile as BaseProfile;

/**
 * This is the model class for table "profile".
 */
class Profile extends BaseProfile
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['ic_no', 'status'], 'integer'],
            [['email'], 'required'],
            [['created_at', 'updated_at', 'deleted_at', 'created_by', 'updated_by', 'deleted_by'], 'safe'],
            [['name', 'contact', 'email'], 'string', 'max' => 255],
            [['email'], 'unique']
        ]
        );
    }


    /**
     * @inheritdoc
     */
    /* public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        // add code here. given sample code
        if ($insert === false) {
            return; // only work with newly created payments
        }

        if ($this->credit->save(false) === false) {
            throw new Exception("credit couldn't be update");
        }
    } */

    /**
     * @inheritdoc
     */
    /* public function beforeSave($insert)
    {
        // custom code here
        return parent::beforeSave($insert);
    } */
}
