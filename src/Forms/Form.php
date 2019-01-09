<?php

namespace Incraigulous\AdminZone\Forms;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Factory;
use Incraigulous\AdminZone\Contracts\FormInterface;
use Incraigulous\AdminZone\Contracts\SectionInterface;
use Incraigulous\AdminZone\Contracts\SubmissionInterface;
use Incraigulous\AdminZone\Fields\Fields;
use Incraigulous\AdminZone\Item;
use Incraigulous\AdminZone\Sections\Main;
use Incraigulous\AdminZone\Submissions\ModelSubmission;
use Incraigulous\AdminZone\Submissions\Submission;
use Incraigulous\AdminZone\Traits\ConvertsArrayToJson;
use Incraigulous\AdminZone\Traits\HasComponent;
use Incraigulous\AdminZone\Traits\HasFields;
use Incraigulous\AdminZone\Traits\HasLabel;
use Incraigulous\AdminZone\Traits\HasSections;
use Incraigulous\AdminZone\Traits\HasType;
use JeffOchoa\ValidatorFactory;

/**
 * Class Form
 */
abstract class Form extends Item implements FormInterface
{
    abstract protected function main(SectionInterface $body): SectionInterface;

    public function type(): string
    {
        return 'form';
    }

    public function successMessage(): string
    {
        return 'The form was submitted successfully.';
    }

    public function view(): string
    {
        return 'forms.' . $this->type();
    }

    protected function getMain(): SectionInterface
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

    public function rules(): array
    {
        return [];
    }

    public function submission(): SubmissionInterface
    {
        return new Submission;
    }
}
