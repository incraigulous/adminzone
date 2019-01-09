<?php

namespace Incraigulous\AdminZone\Fields;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Incraigulous\AdminZone\Contracts\FieldInterface;
use Incraigulous\AdminZone\Element;
use Incraigulous\AdminZone\Exceptions\FieldTypeException;
use Incraigulous\AdminZone\Fields\Types\FieldType;
use Incraigulous\AdminZone\Fields\Types\FieldTypeInterface;
use Incraigulous\AdminZone\Item;
use Incraigulous\AdminZone\Traits\ConvertsArrayToJson;
use Incraigulous\AdminZone\Traits\HasLabel;
use Incraigulous\AdminZone\Traits\HasName;
use Incraigulous\AdminZone\Traits\HasType;

/**
 * Class Field
 */
class Field extends Element implements FieldInterface
{
    public $name;
    public $type = 'field';
    public $fieldType = null;
    public $default;
    public $beforeSave;
    public $label;

    /**
     * Field constructor.
     *
     * @param      $type
     * @param      $name
     * @param null $label
     *
     * @throws FieldTypeException
     */
    public function __construct($fieldType, string $label, string $name = null)
    {
        if (is_string($fieldType)) {
            $fieldType = new $fieldType;
        }

        if (!$fieldType instanceof FieldTypeInterface) {
            throw new FieldTypeException("Type must be instance of " . FieldTypeInterface::class . '.');
        }

        $this->fieldType = $fieldType;
        $this->label = $label;
        $this->name = $name ? $name : snake_case($label);
    }

    public function type(): string
    {
        return 'field';
    }

    public function label(): string
    {
        return $this->label;
    }

    public static function create($type, string $label, string $name = null): Field
    {
        return new static($type, $label, $name);
    }

    public function default($value): FieldInterface
    {
        $this->default = $value;
        return $this;
    }

    public function getDefault()
    {
        return $this->default;
    }

    public function beforeSave(callable $callback): FieldInterface
    {
        $this->beforeSave = $callback;
        return $this;
    }

    public function getBeforeSave(): callable
    {
        return $this->beforeSave;
    }

    protected function asArray(): array
    {
        return [
            'fieldType' => $this->getFieldType()->toArray(),
            'name' => $this->getName(),
            'default' => $this->getDefault()
        ];
    }

    public function getFieldType(): FieldTypeInterface
    {
        return $this->fieldType;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
