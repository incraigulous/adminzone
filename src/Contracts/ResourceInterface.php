<?php

namespace Incraigulous\AdminZone\Contracts;

use Illuminate\Database\Eloquent\Model;

interface ResourceInterface extends ItemInterface
{
    public function __construct(string $label, FormInterface $form, $modelOrResolver);
    public function model(): Model;
    public function repository(): RepositoryInterface;
    public function form(): FormInterface;
    public function create(): FormInterface;
    public function update(): FormInterface;
    public function filter(): FilterInterface;
}
