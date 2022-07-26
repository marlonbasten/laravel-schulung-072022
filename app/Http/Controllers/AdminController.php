<?php

namespace App\Http\Controllers;

use App\Models\ContactRequest;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function contact()
    {
        $contact_requests = ContactRequest::query()->with(['category'])->where('done', false)->select([
            'id',
            'name',
            'email',
            'message',
            'done',
            'category_id',
        ])->paginate(5);

//        ContactRequest::query()->whereIn('id', [3,4])->update(['done' => true]);

        return view('admin.contact_requests', compact('contact_requests'));
    }

    public function contactDone(ContactRequest $contact_request)
    {
        $contact_request->update([
            'done' => true,
        ]);

        return redirect()->back();
    }

    public function contactDelete(ContactRequest $contact_request)
    {
        $contact_request->delete();

        return redirect()->back();
    }
}
