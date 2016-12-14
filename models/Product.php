<?php
namespace app\models;

use MongoDB\BSON\ObjectID;
use yii\mongodb\ActiveRecord;

/**
 * Product model
 *
 * @property ObjectID $_id
 * @property string $name
 */
class Product extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function collectionName()
    {
        return 'product';
    }

    /**
     * @return array
     */
    public function attributes()
    {
        return ['_id', 'category_id', 'name'];
    }

}