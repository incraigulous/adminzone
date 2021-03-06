<?php

namespace Incraigulous\AdminZone\Forms;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Factory;
use Incraigulous\AdminZone\Contracts\FormInterface;
use Incraigulous\AdminZone\Contracts\SectionInterface;
use Incraigulous\AdminZone\Contracts\SubmissionInterface;
use Incraigulous\AdminZone\Elements;
use Incraigulous\AdminZone\Fields\Fields;
use Incraigulous\AdminZone\Item;
use Incraigulous\AdminZone\MenuItems\MenuItem;
use Incraigulous\AdminZone\Sections\Main;
use Incraigulous\AdminZone\Submissions\ModelSubmission;
use Incraigulous\AdminZone\Submissions\Submission;
use Incraigulous\AdminZone\Traits\ConvertsArrayToJson;
use Incraigulous\AdminZone\Traits\HasComponent;
use Incraigulous\AdminZone\Traits\HasElements;
use Incraigulous\AdminZone\Traits\HasLabel;
use Incraigulous\AdminZone\Traits\HasSections;
use Incraigulous\AdminZone\Traits\HasType;
use JeffOchoa\ValidatorFactory;

/**
 * Class Form
 */
abstract class Form extends MenuItem implements FormInterface
{
    abstract protected function main(SectionInterface $body): SectionInterface;

    public function type(): string
    {
        return 'form';
    }

    protected function successMessage(): string
    {
        $messages = ['Your doing great!', 'Keep going!', 'Way to go!', 'Whoo Hoo!'];
        return 'Success! ' . $messages[array_rand($messages)];
    }

    public function getSuccessMessage(): string
    {
        return $this->successMessage();
    }

    protected function view(): string
    {
        return 'adminzone::forms.form';
    }

    public function getView(): string
    {
        return $this->view();
    }

    public function getMain(): SectionInterface
    {
        return $this->main(
            Main::create()
        );
    }

    protected function asArray(): array
    {
        return [
            'main' => $this->getMain()->toArray(),
            'submission' => get_class($this->submission())
        ];
    }

    protected function rules(): array
    {
        return [];
    }

    public function getRules(): array
    {
        return $this->rules();
    }

    protected function submission(): SubmissionInterface
    {
        return new Submission;
    }

    public function getSubmission(): SubmissionInterface
    {
        return $this->submission();
    }

    public function getFields(): Elements
    {
        return $this->getMain()->getFields();
    }

    public function getSections(): Elements
    {
        $sections = $this->getMain()->getSections();
        $sections->prepend($this->getMain());
        return $sections;
    }
}
