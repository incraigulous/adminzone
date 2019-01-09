<?php

namespace Incraigulous\AdminZone\Sections;

use Incraigulous\AdminZone\Contracts\ElementInterface;
use Incraigulous\AdminZone\Contracts\SectionInterface;
use Incraigulous\AdminZone\Contracts\FieldInterface;
use Incraigulous\AdminZone\Element;
use Incraigulous\AdminZone\Fields\Field;
use Incraigulous\AdminZone\Fields\Fields;
use Incraigulous\AdminZone\Elements;
use Incraigulous\AdminZone\Traits\ConvertsArrayToJson;
use Incraigulous\AdminZone\Traits\HasComponent;
use Incraigulous\AdminZone\Traits\HasFields;
use Incraigulous\AdminZone\Traits\HasLabel;
use Incraigulous\AdminZone\Traits\HasSections;
use Incraigulous\AdminZone\Traits\HasType;

/**
 * Class Section
 */
class Section extends Element implements SectionInterface
{
    public $label;
    public $items;

    public static function create(): SectionInterface
    {
        return new static();
    }

    public function asArray(): array
    {
        return [
            'elements' => $this->getElements()->toArray()
        ];
    }

    public function addField(FieldInterface $field): SectionInterface
    {
        return $this->addElement($field);
    }

    public function field($type, string $label, string $name = null): SectionInterface
    {
        $this->addField(
            Field::create($type, $label, $name)
        );
        return $this;
    }

    public function getFields(): Elements
    {
        return $this->getElements()->getFields();
    }

    public function section($sectionClassName, $label = null): SectionInterface
    {
        $section = new $sectionClassName;
        $section->label($label);
        $this->addSection($section);
        return $section;
    }

    public function addSection(SectionInterface &$section): SectionInterface
    {
        return $this->addElement($section);
    }

    public function getSections(): Elements
    {
        return $this->getElements()->getSections();
    }

    public function addElement(ElementInterface $item): SectionInterface
    {
        if (!$this->items) {
            $this->items = new Elements();
        }

        $this->items->push($item);

        return $this;
    }

    public function getElements(): Elements
    {
        return $this->items;
    }

    public function type(): string
    {
        return 'section';
    }
}
