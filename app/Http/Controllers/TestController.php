<?php

namespace App\Http\Controllers;

use App\Blog\Facades\Blog;
use App\Blog\Facades\Payment;
use App\Contracts\ContactRequestContract;
use App\Events\ContactRequestCreatedEvent;
use App\Http\Requests\SendKontaktRequest;
use App\Imports\ContactRequestImport;
use App\Jobs\LogNewContactRequestJob;
use App\Mail\NewContactRequestMail;
use App\Models\Category;
use App\Models\ContactRequest;
use Carbon\Carbon;
use Illuminate\Bus\Dispatcher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Permission;
use function GuzzleHttp\Promise\queue;

class TestController extends Controller
{
    public function __construct(private ContactRequestContract $contactRequestContract)
    {
    }

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

    public function callback(Request $request)
    {

    }

    public function test2()
    {
        $response = Http::post('http://localhost/api/contact-requests', [
            'name' => 'John Doe',
            'email' => 'jd@test.de',
            'message' => 'test',
            'category_id' => 1
        ]);

        dd($response->json());

//        return Payment::checkout();
//        return app()->get('blog')->greet('test');
//        return (new Blog())->greet('Test');

        $date = Carbon::parse('28.06.2022');

        dd($date->addDay());

        File::makeDirectory(storage_path('hans'), 0777, true, true);

        $file = Storage::disk('franz')->get('Mappe1.xlsx');

        dd($file);
    }

    public function test3()
    {
//        $token = auth()->user()->createToken('Test', [
//            'list-contact-requests',
//            'create-contact-request',
//        ]);
//        dd($token);
//        Permission::create([
//            'name' => 'view-contact-requests',
//        ]);

        $json = file_get_contents(base_path('test.json'));
        $data = collect(json_decode($json, true));

        dd($data->where('name', '=', 'Max Mustermann'));

//        $data->chunk(5)->each(function ($chunk) {
//            $chunk->each(function ($item) {
//                echo $item['name'];
//            });
//        });

//        $data->each(function ($item) {
//            echo $item['name'];
//        });

        Excel::queueImport(new ContactRequestImport(), base_path('Mappe1.csv'));

//        auth()->user()->revokePermissionTo('view-contact-requests');
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
        $this->contactRequestContract->create($request->validated());

        return redirect()->back()->with('message', 'Formular erfolgreich abgesendet!');
    }
}
