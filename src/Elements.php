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
        return $this->reduce(function($elements, $item) {
            if ($item instanceof Field) {
                $elements->push($item);
            } else {
                $item->getFields()->each(function($f) use (&$elements) {
                    $elements->push($f);
                });
            };
            return $elements;
        }, new Elements([]));
    }

    public function getSections(): Elements
    {
        return $this->reduce(function($elements, $item) {
            if ($item instanceof Section) {
                $elements->push($item);
                $item->getSections()->each(function($f) use (&$elements) {
                    $elements->push($f);
                });
            };
            return $elements;
        }, new Elements([]));
    }
}
