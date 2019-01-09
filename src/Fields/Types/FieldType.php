<?php

namespace Incraigulous\AdminZone\Fields\Types;


use Incraigulous\AdminZone\Item;
use Incraigulous\AdminZone\Resolvers\ResolverInterface;

/**
 * Class FieldType
 */
abstract class FieldType extends Item implements FieldTypeInterface
{
    /**
     * @var $resolver ResolverInterface
     */
    public function type(): string
    {
        return 'field-type';
    }

    public function beforeSave($value)
    {
        return $value;
    }

    public function toJson($options = 0): string
    {
        return json_encode($this->toArray(), $options);
    }
}
