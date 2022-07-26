<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendKontaktRequest;
use App\Models\Category;
use App\Models\ContactRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function index()
    {
        $users = [
            'Max',
            'Peter',
            'Hans',
        ];

        return view('test', [
            'name' => 'Marlon',
            'age' => 16,
            'users' => $users
        ]);
    }

    public function test()
    {
        $rawSql = DB::select(DB::raw('SELECT * FROM tags'));

        dd($rawSql);

        $contact_request = ContactRequest::find(1);

        // $contact_request->tags()->attach(1); // Fügt einen Tag zu einer Kontaktanfrage hinzu. Achtung: Geht auch doppelt!
        $contact_request->tags()->syncWithoutDetaching(1);

        foreach ($contact_request->tags as $tag) {
            echo $tag->name . '<br>';
        }
    }

    public function kontakt(string $country = 'de')
    {
        $countryList = [
            'de',
            'ch',
            'at',
        ];

        $categories = Category::all();

        return view('kontakt', compact('country', 'countryList', 'categories'));
    }

    public function send(SendKontaktRequest $request)
    {
        $contactRequest = new ContactRequest($request->validated());
        $contactRequest->save();

        return redirect()->back()->with('message', 'Formular erfolgreich abgesendet!');
    }
}
