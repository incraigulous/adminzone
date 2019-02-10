<?php

namespace Incraigulous\AdminZone\Resources;


use Incraigulous\AdminZone\Formatters\AssetFormatter;
use Incraigulous\AdminZone\Formatters\CarbonFormatter;
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
            'Preview' => new AssetFormatter('file'),
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
            'Preview' => new AssetFormatter('file'),
            'Updated at' => new CarbonFormatter('updated_at'),
            'Created at' => new CarbonFormatter('created_at')
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
