<?php

namespace Incraigulous\AdminZone;


use Incraigulous\AdminZone\Contracts\ItemInterface;
use Incraigulous\AdminZone\Traits\ConvertsArrayToJson;

/**
 * Class Item
 */
abstract class Item implements ItemInterface
{
    public function view(): string
    {
        return 'adminzone::' . $this->typePlural() . '.' . $this->slug();
    }

    public function typePlural(): string
    {
        if (!$this->type()) {
            return null;
        }
        return str_plural($this->type());
    }

    public function slug(): string
    {
        $reflect = new \ReflectionClass($this);
        return kebab_case($reflect->getShortName());
    }

    public function path(): string
    {
        return implode('/', [
            config('adminzone.path'),
            $this->slug()
        ]);
    }

    public function route(): string
    {
        return 'adminzone::' . $this->slug();
    }

    public function label(): string
    {
        return title_case(str_replace('-', ' ', $this->slug()));
    }

    public function collectionLabel(): string
    {
        if (!$this->label()) {
            return null;
        }
        return str_plural($this->label());
    }

    protected function asArray() {
        return [];
    }

    public function toArray() {
        return array_merge([
            'type' => $this->type(),
            'typePlural' => $this->typePlural(),
            'label' => $this->label(),
            'collectionLabel' => $this->collectionLabel(),
            'slug' => $this->slug(),
            'view' => $this->view(),
            'path' => $this->path(),
            'route' => $this->route()
        ], $this->asArray());
    }

    public function toJson($options = 0): string
    {
        return json_encode($this->toArray(), $options);
    }

    public function toObject()
    {
        return objection($this->toArray());
    }
}
