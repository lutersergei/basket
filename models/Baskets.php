<?php
namespace common\models;

use Yii;
use yii\mongodb\ActiveRecord;

/**
 * User model
 *
 * @property integer $_id
 * @property string $name
 * @property string $address

 */
class Baskets extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function collectionName()
    {
        return 'baskets';
    }

    /**
     * @return array
     */
    public function attributes()
    {
        return ['_id', 'user_id', 'family_id', 'created', 'city_id', 'products', 'execute', 'completed'];
    }

}