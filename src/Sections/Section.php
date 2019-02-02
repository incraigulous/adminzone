<?php

namespace Incraigulous\AdminZone\Sections;

use Incraigulous\AdminZone\Contracts\SectionInterface;
use Incraigulous\AdminZone\Element;
use Incraigulous\AdminZone\Traits\HasElements;

/**
 * Class Section
 */
class Section extends Element implements SectionInterface
{
    use HasElements;

    public $label;
    public $items;

    public static function create(string $label = null): SectionInterface
    {
        $section = new static();
        if ($label) {
            $section->label($label);
        }
        return $section;
    }

    public function asArray(): array
    {
        return [
            'elements' => $this->getElements()->toArray()
        ];
    }

    public function type(): string
    {
        return 'section';
    }

    protected function view(): string
    {
        return 'adminzone::elements.sections.' . $this->getSlug();
    }

}
