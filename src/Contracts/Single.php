<?php


/**
 * Trait Single
 */

namespace Incraigulous\AdminZone\Contracts;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Incraigulous\AdminZone\Forms\Form;

interface Single extends ItemInterface
{
    public function title(): Single;
    public function collectionTitle(): Single;
    public function Form(Form $form): Single;
    public function create(Form $form): Single;
    public function update(Form $form): Single;
}
