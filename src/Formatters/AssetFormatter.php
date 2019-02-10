<?php

namespace Incraigulous\AdminZone\Formatters;


use Incraigulous\AdminZone\Contracts\FormatterInterface;
use Incraigulous\AdminZone\Models\Asset;

/**
 * Class DateFormatter
 */
class AssetFormatter implements FormatterInterface
{
    protected $name;

    /**
     * AssetFormatter constructor.
     *
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @param $entry
     *
     * @return string
     * @throws \Throwable
     */
    public function format($entry)
    {
        if ($entry instanceof Asset) {
            $asset = $entry;
        } else {
            $name = $this->name;
            $asset = $entry->$name;
        }
        return view('adminzone::assets.show', ['asset' => $asset])->render();
    }
}
