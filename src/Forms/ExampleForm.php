<?php

namespace Incraigulous\AdminZone\Forms;


use Incraigulous\AdminZone\Contracts\SectionInterface;
use Incraigulous\AdminZone\Fields\TextField;
use Incraigulous\AdminZone\Sections\FieldSet;
use Incraigulous\AdminZone\Sections\Section;

/**
 * Class ExampleForm
 */
class ExampleForm extends Form
{

    public function rules(): array
    {
        return ['first_name' => 'required'];
    }

    protected function main(SectionInterface $main): SectionInterface
    {
        $main->field(TextField::create( 'First Name'))
             ->field(TextField::create( 'Last Name'));

        $location = FieldSet::create('Location')
            ->section(FieldSet::create('Address'))
            ->field(TextField::create('Address 1'))
            ->field(TextField::create('Address 2'));

        $main->section($location);

        return $main;
    }
}
