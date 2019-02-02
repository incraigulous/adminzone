<?php

namespace Incraigulous\AdminZone\Forms;


use Incraigulous\AdminZone\Contracts\SectionInterface;
use Incraigulous\AdminZone\Fields\TextField;
use Incraigulous\AdminZone\Fields\UploadField;

/**
 * Class AssetForm
 */
class AssetEditForm extends AssetCreateForm
{
    public function rules(): array
    {
        return [
            'title' => 'required',
            'filename' => 'required',
            'file' => 'file'
        ];
    }
}
