<?php

namespace App\Services;

use App\Contracts\ContactRequestContract;
use App\Events\ContactRequestCreatedEvent;
use App\Models\ContactRequest;
use Illuminate\Support\Facades\Storage;

class ContactRequestService implements ContactRequestContract
{
    public function create(array $data): ContactRequest
    {
        if (isset($data['file'])) {

            $file = Storage::putFileAs('/', $data['file'], $data['file']->getClientOriginalName().'_'.time().'.'.$data['file']->getClientOriginalExtension());

        }

        $contactRequest = new ContactRequest(collect($data)->except('file')->toArray());
        if (isset($file)) {
            $contactRequest->file_path = $file;
            $contactRequest->file_disk = 'local';
        }
        $contactRequest->save();

        event(new ContactRequestCreatedEvent($contactRequest));

        return $contactRequest;
    }
}
