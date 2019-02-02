<?php

namespace Incraigulous\AdminZone\Forms;


use Incraigulous\AdminZone\Contracts\SectionInterface;
use Incraigulous\AdminZone\Contracts\SubmissionInterface;
use Incraigulous\AdminZone\Fields\EmailField;
use Incraigulous\AdminZone\Fields\PasswordField;
use Incraigulous\AdminZone\Fields\TextField;
use Incraigulous\AdminZone\Sections\FieldSet;
use Incraigulous\AdminZone\Sections\Section;
use Incraigulous\AdminZone\Submissions\UserSubmission;

/**
 * Class ExampleForm
 */
class UserEditForm extends UserCreateForm
{
    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required',
            'password' => 'confirmed'
        ];
    }
}
