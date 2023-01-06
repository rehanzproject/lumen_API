<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/name', function () {
    return "Nama Saya : Rehan Maulana";
});
$router->group(['prefix' => 'siswa'], function () use ($router) {
    $router->get('/', 'SiswaController@all');
   $router->get('/{id}', 'SiswaController@getByID');
});
$router->group(['prefix' => 'kelas'], function () use ($router) {
    $router->get('/', 'KelasController@all');
    $router->get('/{id}', 'KelasController@getByID');
    $router->delete('kelas/{id}', 'KelasController@deleteSiswa');
});
/*
$router->group(['prefix' => 'kelas'], function () use ($router) {
    $router->get('siswa', function () {
        return [
            "Rehan" => [
                 "nama"=> "Rehan", "Umur"=> 18, "Profil"=>"Rehan Maulana Umur 18",
            ],
              "Nyoba" => [
                "nama"=> "Nyoba", "Umur"=> 38, "Profil"=>"Nyoba umur 38",
             ], "Test" => [
                 "nama"=> "Halo", "Umur"=> 18, "Profil"=>"Gatau  18",
             ]];
    });
    });
    */
$router->group(['prefix' => 'dosen'], function () use ($router){
    $router->get('/', 'DosenController@getAll');
    $router->get('/{id}', 'DosenController@getOne');
    $router->delete('/{id}', 'DosenController@deleteOne');
    $router->post('/', 'DosenController@addOne');
    $router->put('/{id}', 'DosenController@updateOne');
});


$router->get('/student/{name}', function ($name) {
    $student = [
        "Rehan" => [
            "name" => "rehan",
            "age" => "20",
        ],
    ];
    return $student[$name];
});
