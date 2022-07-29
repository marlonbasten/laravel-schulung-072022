<?php

namespace App\Http\Controllers;

use App\Models\ContactRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function contact()
    {
        /*if (auth()->user()->cannot('viewAny', ContactRequest::class)) {
            abort(403);
        }*/

        $contact_requests = ContactRequest::query()->where('done', false)->leftJoin('categories', 'contact_requests.category_id', 'categories.id')->select([
            'contact_requests.id',
            'contact_requests.name',
            'contact_requests.email',
            'contact_requests.message',
            'contact_requests.done',
            'contact_requests.category_id',
            'categories.name AS category_name',
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
        if (auth()->user()->cannot('delete', $contact_request)) {
            abort(403);
        }

        $contact_request->delete();

        return redirect()->back();
    }

    public function download(ContactRequest $contact_request)
    {

        return Storage::disk($contact_request->file_disk)->download($contact_request->file_path);
    }
}
