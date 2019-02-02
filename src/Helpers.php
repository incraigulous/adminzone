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
            if ($attrValue !== null) {
                $attributes .= $attrName . '="' . $attrValue . '" ';
            }
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

    public function callbackOr(callable $fallback, $callback, ...$params)
    {
        if (!is_callable($callback)) {
            return $fallback($callback, ...$params);
        }

        return $callback(...$params);
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

    public function isSpoofedMethod($method): bool
    {
        if (!$method) {
            $method = '';
        }
        return in_array(strtoupper($method), [
            'PUT', 'PATCH', "DELETE"
        ]);
    }

    public function formMethod($method): string
    {
        $method = strtoupper($method);
        if (!$method || $this->isSpoofedMethod($method)) {
            return 'POST';
        }
        return $method;
    }
}
