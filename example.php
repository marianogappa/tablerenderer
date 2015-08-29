<?php

require_once(__DIR__ . '/TableRenderer.php');

$sqlResult = [
            [
                "id" => "1",
                "name" => "John",
                "age" => "15"
            ],
            [
                "id" => "2",
                "name" => "George",
                "age" => "20"
            ],
            [
                "id" => "3",
                "name" => "Bob",
                "age" => "30"
            ]
        ];

echo TableRenderer::forArray($sqlResult);
