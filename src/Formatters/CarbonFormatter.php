<?php

namespace Incraigulous\AdminZone\Formatters;


use Incraigulous\AdminZone\Contracts\FormatterInterface;

/**
 * Class DateFormatter
 */
class CarbonFormatter implements FormatterInterface
{
    protected $name;
    protected $format;

    public function __construct($name, $format = 'M d Y')
    {
        $this->name = $name;
        $this->format = $format;
    }

    public function format($entry)
    {
        $name = $this->name;
        $value = $entry->$name;
        if (!$value) {
            return $value;
        }
        return $value->format($this->format);
    }
}
