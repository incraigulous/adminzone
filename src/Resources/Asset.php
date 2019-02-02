<?php

namespace Incraigulous\AdminZone\Resources;


use Incraigulous\AdminZone\Forms\AssetCreateForm;
use Incraigulous\AdminZone\Forms\AssetEditForm;
use Incraigulous\AdminZone\Forms\UserEditForm;

/**
 * Class ExampleResource
 */
class Asset extends Resource
{

    public function columns(): array
    {
        return [
            'ID' => 'id',
            'Title' => 'title',
            'Filename' => 'filename',
            'Preview' => function($model) {
                $url = asset($model->file);
                return "<img src='{$url}' class='img-thumbnail'>";
            },
        ];
    }

    public function fields(): array
    {
        return [
            'ID' => 'id',
            'Title' => 'title',
            'File' => function ($model) {
                $url = asset($model->file);
                return "<a href='$url' title='Open Asset'>$model->file</a>";
            },
            'Preview' => function ($model) {
                $url = asset($model->file);
                return "<img src='{$url}' class='img-thumbnail'>";
            },
            'Updated at' => function($model) {
                return $model->created_at->format('M d Y');
            },
            'Created at' => function($model) {
                return $model->created_at->format('M d Y');
            }
        ];
    }

    public function editForm() {
        return new AssetEditForm();
    }

    public function createForm() {
        return new AssetCreateForm();
    }

    public function model() {
        return new \Incraigulous\AdminZone\Models\Asset();
    }

    public function filters(): array
    {
        return [

        ];
    }
}
