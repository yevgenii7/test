<?php
namespace app\services;

use app\models\Product;

class DummyService
{
    const DUMMY_RESOURCE_BASE_URL = 'https://dummyjson.com';


    // получение товаров от dummy, в json
    public function getProducts(): string
    {
        $isPost       = false;
        $url          = self::DUMMY_RESOURCE_BASE_URL . '/products';
        $headers      = [];
        $requestData  = [];
        
        return $this->sendToDummy($url,$isPost,$headers,$requestData);//json_decode($jsonData, true);
    }
    
    // обновляем товары в своей бд
    public function updateProducts($dummyProductsArray) 
    {
        if(!isset($dummyProductsArray['products']) || count($dummyProductsArray['products']) == null){
            return 'Error: no products';
        }
        
        // кол-во пришедших товаров
        $dummyTovarsCount = count($dummyProductsArray['products']);
        //для подсчёта произведённых записей
        $i = 0;
        
        // очищаем таблицу product
        Product::deleteAll();
        
        // наполняем таблицу новыми данными
        foreach($dummyProductsArray['products'] as $dummyProduct)
        {
            $product              = new Product();
            $product->name        = $dummyProduct['title'];
            $product->price       = $dummyProduct['price'];
            $product->description = $dummyProduct['description'];
            
            if($product->save()){
                $i++;
            }
        }
        
        if($dummyTovarsCount == $i){
            return 'OK: Dummy products count equal to records in the database. (' . $dummyTovarsCount . '/' . $i . ')';
        } else {
            return 'Warning: Dummy products count not equal to records in the database. (' . $dummyTovarsCount . '/' . $i . ')';
        }
    }
    
    //запрос к удалённому ресурсу
    private function sendToDummy($url,$isPost,$headers,$requestData):string
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_VERBOSE, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $requestData);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, $isPost);
        
        $result = curl_exec($curl);
        curl_close($curl);

        return $result;
    }
}