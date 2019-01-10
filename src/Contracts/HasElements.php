<?php


/**
 * Trait HasElements
 */

namespace Incraigulous\AdminZone\Contracts;


use Incraigulous\AdminZone\Elements;

interface HasElements
{
    public function field(FieldInterface $type): HasElements;
    public function getFields(): Elements;
    public function section(SectionInterface $section): HasElements;
    public function getSections(): Elements;
    public function addElement(ElementInterface $item): HasElements;
    public function getElements(): Elements;
}
