<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

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

Route::get(
    '/redirect',
    function (Request $request) {
        $request->session()->put('state', $state = Str::random(40));

        $query = http_build_query(
            [
                'client_id' => '9189154e-64aa-45ae-ba55-1a178c20012d',
                'redirect_uri' => 'http://localhost:8000/callback',
                'response_type' => 'code',
                'scope' => '',
                'state' => $state,
            ]
        );


        Log::info('Redirecting...');

        return redirect('http://localhost:8001/oauth/authorize?' . $query);
    }
);

Route::get('/callback', function (Request $request) {
    Log::info('We got here...');

    $http = new GuzzleHttp\Client();

    $response = $http->post('http://localhost:8001/oauth/token', [
        'form_params' => [
            'grant_type' => 'authorization_code',
            'client_id' => '9189154e-64aa-45ae-ba55-1a178c20012d',
            'client_secret' => 'RfCEfe9AswDq7byQaDAF8v3LtU6MhJMjuvzVsrt3',
            'redirect_uri' => 'http://localhost:8000/callback',
            'code' => $request->code,
        ],
    ]);

    Log::info('We got to the end too');

    return json_decode((string)$response->getBody(), true, 512, JSON_THROW_ON_ERROR);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/passport', function () {
    return view('passport');
})->name('passport');
