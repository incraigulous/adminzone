<?php

namespace Incraigulous\AdminZone\Forms;


use Incraigulous\AdminZone\Contracts\SectionInterface;
use Incraigulous\AdminZone\Contracts\SubmissionInterface;
use Incraigulous\AdminZone\Fields\TextField;
use Incraigulous\AdminZone\Fields\UploadField;
use Incraigulous\AdminZone\Submissions\AssetSubmission;

/**
 * Class AssetForm
 */
class AssetCreateForm extends Form
{
    public function rules(): array
    {
        return [
            'title' => 'required',
            'file' => 'required|file'
        ];
    }

    protected function main(SectionInterface $main): SectionInterface
    {
        $main->field(TextField::create('Title'))
            ->field(TextField::create("Filename"))
            ->field(UploadField::create('File'));

        return $main;
    }

    protected function submission(): SubmissionInterface
    {
        return new AssetSubmission();
    }
}
