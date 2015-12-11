<?php

namespace bupy7\drp\traits;

/**
 * Main trait with methods for corrent work of widget.
 * @author Belosludcev Vasilij <https://github.com/bupy7>
 * @since 1.0.0
 */
trait WidgetTrait
{
    /**
     * Converting language of localisation to corrent format for Moment.js library.
     * @param string $language Language for converting.
     * @param string $default Default language for converting whether `null` value of `$language` param. 
     * @return string
     */
    protected function convertLanguage($language, $default = null)
    {
        $language = $language ?: $default;
        $except = [
            'ar',
            'de',
            'en',
            'hy',
            'ms',
            'pt',
            'sr',
            'tl',
            'tzm',
            'zh',
        ];
        $isValid = true;
        for ($i = 0; $i != count($except); $i++) {
            $isValid = $isValid && stripos($language, $except[$i]) !== 0;
        }
        if ($isValid) {
            $language = explode('-', $language)[0];
        }
        return $language;
    }
    
    /**
     * Converting the date format from PHP DateTime to Moment.js DateTime format.
     * @param string $format the PHP date format string
     * @return string
     * @see http://php.net/manual/en/function.date.php
     * @see http://momentjs.com/docs/#/parsing/string-format/
     */
    protected function convertDateFormat($format)
    {
        return strtr($format, [
            // meridian lowercase remains same (not uses)
            // 'a' => 'a',
            // meridian uppercase remains same (not uses)
            // 'A' => 'A',
            // second (with leading zeros)
            's' => 'ss',
            // minute (with leading zeros)
            'i' => 'mm',
            // hour in 12-hour format (no leading zeros)
            'g' => 'h',
            // hour in 12-hour format (with leading zeros)
            'h' => 'hh',
            // hour in 24-hour format (no leading zeros)
            'G' => 'H',
            // hour in 24-hour format (with leading zeros)
            'H' => 'HH',
            //  day of the week locale
            'w' => 'e',
            //  day of the week ISO
            'W' => 'E',
            // day of month (no leading zero)
            'j' => 'D',
            // day of month (two digit)
            'd' => 'DD',
            // day name short
            'D' => 'DDD',
            // day name long
            'l' => 'DDDD',
            // month of year (no leading zero)
            'n' => 'M',
            // month of year (two digit)
            'm' => 'MM',
            // month name short
            'M' => 'MMM',
            // month name long
            'F' => 'MMMM',
            // year (two digit)
            'y' => 'YY',
            // year (four digit)
            'Y' => 'YYYY',
            // unix timestamp
            'U' => 'X',
        ]);
    }
}

