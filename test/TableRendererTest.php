<?php

require_once(__DIR__ . '/../TableRenderer.php');

class TableRendererTest extends PHPUnit_Framework_TestCase {

    public function testRendersProperly() {
        $test = [
            [
                "Field 1" => "Value 1",
                "Field 2" => "Value 2",
                "Field 3" => "Value 3"
            ],
            [
                "Field 1" => "Value 4",
                "Field 2" => "Value 5 is slightly longer",
                "Field 3" => "Value 6"
            ],
            [
                "Field 1" => "Value 7",
                "Field 2" => "Value 8",
                "Field 3" => "Value 9 is actually a lot longer than others"
            ]
        ];

        $expected = <<<'NOWDOC'
+-------------------------------------------------------------------------------------+
| Field 1 | Field 2                    | Field 3                                      |
+-------------------------------------------------------------------------------------+
| Value 1 | Value 2                    | Value 3                                      |
| Value 4 | Value 5 is slightly longer | Value 6                                      |
| Value 7 | Value 8                    | Value 9 is actually a lot longer than others |
+-------------------------------------------------------------------------------------+

NOWDOC;

        $this->assertEquals($expected, TableRenderer::forArray($test));
    }

    public function testRendersProperlyWithCustomHeader() {
        $test = [
            [
                "field1" => "Value 1",
                "field2" => "Value 2",
                "field3" => "Value 3"
            ],
            [
                "field1" => "Value 4",
                "field2" => "Value 5 is slightly longer",
                "field3" => "Value 6"
            ],
            [
                "field1" => "Value 7",
                "field2" => "Value 8",
                "field3" => "Value 9 is actually a lot longer than others"
            ]
        ];

        $expected = <<<'NOWDOC'
+-------------------------------------------------------------------------------------+
| Name    | Email Address              | Post Address                                 |
+-------------------------------------------------------------------------------------+
| Value 1 | Value 2                    | Value 3                                      |
| Value 4 | Value 5 is slightly longer | Value 6                                      |
| Value 7 | Value 8                    | Value 9 is actually a lot longer than others |
+-------------------------------------------------------------------------------------+

NOWDOC;

        $this->assertEquals($expected, TableRenderer::forArray($test, ["Name", "Email Address", "Post Address"]));
    }

    public function testRendersProperlyIfCustomHeaderIsLongerThanValues() {
        $test = [
            [
                "field1" => "Value 1",
                "field2" => "Value 2",
                "field3" => "Value 3"
            ],
            [
                "field1" => "Value 4",
                "field2" => "Value 5 is slightly longer",
                "field3" => "Value 6"
            ],
            [
                "field1" => "Value 7",
                "field2" => "Value 8",
                "field3" => "Value 9 is actually a lot longer than others"
            ]
        ];

        $expected = <<<'NOWDOC'
+----------------------------------------------------------------------------------------+
| First Name | Email Address              | Post Address                                 |
+----------------------------------------------------------------------------------------+
| Value 1    | Value 2                    | Value 3                                      |
| Value 4    | Value 5 is slightly longer | Value 6                                      |
| Value 7    | Value 8                    | Value 9 is actually a lot longer than others |
+----------------------------------------------------------------------------------------+

NOWDOC;

        $this->assertEquals($expected, TableRenderer::forArray($test, ["First Name", "Email Address", "Post Address"]));
    }
}
