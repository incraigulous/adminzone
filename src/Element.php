<?php

namespace Incraigulous\AdminZone;


use Incraigulous\AdminZone\Contracts\ElementInterface;

/**
 * Class Element
 */
abstract class Element extends Item implements ElementInterface
{
    protected $id;

    public function setLabel(string $label): ElementInterface
    {
        $this->label = $label;
        return $this;
    }

    public function getLabel(): string
    {
        if (!$this->label) {
            $this->label = parent::label();
        }
        return $this->label;
    }

    public function id($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        $id = $this->id;
        if (!$id) {
            $id = $this->getType() . '-' . md5(json_encode($this->getLabel()) . json_encode($this->getSlug()));
        }
        return $id;
    }

    public function getAttributes(): array
    {
        return [];
    }
}
