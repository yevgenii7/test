<?php
/**
 * @link https://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license https://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;
use app\services\DataParserInterface;
use app\services\JsonDataParser;
use app\services\DummyService;

class DummyResourceController extends Controller
{
    private $dummyService;
    private $dataParser;

    //этот вариант отдаёт ошибку, возможно из-за версии (нужна php >8.0)
//    public function __construct(string $id, DataParserInterface $dataParser, $module = null)
//    {
//        $this->dataParser = $dataParser;
//        parent::__construct($id, $module);
//    }
    
    // т.к. работал с сервером на php 7.4 - пришлось сделать такую реализацию
    public function __construct(string $id, $module = null)
    {
        $this->dummyService = new DummyService();
        $this->dataParser   = new JsonDataParser();
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