<?php

namespace Incraigulous\AdminZone\Fields;

use Incraigulous\AdminZone\Traits\HasElements;
use Incraigulous\AdminZone\Contracts\HasElements as HasElementsInterface;
/**
 * Class JsonField
 */
class JsonField extends Field implements HasElementsInterface
{
    use HasElements;

    protected function asArray(): array
    {
        $array = parent::asArray();

        return array_merge([
            'elements' => $this->getElements()
        ], $array);
    }
}
