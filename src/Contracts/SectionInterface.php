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
    public static function create(string $label = null): SectionInterface;
    public function field(FieldInterface $type): SectionInterface;
    public function getFields(): Elements;
    public function section(SectionInterface $section): SectionInterface;
    public function getSections(): Elements;
    public function addElement(ElementInterface $item): SectionInterface;
    public function getElements(): Elements;
}
