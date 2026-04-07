<?php

declare(strict_types=1);

namespace GregorJ\ToString;

use OutOfBoundsException;

/**
 * Class ToString
 */
final class ToString
{
    /**
     * Convert a boolean value to a string representation.
     * @param bool $value
     * @return string
     */
    public static function fromBoolean(bool $value): string
    {
        if ($value === false) {
            return 'false';
        }
        return 'true';
    }

    /**
     * Convert the int representation of a byte to a string.
     * In case of non-printable characters (<32, 127) the hexadecimal
     * representation is returned.
     * @param int $byte
     * @return string
     */
    public static function fromByte(int $byte): string
    {
        if ($byte < 0 || $byte > 255) {
            throw new OutOfBoundsException('Byte must be between 0 and 255');
        }
        if ($byte > 31 && $byte < 127) {
            return chr($byte);
        }
        /**
         * see PHP escape sequences:
         * https://www.php.net/manual/regexp.reference.escape.php
         */
        switch ($byte) {
            case 7:
                // alarm, that is, the BEL character (hex 07)
                return '\\a';
            case 9:
                // tab (hex 09)
                return '\\t';
            case 10:
                // newline (hex 0A)
                return '\\n';
            case 12:
                // formfeed (hex 0C)
                return '\\f';
            case 13:
                // carriage return (hex 0D)
                return '\\r';
            case 27:
                //escape (hex 1B)
                return '\\e';
            default:
                return sprintf("\\x%'.02X", $byte);
        }
    }

    /**
     * Convert all characters of a string to printable characters. In case of
     * non-printable characters they are replaced by their hexadecimal
     * representation.
     * @param string $string
     * @return string
     */
    public static function fromString(string $string): string
    {
        /**
         * Convert string to its byte array and process each byte.
         */
        $bytes = unpack('C*', $string);
        $result = '';
        if (is_array($bytes)) {
            foreach ($bytes as $byte) {
                $result .= self::fromByte($byte);
            }
        }
        return $result;
    }

    /**
     * Convert any value to a readable string.
     * @param mixed $value
     * @return string
     */
    public static function fromAny(mixed $value): string
    {
        if (is_bool($value)) {
            return self::fromBoolean($value);
        }
        if (is_int($value) || is_float($value)) {
            return (string)$value;
        }
        if (is_string($value)) {
            return self::fromString($value);
        }
        return gettype($value);
    }
}
