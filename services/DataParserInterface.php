<?php
namespace app\services;

interface DataParserInterface
{
    public function parse(string $jsonData): array;
}