<?php

namespace Incraigulous\AdminZone\Sections;


use Illuminate\Support\Collection;
use Incraigulous\AdminZone\Elements;
use Incraigulous\Objection\DataTransferObject;

/**
 * Class Conditional
 */
class Conditional extends Section
{
    protected $conditions = [];

    /**
     * Register a condition.
     * @param $callback
     * @param $fields
     *
     * @return Conditional
     */
    public function addCondition($callback, $fields): Conditional
    {
        $this->conditions[] = new DataTransferObject([
            'callback' => $callback,
            'fields' => $fields
        ]);

        return $this;
    }

    /**
     * Get all the conditions.
     * @return Collection
     */
    public function getConditions(): Collection
    {
        return collect($this->conditions);
    }

    /**
     * Find the first condition the entry matches.
     * @param $entry
     *
     * @return mixed
     */
    public function findCondition($entry)
    {
        return $this->getConditions()->first(function($condition) use ($entry) {
            $callback = $condition->callback;
            return $callback($entry);
        });
    }

    /**
     * Does an entry match a condition?
     * @param $entry
     *
     * @return bool
     */
    public function matchesCondition($entry): bool
    {
        return !!$this->findCondition($entry);
    }

    /**
     * Get the fields of the first conditional the entry matches.
     * @param $entry
     *
     * @return Elements
     */
    public function getConditionalFields($entry): Elements
    {
        if (!$this->matchesCondition($entry)) {
            return new Elements([]);
        }

        return new Elements($this->findCondition($entry)->fields);
    }

    /**
     * Get all the fields for all conditionals, making sure don't to include duplicates.
     * @return Elements
     */
    public function getFields(): Elements
    {
        $elements = new Elements();
        $names = collect([]);

        $this->getConditions()->each(function($condition) use (&$elements, $names) {
            $condition->fields->each(function($field) use (&$elements, $names) {
                if ($names->contains($field->getName())) {
                    return;
                }

                $elements->push($field);
                $names->push($field->getName());
            });
        });

        return $elements;
    }

}
