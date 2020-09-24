<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/get-in-touch', function () {
    return view('get-in-touch');
});

Route::get('/rich-jowett', function () {
    return view('rich-jowett');
});

Route::get('/snippets', function () {
    return view('snippets');
});

Route::get(
    '/redirect',
    function (Request $request) {
        $request->session()->put('state', $state = Str::random(40));

        $query = http_build_query(
            [
                'client_id' => config('snippets.oauth.client.id'),
                'redirect_uri' => config('app.url') . '/callback',
                'response_type' => 'code',
                'scope' => '',
                'state' => $state,
            ]
        );

        return redirect(config('snippets.oauth.server.url') . '/authorize?' . $query);
    }
);

Route::get('/callback', function (Request $request) {
    $http = new GuzzleHttp\Client();

    $response = $http->post(config('snippets.oauth.server.url') . '/token', [
        'form_params' => [
            'grant_type' => 'authorization_code',
            'client_id' => config('snippets.oauth.client.id'),
            'client_secret' => config('snippets.oauth.client.secret'),
            'redirect_uri' => config('app.url') . '/callback',
            'code' => $request->code,
        ],
    ]);

    return json_decode((string)$response->getBody(), true, 512, JSON_THROW_ON_ERROR);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/passport', function () {
    return view('passport');
})->name('passport');
