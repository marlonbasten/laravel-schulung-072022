<?php

namespace App\Http\Controllers\Api;

use App\Contracts\ContactRequestContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\SendKontaktRequest;
use App\Models\ContactRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ContactRequestController extends Controller
{
    public function __construct(private ContactRequestContract $contactRequestContract)
    {
        $this->middleware('auth:sanctum');
        $this->middleware('ability:list-contact-requests')->only('index');
    }

    public function index()
    {
//        if (!auth()->user()->tokenCan('list-contact-requests')) {
//            abort(403);
//        }

        if (Cache::has('contactRequests')) {
            $contactRequests = Cache::get('contactRequests');
        } else {
            $contactRequests = ContactRequest::all()->map(fn($contactRequest) => $contactRequest->only(['id', 'name', 'email', 'message', 'category_id', 'done']));
            Cache::put('contactRequests', $contactRequests, now()->addMinutes(5));
        }

        return response()->json([
            'success' => true,
            'data' => $contactRequests
        ]);
    }

    public function store(SendKontaktRequest $request)
    {
        $contactRequest = $this->contactRequestContract->create($request->validated());

        return response()->json([
            'success' => true,
            'data' => $contactRequest->only(['id', 'name', 'email', 'message', 'category_id', 'done']),
        ], 201);
    }
}
