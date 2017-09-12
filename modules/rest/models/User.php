<?php

namespace app\modules\rest\models;

use Yii;
use app\modules\rest\models\Phone;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $firstName
 * @property string $lastName
 *
 * @property Phones[] $phones
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['firstName', 'lastName'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'firstName' => 'First Name',
            'lastName' => 'Last Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhones()
    {
        return $this->hasMany(Phone::className(), ['user_id' => 'id']);
    }
}
