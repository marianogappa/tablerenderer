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

### Changing the header row

By default, the script uses the array's keys for the header row. You can pass an array with the headers (it's your responsibility to match the number of columns; the script does not validate this).

```
echo TableRenderer::forArray($sqlResult, ["Id", "First Name", "Age"]);
```

### Outputs

```
$ php example.php
+-----------------------+
| Id | First Name | Age |
+-----------------------+
| 1  | John       | 15  |
| 2  | George     | 20  |
| 3  | Bob        | 30  |
+-----------------------+
```

### Different table rendering

If you want to render the table differently, you can define the edge, horizontal and vertical characters. The script doesn't make sure they are 1-character long, or take it into account when rendering the table; that is your responsibility.

```
echo TableRenderer::forArray($sqlResult, ["Id", "First Name", "Age"], "#", "*", "I");
```

#### Outputs

```
$ php example.php
#***********************#
I Id I First Name I Age I
#***********************#
I 1  I John       I 15  I
I 2  I George     I 20  I
I 3  I Bob        I 30  I
#***********************#
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
