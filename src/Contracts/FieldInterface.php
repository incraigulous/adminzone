<?php

namespace Incraigulous\AdminZone\Contracts;

use Illuminate\Http\Request;
use Incraigulous\AdminZone\Fields\Field;
use Incraigulous\AdminZone\Fields\Types\FieldTypeInterface;

interface FieldInterface extends ElementInterface
{
    public function __construct(string $label, string $name = null);
    public static function create(string $label, string $name = null): Field;
    public function default($value): FieldInterface;
    public function getDefault();
    public function handleSubmission(Request $request, array &$payload);
}
