<?php
namespace app\models;

use MongoDB\BSON\ObjectID;
use yii\mongodb\ActiveRecord;

/**
 * Category model
 *
 * @property ObjectID $_id
 * @property string $name
 */
class Category extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function collectionName()
    {
        return 'category';
    }

    /**
     * @return array
     */
    public function attributes()
    {
        return ['_id', 'name', 'pictureName', 'subList'];
    }

}