<?php

namespace Incraigulous\AdminZone\Resources;


use Incraigulous\AdminZone\Forms\UserForm;

/**
 * Class ExampleResource
 */
class User extends Resource
{

    public function form() {
        return new UserForm();
    }

    public function model() {
        return new \Incraigulous\AdminZone\Models\User();
    }

    public function filters(): array
    {
        return [

        ];
    }
}
