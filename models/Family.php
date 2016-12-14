<?php
namespace app\models;

use MongoDB\BSON\ObjectID;
use yii\mongodb\ActiveRecord;

/**
 * Family model
 *
 * @property ObjectID $_id
 * @property array $users
 */
class Family extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function collectionName()
    {
        return 'family';
    }

    /**
     * @return array
     */
    public function attributes()
    {
        return ['_id', 'users'];
    }
}
