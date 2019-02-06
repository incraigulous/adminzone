<?php

namespace Incraigulous\AdminZone\ViewComposers;


use Illuminate\View\View;
use Incraigulous\AdminZone\AdminZone;
use Incraigulous\Objection\DataTransferObject;

/**
 * Class RelatedEntryComposer
 */
class RelatedEntryComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $data = new DataTransferObject($view->getData());
        $entry = $data->entry;

        if (!$entry) {
            $entry = AdminZone::findResource($data->slug)
                ->getRepository()
                ->find($data->id);
        }

        $view->with('entry',$entry);
    }
}
