# tablerenderer
A minimalist script to render an associative array as a MySQL result table

# Usage

### Basic case
```
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
```

#### Outputs
```
$ php example.php
+-------------------+
| id | name   | age |
+-------------------+
| 1  | John   | 15  |
| 2  | George | 20  |
| 3  | Bob    | 30  |
+-------------------+
```


# Testing

```
phpunit test
```
(requires PHPUnit - https://phpunit.de/)

### Currently passing

```
$ phpunit --testdox test
PHPUnit 4.5.0 by Sebastian Bergmann and contributors.

TableRenderer
 [x] Renders properly
 [x] Renders properly with custom header
 [x] Renders properly if custom header is longer than values
 [x] Renders properly if custom table drawing options are set
```
