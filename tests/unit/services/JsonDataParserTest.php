<?php

namespace tests\unit\services;

use PHPUnit\Framework\TestCase;
use app\services\JsonDataParser;

class JsonDataParserTest extends TestCase
{
    public function testParse()
    {
        $parser = new JsonDataParser();
        $json = '{"key": "value"}';
        $result = $parser->parse($json);
        
        $this->assertIsArray($result);
        $this->assertEquals(['key' => 'value'], $result);
    }

    public function testParseInvalidJson()
    {
        $parser = new JsonDataParser();
        $json = '{"key": "value"'; // Неправильный JSON
        $result = $parser->parse($json);
        
        $this->assertEquals(null, $result);
    }
}