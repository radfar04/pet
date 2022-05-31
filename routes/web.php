<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CaptchaController;

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
//Route::get('reload-captcha', [CaptchaController::class, 'reloadCaptcha']);

Route::get('register', [CaptchaController::class, 'index']);
Route::post('captcha-validation', [CaptchaController::class, 'capthcaFormValidate']);
Route::get('reload-captcha', [CaptchaController::class, 'reloadCaptcha']);

Route::get('/', function () {
   return view('auth.login');
});
Route::middleware('auth')->group(function() 
{
      Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

      Route::resource('db','App\Http\Controllers\DBController');

      Route::get('/foo/bar','App\Http\Controllers\UriController@index');

      Route::get('/cookie/get','App\Http\Controllers\CookieController@getCookie');
      Route::get('/cookie/set','App\Http\Controllers\CookieController@setCookie');



      Route::get('json',function() {
         return response()->json(['name' => 'Virat Gandhi', 'state' => 'Gujarat']);
      });
      Route::get('/test', ['as'=>'testing',function() {
         return view('test');
      }]);

      Route::get('redirect',function() {
         return redirect()->route('testing');
      });

      Route::get('/form',function() {
         return view('form');
      });

      Route::get('/validation','App\Http\Controllers\ValidationController@showform');
      Route::post('/validation','App\Http\Controllers\ValidationController@validateform');

      Route::get('ajax',function() {
         return view('message');
      });
      Route::post('/getmsg','App\Http\Controllers\AjaxController@index');
      Route::get('reminder',function(){ return view('reminder'); })-> name('reminder');  
      Route::get('docnew', \App\Http\Livewire\DocNew::class)-> name('docnew');
      Route::get('searchdocs', \App\Http\Livewire\SearchDocs::class)-> name('searchdocs');
      Route::get('emailing', \App\Http\Livewire\Emailing::class)-> name('emailing');

      Route::get('members','App\Http\Controllers\MembersController@index')-> name('members');  
      Route::get('memberedit/{id}','App\Http\Controllers\MembersController@edit')-> name('memberedit');  
      Route::post('memberupdate','App\Http\Controllers\MembersController@update')-> name('memberupdate');  
      Route::get('test', function () {return view('test', ['name' => 'James']); })->name('test');
      

   });



Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');



