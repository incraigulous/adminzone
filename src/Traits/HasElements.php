<?php

namespace Incraigulous\AdminZone\Traits;

use Incraigulous\AdminZone\Contracts\ElementInterface;
use Incraigulous\AdminZone\Contracts\FieldInterface;
use Incraigulous\AdminZone\Contracts\SectionInterface;
use Incraigulous\AdminZone\Elements;

trait HasElements
{
    public $elements;

    public function field(FieldInterface $field): \Incraigulous\AdminZone\Contracts\HasElements
    {
        return $this->addElement($field);
    }

    public function getFields(): Elements
    {
        return $this->getElements()->getFields();
    }

    public function section(SectionInterface $section): \Incraigulous\AdminZone\Contracts\HasElements
    {
        return $this->addElement($section);
    }

    public function getSections(): Elements
    {
        return $this->getElements()->getSections();
    }

    public function addElement(ElementInterface $item): \Incraigulous\AdminZone\Contracts\HasElements
    {
        if (!$this->elements) {
            $this->elements = new Elements();
        }

        $this->elements->push($item);

        return $this;
    }

    public function getElements(): Elements
    {
        if (!$this->elements) {
            $this->elements = new Elements();
        }

        return $this->elements;
    }
}
