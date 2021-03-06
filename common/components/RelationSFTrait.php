<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\components;

use yii\data\DataProviderInterface;
use yii\db\QueryInterface;

/**
 * Description of SearchTrait
 *
 * Use this trait to easily add ability to display/filter by related entity attribute.
 * It also allows to use table aliases.
 * Extension is pretty simple but makes the code cleaner, especially when using aliases
 * (there are some auto-formatting bugs in some IDEs).
 *
 * To use the trait you need to do the following (first example without using aliases):
 * 1. In top of your class body put:
 *
 * ```
 * class XxxSearch extends Model {
 *   use \codiverum\relationSF\RelationSFTrait;
 * ```
 *
 * 2. Make new public attribute in your class:
 *
 * ```
 * public $relation_name;
 * ```
 *
 * 3. Add your attribute to safe attributes
 * 4. In your search function add following:
 *   - after creating $query add:
 *
 * ```
 * $this->joinWithRelation($query, 'relation_name');
 * ```
 *
 *   - after creating $dataProvider add:
 *
 * ```
 * $this->addRelationSort($dataProvider, 'relation_name', 'related_table_field_name');
 * ```
 *
 *   - after creating query filters add:
 *
 * ```
 * $this->addRelationFilter($query, 'relation_name', 'related_table_field_name');
 * ```
 *
 * 5. Add to GridView columns array:
 *
 * ```
 * [
 *   'attribute' => 'relation_name',
 *   'value' => 'relation_name.related_table_field_name',
 * ],
 *
 * That's it.
 *
 * For advanced usage with tables aliases see README.
 *
 * @author Jozek
 */
trait RelationSFTrait {

    /**
     *
     * @param DataProviderInterface $dataProvider
     * @param string $attribute name of defined public property
     * @param string $fieldName related table's field name
     * @param string $tableName table name or alias (if defined in `joinWithRelation()` method)
     */
    public function addRelationSort(&$dataProvider, $attribute, $fieldName, $tableName) {
        $dataProvider->sort->attributes[$attribute] = [
            'asc' => [$this->getRelationSearchTableName($tableName, $attribute) . '.' . $fieldName => SORT_ASC],
            'desc' => [$this->getRelationSearchTableName($tableName, $attribute) . '.' . $fieldName => SORT_DESC],
        ];
    }

    public function addAllRelationSort(&$dataProvider, $relAttributes) {
        foreach ($relAttributes as $property => $attribute) {
            $dataProvider->sort->attributes[$property] = [
                'asc' => [$attribute => SORT_ASC],
                'desc' => [$attribute => SORT_DESC],
            ];
        }
        // foreach ($relAttributes as $property => $attribute) {
        //     $dataProvider->sort->attributes[$property] = [
        //         'asc' => ['$this->relationAttributes[\''.$attribute.'\']' => SORT_ASC],
        //         'desc' => ['$this->relationAttributes[\''.$attribute.'\']' => SORT_DESC],
        //     ];
        // }
    }

    public function addAllRelationFilter(&$query, $relAttributes, $operator = 'like') {
        foreach ($relAttributes as $property => $attribute) {
            $query->andFilterWhere([$operator, $attribute, $this->{$property}]);
        }
        // foreach ($relAttributes as $property => $attribute) {
        //     $query->andFilterWhere([$operator, $attribute, $this->{$property}]);
        // }
    }


    /**
     *
     * @param QueryInterface $query
     * @param string $attribute name of defined public property
     * @param string $fieldName related table's field name
     * @param string $tableName table name or alias (if defined in `joinWithRelation()` method)
     * @param string $operator defaults to 'like'
     */
    public function addRelationFilter(&$query, $attribute, $fieldName, $tableName, $operator = 'like') {
        $query->andFilterWhere([$operator, $this->getRelationSearchTableName($tableName, $attribute) . '.' . $fieldName, $this->{$attribute}]);
    }

    /**
     *
     * @param string $tableName
     * @return string
     */
    protected function getRelationSearchTableName($tableName, $attribute) {
        return empty($tableName) ? $attribute : $tableName;
    }

    /**
     *
     * @param QueryInterface $query
     * @param string $relationName
     * @param string $relationTableName defaults to null (use when you create alias)
     * @param string $relationTableAlias defaults to null (use when you create alias)
     */
    public function joinWithRelation(&$query, $relationName, $relationTableName = null, $relationTableAlias = null) {
        if (empty($relationTableAlias))
            $query->joinWith([$relationName]);
        else {
            $query->joinWith([
                $relationName => function($query) use ($relationTableAlias, $relationTableName) {
                    $query->from([$relationTableAlias => $relationTableName]);
                }
            ]);
        }
    }

    public function getRelationAttributes()
    {
        //array_merge(array_keys($this->relationAttributes),
        $fks = (new parent)->getTableSchema()->foreignKeys;
        $relAttributes = [];
        foreach ($fks as $key => $fk) {
            $relColumn = strtr(array_keys($fk)[1],['_id'=>'']);
            $humanize = \yii\helpers\Inflector::camelize($fk[0]);
            $class = '\\common\\models\\'.$humanize;
            $model = new $class();
            foreach ($model->attributes as $col => $data) {
                // $property = 'rel_'.lcfirst($humanize).'_'.$col;
                $property = 'rel_'.$relColumn.'_'.$col;
                $attribute = lcfirst($humanize).'.'.$col;
                $relAttributes[$property] = $attribute;
            }
        }

        return $relAttributes;
    }


    // public void __set ($_property) {
    //     // foreach ($relAttributes as $property => $attribute) {
    //         $this->{$property};
    //     // }

    // }
    // public function __get($property)
    // {
    //     if(isset($this->property) {
    //         return $this->property;
    //     } else {
    //         $this->property = $this->_property;
    //     }


    // }

    // public function createProperty($name){
    //     $this->{$name} = '';
    // }
    // public function createProperty($relAttributes){
    //     foreach ($relAttributes as $attribute => $property) {
    //         $this->{$attribute};
    //     }
    // }
}
