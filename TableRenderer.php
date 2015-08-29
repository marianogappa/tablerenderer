<?php

class TableRenderer {
    public static function forArray(array $content, array $header = [], $edge = "+", $hLine = "-", $vLine = "|") {
        if (count($content) === 0)
            return "";

        $headerRow = array_combine(array_keys($content[0]), $header ?: array_keys($content[0]));
        $lengths = self::calculateColumnLengths($content, $headerRow);

        return implode(self::printLine(self::getFullLength($lengths), $edge, $hLine), [
            "",
            self::printRow($headerRow, $lengths, $vLine),
            implode("", array_map(function($item) use ($lengths, $vLine) {
                return self::printRow($item, $lengths, $vLine);
            }, $content)),
            ""
        ]);
    }

    private static function calculateColumnLengths(array $content, array $headerRow) {
        array_push($content, $headerRow);
        return array_combine(array_keys($content[0]), array_map(function($item) use ($content) {
            return self::calculateColumnLength($content, $item);
        }, array_keys($content[0])));
    }

    private static function calculateColumnLength(array $content, $key) {
        return max(array_map(function($item) use ($key) { return strlen($item[$key]); }, $content));
    }

    private static function getFullLength(array $lengths) {
        return array_sum($lengths) + 3 * count($lengths) + 1;
    }

    private static function printRow(array $row, array $lengths, $vLine) {
        return "$vLine " . implode(" $vLine ", array_map(function ($k, $v) use ($lengths) {
            return str_pad($v, $lengths[$k]);
        }, array_keys($row), $row)) . " $vLine\n";
    }

    private static function printLine($length, $edge, $hLine) {
        return $edge . str_pad("", $length - 2, $hLine) . $edge . "\n";
    }
}
