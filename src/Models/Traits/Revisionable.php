<?php
/**
 * Revisionable.php
 */

namespace Incraigulous\AdminZone\Models\Traits;


use Incraigulous\AdminZone\Exceptions\RevisionException;
use Incraigulous\AdminZone\Models\Revision;

trait Revisionable
{
    public static function bootRevisionable()
    {
        static::updated(function($item){
            $item->saveRevision();
        });
    }

    public function saveRevision()
    {
        if (!$this->id) {
            throw new RevisionException('The record must be saved to create a revision.');
        }
        $revision = new Revision();
        $revision->revisionable_type = static::class;
        $revision->revisionable_id = $this->id;
        $revision->user_id = (auth()->check()) ? auth()->user()->id : null;
        $revision->data = $this->toArray();
        $revision->save();
    }

    /**
     * @return mixed
     */
    public function revisions()
    {
        return $this->morphMany(Revision::class, 'revisionable');
    }

}
