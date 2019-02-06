<?php

namespace Incraigulous\AdminZone\Fields;
use Illuminate\Http\Request;
use Incraigulous\AdminZone\Contracts\FieldInterface;
use Incraigulous\AdminZone\Element;
use Incraigulous\AdminZone\Exceptions\FieldTypeException;
use Incraigulous\AdminZone\Fields\Types\FieldType;
use Incraigulous\AdminZone\Fields\Types\FieldTypeInterface;
use Incraigulous\AdminZone\Traits\ConvertsArrayToJson;
use Incraigulous\AdminZone\Traits\HasLabel;
use Incraigulous\AdminZone\Traits\HasName;
use Incraigulous\AdminZone\Traits\HasType;

/**
 * Class Field
 */
abstract class Field extends Element implements FieldInterface
{
    public $name;
    public $type = 'field';
    public $default;
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
    public function __construct(string $label, string $name = null)
    {
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

    public static function create(string $label, string $name = null): Field
    {
        return new static($label, $name);
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

    protected function asArray(): array
    {
        return [
            'name' => $this->getName(),
            'default' => $this->getDefault()
        ];
    }

    public function getName(): string
    {
        return $this->name;
    }

    protected function view(): string
    {
        return 'adminzone::elements.fields.' . $this->getSlug();
    }

    public function getAttributes(): array
    {
        return [
            'default' => $this->default
        ];
    }

    public function handleSubmission(Request $request, array &$payload)
    {
        $name = $this->name;
        if ($request->has($name)) {
            $payload[$name] = $request->$name;
        }
    }
}
