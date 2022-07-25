<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendKontaktRequest;
use Illuminate\Http\Request;

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

    public function kontakt(string $country = 'de')
    {
        $countryList = [
            'de',
            'ch',
            'at',
        ];

        return view('kontakt', compact('country', 'countryList'));
    }

    public function send(SendKontaktRequest $request)
    {
        //TODO: Formular in DB speichern

        return redirect()->back()->with('message', 'Formular erfolgreich abgesendet!');
    }
}
