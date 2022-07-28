<?php

namespace App\Observers;

use App\Jobs\LogNewContactRequestJob;
use App\Models\ContactRequest;

class ContactRequestObserver
{
    /**
     * Handle the ContactRequest "created" event.
     *
     * @param  \App\Models\ContactRequest  $contactRequest
     * @return void
     */
    public function created(ContactRequest $contactRequest)
    {
        LogNewContactRequestJob::dispatch('Neue Kontaktanfrage');
    }

    /**
     * Handle the ContactRequest "updated" event.
     *
     * @param  \App\Models\ContactRequest  $contactRequest
     * @return void
     */
    public function updated(ContactRequest $contactRequest)
    {
        //
    }

    /**
     * Handle the ContactRequest "deleted" event.
     *
     * @param  \App\Models\ContactRequest  $contactRequest
     * @return void
     */
    public function deleted(ContactRequest $contactRequest)
    {
        //
    }

    /**
     * Handle the ContactRequest "restored" event.
     *
     * @param  \App\Models\ContactRequest  $contactRequest
     * @return void
     */
    public function restored(ContactRequest $contactRequest)
    {
        //
    }

    /**
     * Handle the ContactRequest "force deleted" event.
     *
     * @param  \App\Models\ContactRequest  $contactRequest
     * @return void
     */
    public function forceDeleted(ContactRequest $contactRequest)
    {
        //
    }
}
