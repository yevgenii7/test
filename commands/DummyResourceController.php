<?php
/**
 * @link https://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license https://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;
use app\services\JsonDataParser;
use app\services\DummyService;

class DummyResourceController extends Controller
{
    private $dummyService;
    private $dataParser;

    // внедрение зависимостей
    public function __construct(string $id, $module, DummyService $dummyService, JsonDataParser $dataParser)
    {
        $this->dummyService = $dummyService;
        $this->dataParser   = $dataParser;
        parent::__construct($id, $module);
    }

    public function actionIndex()
    {
        // получаем товары от https://dummyjson.com в json
        $dummyProductsJson = $this->dummyService->getProducts();
        // преобразуем в массив
        $dummyProductsArray = $this->dataParser->parse($dummyProductsJson);
        // обновляем данные в бд
        $result = $this->dummyService->updateProducts($dummyProductsArray);
        
        echo $result;
    }

}