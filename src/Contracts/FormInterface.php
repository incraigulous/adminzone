<?php

namespace Incraigulous\AdminZone\Contracts;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Incraigulous\AdminZone\Elements;

interface FormInterface extends ItemInterface
{
    public function getRules(): array;
    public function getSuccessMessage(): string;
    public function getSubmission(): SubmissionInterface;
    public function getMain(): SectionInterface;
}
