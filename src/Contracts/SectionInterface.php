<?php


/**
 * Trait Section
 */

namespace Incraigulous\AdminZone\Contracts;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Incraigulous\AdminZone\Contracts\HasFields;
use Incraigulous\AdminZone\Elements;

interface SectionInterface extends ItemInterface, ElementInterface
{
    public static function create(): SectionInterface;
    public function addField(FieldInterface $type): SectionInterface;
    public function field($type, string $name, string $label = null): SectionInterface;
    public function getFields(): Elements;
    public function section($sectionClassName, $label = null): SectionInterface;
    public function addSection(SectionInterface &$section): SectionInterface;
    public function getSections(): Elements;
    public function addElement(ElementInterface $item): SectionInterface;
    public function getElements(): Elements;
}
