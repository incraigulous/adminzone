<?php

namespace Incraigulous\AdminZone;


use Illuminate\Support\Collection;
use Incraigulous\AdminZone\Contracts\ElementInterface;
use Incraigulous\AdminZone\Fields\Field;
use Incraigulous\AdminZone\Sections\Section;

/**
 * Class SectionItems
 */
class Elements extends Collection
{
    public function getFields(): Elements
    {
        return $this->filter(function($item) {
            return ($item instanceof Field);
        });
    }

    public function getSections(): Elements
    {
        return $this->filter(function($item) {
            return $item instanceof Section;
        });
    }
}
