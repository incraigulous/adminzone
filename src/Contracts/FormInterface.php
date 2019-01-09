<?php

namespace Incraigulous\AdminZone\Contracts;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

interface FormInterface extends ItemInterface
{
    public function rules(): array;
    public function successMessage(): string;
    public function submission(): SubmissionInterface;
}
