<?php
namespace app\models;

use MongoDB\BSON\ObjectID;
use Yii;
use yii\mongodb\ActiveRecord;

/**
 * User model
 *
 * @property ObjectID $_id
 * @property ObjectID $user_id
 * @property string $family_id
 * @property string $created
 * @property string $city_id
 * @property array $products
 * @property string $execute
 * @property string $completed
 * @property User $user

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

    /**
     * @return \yii\db\ActiveQueryInterface
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['_id' => 'user_id']);
    }

}