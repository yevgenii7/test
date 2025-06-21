<?php

namespace app\controllers;

use yii\web\Controller;

class AdminController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'edit'],
                        'roles' => ['@'], // Только для аутентифицированных пользователей
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('../admin/index');
    }
}