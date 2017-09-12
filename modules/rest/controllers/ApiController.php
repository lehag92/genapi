<?php

namespace app\modules\rest\controllers;

use yii\rest\ActiveController;

/**
 * Class UserController
 * @package app\modules\rest\controllers
 */
class ApiController extends ActiveController
{
    public $modelClass = 'app\modules\rest\models\User';
}
