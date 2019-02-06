<?php

namespace Incraigulous\AdminZone\Forms;


use Incraigulous\AdminZone\Contracts\SectionInterface;
use Incraigulous\AdminZone\Contracts\SubmissionInterface;
use Incraigulous\AdminZone\Fields\BelongsToField;
use Incraigulous\AdminZone\Fields\EmailField;
use Incraigulous\AdminZone\Fields\PasswordField;
use Incraigulous\AdminZone\Fields\TextField;
use Incraigulous\AdminZone\Resources\Asset;
use Incraigulous\AdminZone\Sections\FieldSet;
use Incraigulous\AdminZone\Sections\Section;
use Incraigulous\AdminZone\Submissions\UserSubmission;

/**
 * Class ExampleForm
 */
class UserCreateForm extends Form
{

    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|unique:users,email,'. request()->route('id'),
            'password' => 'required|confirmed'
        ];
    }

    protected function main(SectionInterface $main): SectionInterface
    {
        $main->field(TextField::create('Name'))
            ->field(EmailField::create('Email'))
            ->field(PasswordField::create('password'))
            ->field(BelongsToField::create('Avatar')->relatedTo(Asset::class));

        return $main;
    }
}
