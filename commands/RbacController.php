<?php
namespace app\commands;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // добавляем разрешение "createOrder"
        $createOrder = $auth->createPermission('createOrder');
        $createOrder->description = 'Create a order';
        $auth->add($createOrder);

        // добавляем разрешение "changeOrderStatus"
        $changeOrderStatus = $auth->createPermission('changeOrderStatus');
        $changeOrderStatus->description = 'Change order status';
        $auth->add($changeOrderStatus);
        
        // добавляем разрешение "viewOrder" (просмотр заказа)
        $viewOrder = $auth->createPermission('viewOrder');
        $viewOrder->description = 'View order';
        $auth->add($viewOrder);
        
        // добавляем разрешение "deleteOrder"
        $deleteOrder = $auth->createPermission('deleteOrder');
        $deleteOrder->description = 'Delete order';
        $auth->add($deleteOrder);
        
        //добавляем роль "buyer" (покупатель), с правом создавать заказ
        $buyer = $auth->createRole('buyer');
        $auth->add($buyer);
        $auth->addChild($buyer, $createOrder);
        $auth->addChild($buyer, $deleteOrder);

        // добавляем роль "manager" и даём роли разрешение "createPost"
        $manager = $auth->createRole('manager');
        $auth->add($manager);
        $auth->addChild($manager, $changeOrderStatus);
        $auth->addChild($manager, $viewOrder);

        // добавляем роль "admin" и даём роли разрешение "updatePost"
        // а также все разрешения роли "author"
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $buyer);
        $auth->addChild($admin, $manager);

    }
}