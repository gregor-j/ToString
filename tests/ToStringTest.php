<?php

namespace Tests\GregorJ\ToString;

use GregorJ\ToString\ToString;
use OutOfBoundsException;
use PHPUnit\Framework\TestCase;

/**
 * Class ToStringTest
 */
final class ToStringTest extends TestCase
{
    /**
     * @return array<mixed>
     */
    public static function provideFromByte(): array
    {
        return [
            [0, '\\x00'],
            [1, '\\x01'],
            [2, '\\x02'],
            [3, '\\x03'],
            [4, '\\x04'],
            [5, '\\x05'],
            [6, '\\x06'],
            [7, '\\a'],
            [8, '\\x08'],
            [9, '\\t'],
            [10, '\\n'],
            [11, '\\x0B'],
            [12, '\\f'],
            [13, '\\r'],
            [14, '\\x0E'],
            [15, '\\x0F'],
            [16, '\\x10'],
            [17, '\\x11'],
            [18, '\\x12'],
            [19, '\\x13'],
            [20, '\\x14'],
            [21, '\\x15'],
            [22, '\\x16'],
            [23, '\\x17'],
            [24, '\\x18'],
            [25, '\\x19'],
            [26, '\\x1A'],
            [27, '\\e'],
            [28, '\\x1C'],
            [29, '\\x1D'],
            [30, '\\x1E'],
            [31, '\\x1F'],
            [32, ' '],
            [33, '!'],
            [34, '"'],
            [35, '#'],
            [36, '$'],
            [37, '%'],
            [38, '&'],
            [39, "'"],
            [40, '('],
            [41, ')'],
            [42, '*'],
            [43, '+'],
            [44, ','],
            [45, '-'],
            [46, '.'],
            [47, '/'],
            [48, '0'],
            [49, '1'],
            [50, '2'],
            [51, '3'],
            [52, '4'],
            [53, '5'],
            [54, '6'],
            [55, '7'],
            [56, '8'],
            [57, '9'],
            [58, ':'],
            [59, ';'],
            [60, '<'],
            [61, '='],
            [62, '>'],
            [63, '?'],
            [64, '@'],
            [65, 'A'],
            [66, 'B'],
            [67, 'C'],
            [68, 'D'],
            [69, 'E'],
            [70, 'F'],
            [71, 'G'],
            [72, 'H'],
            [73, 'I'],
            [74, 'J'],
            [75, 'K'],
            [76, 'L'],
            [77, 'M'],
            [78, 'N'],
            [79, 'O'],
            [80, 'P'],
            [81, 'Q'],
            [82, 'R'],
            [83, 'S'],
            [84, 'T'],
            [85, 'U'],
            [86, 'V'],
            [87, 'W'],
            [88, 'X'],
            [89, 'Y'],
            [90, 'Z'],
            [91, '['],
            [92, '\\'],
            [93, ']'],
            [94, '^'],
            [95, '_'],
            [96, '`'],
            [97, 'a'],
            [98, 'b'],
            [99, 'c'],
            [100, 'd'],
            [101, 'e'],
            [102, 'f'],
            [103, 'g'],
            [104, 'h'],
            [105, 'i'],
            [106, 'j'],
            [107, 'k'],
            [108, 'l'],
            [109, 'm'],
            [110, 'n'],
            [111, 'o'],
            [112, 'p'],
            [113, 'q'],
            [114, 'r'],
            [115, 's'],
            [116, 't'],
            [117, 'u'],
            [118, 'v'],
            [119, 'w'],
            [120, 'x'],
            [121, 'y'],
            [122, 'z'],
            [123, '{'],
            [124, '|'],
            [125, '}'],
            [126, '~'],
            [127, '\\x7F'],
            [128, '\\x80'],
            [129, '\\x81'],
            [130, '\\x82'],
            [131, '\\x83'],
            [132, '\\x84'],
            [133, '\\x85'],
            [134, '\\x86'],
            [135, '\\x87'],
            [136, '\\x88'],
            [137, '\\x89'],
            [138, '\\x8A'],
            [139, '\\x8B'],
            [140, '\\x8C'],
            [141, '\\x8D'],
            [142, '\\x8E'],
            [143, '\\x8F'],
            [144, '\\x90'],
            [145, '\\x91'],
            [146, '\\x92'],
            [147, '\\x93'],
            [148, '\\x94'],
            [149, '\\x95'],
            [150, '\\x96'],
            [151, '\\x97'],
            [152, '\\x98'],
            [153, '\\x99'],
            [154, '\\x9A'],
            [155, '\\x9B'],
            [156, '\\x9C'],
            [157, '\\x9D'],
            [158, '\\x9E'],
            [159, '\\x9F'],
            [160, '\\xA0'],
            [161, '\\xA1'],
            [162, '\\xA2'],
            [163, '\\xA3'],
            [164, '\\xA4'],
            [165, '\\xA5'],
            [166, '\\xA6'],
            [167, '\\xA7'],
            [168, '\\xA8'],
            [169, '\\xA9'],
            [170, '\\xAA'],
            [171, '\\xAB'],
            [172, '\\xAC'],
            [173, '\\xAD'],
            [174, '\\xAE'],
            [175, '\\xAF'],
            [176, '\\xB0'],
            [177, '\\xB1'],
            [178, '\\xB2'],
            [179, '\\xB3'],
            [180, '\\xB4'],
            [181, '\\xB5'],
            [182, '\\xB6'],
            [183, '\\xB7'],
            [184, '\\xB8'],
            [185, '\\xB9'],
            [186, '\\xBA'],
            [187, '\\xBB'],
            [188, '\\xBC'],
            [189, '\\xBD'],
            [190, '\\xBE'],
            [191, '\\xBF'],
            [192, '\\xC0'],
            [193, '\\xC1'],
            [194, '\\xC2'],
            [195, '\\xC3'],
            [196, '\\xC4'],
            [197, '\\xC5'],
            [198, '\\xC6'],
            [199, '\\xC7'],
            [200, '\\xC8'],
            [201, '\\xC9'],
            [202, '\\xCA'],
            [203, '\\xCB'],
            [204, '\\xCC'],
            [205, '\\xCD'],
            [206, '\\xCE'],
            [207, '\\xCF'],
            [208, '\\xD0'],
            [209, '\\xD1'],
            [210, '\\xD2'],
            [211, '\\xD3'],
            [212, '\\xD4'],
            [213, '\\xD5'],
            [214, '\\xD6'],
            [215, '\\xD7'],
            [216, '\\xD8'],
            [217, '\\xD9'],
            [218, '\\xDA'],
            [219, '\\xDB'],
            [220, '\\xDC'],
            [221, '\\xDD'],
            [222, '\\xDE'],
            [223, '\\xDF'],
            [224, '\\xE0'],
            [225, '\\xE1'],
            [226, '\\xE2'],
            [227, '\\xE3'],
            [228, '\\xE4'],
            [229, '\\xE5'],
            [230, '\\xE6'],
            [231, '\\xE7'],
            [232, '\\xE8'],
            [233, '\\xE9'],
            [234, '\\xEA'],
            [235, '\\xEB'],
            [236, '\\xEC'],
            [237, '\\xED'],
            [238, '\\xEE'],
            [239, '\\xEF'],
            [240, '\\xF0'],
            [241, '\\xF1'],
            [242, '\\xF2'],
            [243, '\\xF3'],
            [244, '\\xF4'],
            [245, '\\xF5'],
            [246, '\\xF6'],
            [247, '\\xF7'],
            [248, '\\xF8'],
            [249, '\\xF9'],
            [250, '\\xFA'],
            [251, '\\xFB'],
            [252, '\\xFC'],
            [253, '\\xFD'],
            [254, '\\xFE'],
            [255, '\\xFF'],
        ];
    }

    /**
     * @param int $byte
     * @param string $expected
     * @dataProvider provideFromByte
     */
    public function testFromByte(int $byte, string $expected): void
    {
        $actual = ToString::fromByte($byte);
        static::assertSame($expected, $actual);
    }

    /**
     * @return void
     */
    public function testFromByteException(): void
    {
        $this->expectException(OutOfBoundsException::class);
        ToString::fromByte(-1);
    }

    /**
     * @return array<mixed>
     */
    public static function provideFromBoolean(): array
    {
        return [
            [true, 'true'],
            [false, 'false']
        ];
    }

    /**
     * @param bool $bool
     * @param string $expected
     * @dataProvider provideFromBoolean
     */
    public function testFromBoolean(bool $bool, string $expected): void
    {
        $actual = ToString::fromBoolean($bool);
        static::assertSame($expected, $actual);
    }

    /**
     * @return array<mixed>
     */
    public static function provideFromString(): array
    {
        return [
            ['hello world!', 'hello world!'],
            ['hello' . chr(10) . 'world!', 'hello\\nworld!']
        ];
    }

    /**
     * @param string $string
     * @param string $expected
     * @dataProvider provideFromString
     */
    public function testFromString(string $string, string $expected): void
    {
        $actual = ToString::fromString($string);
        static::assertSame($expected, $actual);
    }

    /**
     * @return array<mixed>
     */
    public static function provideFromAny(): array
    {
        return [
            ['hello world!', 'hello world!'],
            ['hello' . chr(10) . 'world!', 'hello\\nworld!'],
            [71746, '71746'],
            [2.7, '2.7'],
            [null, 'NULL'],
            [true, 'true'],
            [false, 'false'],
            [[], '[]'],
            [[true], '[0: true]'],
            [new \stdClass(), 'stdClass'],
        ];
    }

    /**
     * @param mixed $mixed
     * @param string $expected
     * @dataProvider provideFromAny
     */
    public function testFromAny($mixed, string $expected): void
    {
        $actual = ToString::fromAny($mixed);
        static::assertSame($expected, $actual);
    }

    /**
     * @return array<mixed>
     */
    public static function provideFromArray(): array
    {
        return [
            // empty array
            [[], '[]'],
            // sequential array with scalar values
            [[1, 2, 3], '[0: 1, 1: 2, 2: 3]'],
            // boolean values
            [[true, false], '[0: true, 1: false]'],
            // string values (non-printable chars are escaped)
            [['hello' . chr(10) . 'world'], '[0: "hello\\nworld"]'],
            // associative array
            [['key' => 'NULL', 'num' => 42], '[key: "NULL", num: 42]'],
            // string key with non-printable chars
            [[chr(9) . 'tab' => 'val'], '[\\ttab: "val"]'],
            // nested array
            [['a' => [1, 2], 'b' => 'x'], '[a: [0: 1, 1: 2], b: "x"]'],
            // deeply nested array
            [[[['deep']]], '[0: [0: [0: "deep"]]]'],
            // mixed types
            [['b' => true, 'n' => null, 'f' => 1.5], '[b: true, n: NULL, f: 1.5]'],
            [['' => 's', 'n' => null], '["": "s", n: NULL]'],
        ];
    }

    /**
     * @param array<mixed> $array
     * @param string $expected
     * @dataProvider provideFromArray
     */
    public function testFromArray(array $array, string $expected): void
    {
        $actual = ToString::fromArray($array);
        static::assertSame($expected, $actual);
    }
}
