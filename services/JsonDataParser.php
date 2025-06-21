<?php

namespace app\services;

class JsonDataParser implements DataParserInterface
{
    public function parse(string $jsonData): array
    { 
        return json_decode($jsonData, true);
    }
}