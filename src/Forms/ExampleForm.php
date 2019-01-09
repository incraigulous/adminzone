<?php

namespace Incraigulous\AdminZone\Forms;


use Incraigulous\AdminZone\Contracts\SectionInterface;
use Incraigulous\AdminZone\Fields\Types\TextField;
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
        $main->field(TextField::class, 'First Name')
             ->field(TextField::class, 'Last Name');

        $location = Section::create(FieldSet::class, 'Location')
            ->section(FieldSet::class, 'Address')
            ->field(TextField::class, 'Address 1')
            ->field(TextField::class, 'Address 2');

        $main->addSection($location);

        return $main;
    }
}
