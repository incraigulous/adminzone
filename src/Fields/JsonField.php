<?php

namespace Incraigulous\AdminZone\Fields;

use Incraigulous\AdminZone\Contracts\SectionInterface;
use Incraigulous\AdminZone\Traits\HasElements;

/**
 * Class JsonField
 */
class JsonField extends Field implements SectionInterface
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
