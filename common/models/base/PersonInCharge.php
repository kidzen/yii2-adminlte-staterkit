<?php

namespace common\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "person_in_charge".
 *
 * @property integer $id
 * @property integer $location_id
 * @property integer $profile_id
 * @property string $remark
 * @property integer $status_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 *
 * @property \common\models\GenValue $status
 * @property \common\models\Profile $createdBy
 * @property \common\models\Profile $updatedBy
 * @property \common\models\Location $location
 * @property \common\models\Profile $profile
 */
class PersonInCharge extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    private $_rt_softdelete;
    private $_rt_softrestore;

    public function __construct(){
        parent::__construct();
        $this->_rt_softdelete = [
            'deleted_by' => \Yii::$app->user->id,
            'deleted_at' => new \yii\db\Expression('CURRENT_TIMESTAMP'),
        ];
        $this->_rt_softrestore = [
            'deleted_by' => 0,
            'deleted_at' => new \yii\db\Expression('CURRENT_TIMESTAMP'),
        ];
    }

    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public static function relationNames()
    {
        return [
            'status',
            'createdBy',
            'updatedBy',
            'location',
            'profile'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['location_id', 'profile_id', 'status_id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['remark'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'person_in_charge';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'location_id' => Yii::t('app', 'Location'),
            'profile_id' => Yii::t('app', 'User'),
            'remark' => Yii::t('app', 'Remark'),
            'status_id' => Yii::t('app', 'Status'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(\common\models\GenValue::className(), ['id' => 'status_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(\common\models\Profile::className(), ['id' => 'created_by']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(\common\models\Profile::className(), ['id' => 'updated_by']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocation()
    {
        return $this->hasOne(\common\models\Location::className(), ['id' => 'location_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfile()
    {
        return $this->hasOne(\common\models\Profile::className(), ['id' => 'profile_id']);
    }
    
    /**
     * @inheritdoc
     * @return array mixed
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new \yii\db\Expression('CURRENT_TIMESTAMP'),
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
        ];
    }

    /**
     * The following code shows how to apply a default condition for all queries:
     *
     * ```php
     * class Customer extends ActiveRecord
     * {
     *     public static function find()
     *     {
     *         return parent::find()->andWhere(['deleted' => false]);
     *     }
     * }
     *
     * // Use andWhere()/orWhere() to apply the default condition
     * // SELECT FROM customer WHERE `deleted`=:deleted AND age>30
     * $customers = Customer::find()->andWhere('age>30')->all();
     *
     * // Use where() to ignore the default condition
     * // SELECT FROM customer WHERE age>30
     * $customers = Customer::find()->andWhere('age>30')->all();
     * ```
     */

    /**
     * @inheritdoc
     * @return \common\models\query\PersonInChargeQuery the active query used by this AR class.
     */
    public static function find()
    {
        $query = new \common\models\query\PersonInChargeQuery(get_called_class());
        // uncomment and edit permission rule to view own items only
        /*if(\Yii::$app->user->can('permission')){
           $query->mine();
        } */
        // uncomment and edit permission rule to view deleted items
        /*if(\Yii::$app->user->can('see_deleted')){
           return $query;
        } */
        return $query->andWhere(['person_in_charge.deleted_by' => 0]);
    }
}
