<?php

namespace common\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "location".
 *
 * @property integer $id
 * @property string $code
 * @property integer $company_id
 * @property string $name
 * @property string $address
 * @property string $city
 * @property integer $poscode
 * @property string $state
 * @property string $country
 * @property string $contact
 * @property string $fax
 * @property string $email
 * @property string $email_secondary
 * @property string $remark
 * @property integer $status_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 *
 * @property \common\models\Profile $createdBy
 * @property \common\models\Profile $updatedBy
 * @property \common\models\Company $company
 * @property \common\models\GenValue $status
 * @property \common\models\PersonInCharge[] $personInCharges
 */
class Location extends \yii\db\ActiveRecord
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
            'createdBy',
            'updatedBy',
            'company',
            'status',
            'personInCharges'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_id', 'poscode', 'status_id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['name', 'email'], 'required'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['code', 'name', 'address', 'city', 'state', 'country', 'contact', 'fax', 'email', 'email_secondary', 'remark'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'location';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'code' => Yii::t('app', 'Code'),
            'company_id' => Yii::t('app', 'Company'),
            'name' => Yii::t('app', 'Name'),
            'address' => Yii::t('app', 'Address'),
            'city' => Yii::t('app', 'City'),
            'poscode' => Yii::t('app', 'Poscode'),
            'state' => Yii::t('app', 'State'),
            'country' => Yii::t('app', 'Country'),
            'contact' => Yii::t('app', 'Contact'),
            'fax' => Yii::t('app', 'Fax'),
            'email' => Yii::t('app', 'Email'),
            'email_secondary' => Yii::t('app', 'Email Secondary'),
            'remark' => Yii::t('app', 'Remark'),
            'status_id' => Yii::t('app', 'Status'),
        ];
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
    public function getCompany()
    {
        return $this->hasOne(\common\models\Company::className(), ['id' => 'company_id']);
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
    public function getPersonInCharges()
    {
        return $this->hasMany(\common\models\PersonInCharge::className(), ['location_id' => 'id']);
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
     * @return \common\models\query\LocationQuery the active query used by this AR class.
     */
    public static function find()
    {
        $query = new \common\models\query\LocationQuery(get_called_class());
        // uncomment and edit permission rule to view own items only
        /*if(\Yii::$app->user->can('permission')){
           $query->mine();
        } */
        // uncomment and edit permission rule to view deleted items
        /*if(\Yii::$app->user->can('see_deleted')){
           return $query;
        } */
        return $query->andWhere(['location.deleted_by' => 0]);
    }
}
