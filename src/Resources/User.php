<?php

namespace Incraigulous\AdminZone\Resources;


use Incraigulous\AdminZone\Forms\UserEditForm;

/**
 * Class ExampleResource
 */
class User extends Resource
{

    public function columns(): array
    {
        return [
            'ID' => 'id',
            'Name' => 'name',
            'email' => function ($user) {
                return "<a href='mailto:$user->email' title='Email $user->name'>$user->email</a>";
            },
            'Created' => function($model) {
                return $model->created_at->format('M d Y');
            },
        ];
    }

    public function form() {
        return new UserEditForm();
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
