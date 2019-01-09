<?php


/**
 * Trait FieldType
 */

namespace Incraigulous\AdminZone\Fields\Types;

use Incraigulous\AdminZone\Contracts\ItemInterface;

interface FieldTypeInterface extends ItemInterface
{
    public function beforeSave($value);
}
