<?php

namespace Incraigulous\AdminZone\Resources;


use Incraigulous\AdminZone\Forms\ExampleForm;

/**
 * Class ExampleResource
 */
class ExampleResource extends Resource
{

    public function form() {
        return new ExampleForm();
    }


    public function filters(): array
    {
        return [

        ];
    }
}
