<?php

namespace Incraigulous\AdminZone;


use Incraigulous\AdminZone\Contracts\ItemInterface;
use Incraigulous\AdminZone\Traits\ConvertsArrayToJson;
use Illuminate\Support\Facades\Config;

/**
 * Class Item
 */
abstract class Item implements ItemInterface
{
    protected function view(): string
    {
        return 'adminzone::' . $this->typePlural() . '.' . $this->slug();
    }

    abstract protected function type(): string;

    protected function typePlural(): string
    {
        if (!$this->type()) {
            return null;
        }
        return str_plural($this->type());
    }

    protected function slug(): string
    {
        $reflect = new \ReflectionClass($this);
        return kebab_case($reflect->getShortName());
    }

    protected function path(): string
    {
        return implode('/', [
            Config::get('adminzone.path'),
            $this->typePlural(),
            $this->slug()
        ]);
    }

    protected function route(): string
    {
        return 'adminzone::' . $this->type();
    }

    protected function label(): string
    {
        return title_case(str_replace('-', ' ', $this->slug()));
    }

    protected function collectionLabel(): string
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
            'type' => $this->getType(),
            'typePlural' => $this->getTypePlural(),
            'label' => $this->getLabel(),
            'collectionLabel' => $this->getCollectionLabel(),
            'slug' => $this->getSlug(),
            'view' => $this->getView(),
            'path' => $this->getPath(),
            'route' => $this->getRoute()
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

    public function getView(): string
    {
        return $this->view();
    }

    public function getSlug(): string
    {
        return $this->slug();
    }

    public function getType(): string
    {
        return $this->type();
    }

    public function getTypePlural(): string
    {
        return $this->typePlural();
    }

    public function getLabel(): string
    {
        return $this->label();
    }

    public function getRoute(): string
    {
        return $this->route();
    }

    public function getPath(): string
    {
        return $this->path();
    }

    public function getCollectionLabel(): string
    {
        return $this->collectionLabel();
    }
}
