<?php

namespace Incraigulous\AdminZone;


use Incraigulous\AdminZone\Contracts\ElementInterface;

/**
 * Class Element
 */
abstract class Element extends Item implements ElementInterface
{
    public function setLabel(string $label): ElementInterface
    {
        $this->label = $label;
        return $this;
    }

    public function label(): string
    {
        if (!$this->label) {
            $this->label = parent::label();
        }
        return $this->label;
    }

    public function getAttributes(): array
    {
        return [];
    }
}
