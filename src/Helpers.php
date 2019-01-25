<?php
namespace Incraigulous\AdminZone;

/**
 * Class Helpers
 */
class Helpers
{
    /**
     * Converts an array into HTML attributes
     *
     * @param $array
     *
     * @return string
     */
    public function toHtmlAttributes(array $array): string
    {
        $attributes = '';
        foreach ($array as $attrName => $attrValue) {
            $attributes .= $attrName . '="' . $attrValue . '" ';
        }
        return $attributes;
    }

    public function classes(...$classes): string
    {
        return implode(' ', array_filter($classes, function ($class) {
                return ($class);
            })
        );
    }

    public function attributes(array $array): string
    {
        return $this->toHtmlAttributes($array);
    }

    public function textColorFromTheme(string $themeColor): string
    {
        switch ($themeColor) {
            case 'light':
            case 'white':
            case '';
            case 'transparent';
                $textColor = 'dark';
                break;
            default:
                $textColor = 'white';
        }
        return $textColor;
    }
}
