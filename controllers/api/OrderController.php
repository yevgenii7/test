<?php

namespace app\controllers\api;

use yii\rest\ActiveController;


class OrderController extends ActiveController
{
    public $modelClass = 'app\models\Order';
    
    // дополнительный метод
    public function actionTest()
    {
        return 'test';
    }
}
