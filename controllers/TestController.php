<?php

namespace app\controllers;

use yii\web\Controller;

class TestController extends AdminController
{
    public function actionEdit($id)
    {
        // Логика для редактирования товара с заданным ID
        return $this->render('../admin/test/edit', ['id' => $id]);
    }
}
