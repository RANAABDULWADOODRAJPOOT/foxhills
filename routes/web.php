<?php

use Illuminate\Support\Facades\Route;


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

// Route::get('/', function () {
//     return view('homepage');
// });








Auth::routes();
Route::group(['prefix' => 'admin'], function() {
    Route::get('/Dashboard', [App\Http\Controllers\AdminController::class, 'index']);
    Route::get('/add-property-type', [App\Http\Controllers\AdminController::class, 'addPropertyType']);
    Route::post('save-property-type', [App\Http\Controllers\AdminController::class, 'savePropertyType']);
    Route::get('show-property-type', [App\Http\Controllers\AdminController::class, 'showPropertyType']);
    Route::get('edit/{id}', [App\Http\Controllers\AdminController::class, 'editPropertyType']);
    Route::post('update-property-type/{id}', [App\Http\Controllers\AdminController::class, 'updatePropertyType']);
    Route::get('delete-property-type/{id}', [App\Http\Controllers\AdminController::class, 'deletePropertyType']);
    Route::get('downloadrequests', [App\Http\Controllers\AdminController::class, 'downloadRequests']);
 

    

    
    
   
     Route::get('create-page', [App\Http\Controllers\AdminController::class, 'createPage']);
     Route::post('save-page', [App\Http\Controllers\AdminController::class, 'savePage']);
      Route::get('show-pages', [App\Http\Controllers\AdminController::class, 'showpage']);
      Route::get('edit_page/{id}', [App\Http\Controllers\AdminController::class, 'editpage']);
       Route::post('update_page/{id}', [App\Http\Controllers\AdminController::class, 'updatePage']);
       Route::get('delete_page/{id}', [App\Http\Controllers\AdminController::class, 'deletepage']);
      Route::get('multiplePictures/{id}', [App\Http\Controllers\AdminController::class, 'multiplePictures']);
      Route::post('save-multipic', [App\Http\Controllers\AdminController::class, 'multipic']);


        Route::get('show-general-page', [App\Http\Controllers\AdminController::class, 'showgeneral']);
         Route::get('edit-general-page/{id}', [App\Http\Controllers\AdminController::class, 'editcontent']);
          Route::post('update-content/{id}', [App\Http\Controllers\AdminController::class, 'updatecontent']);
           Route::get('delete-general-page/{id}', [App\Http\Controllers\AdminController::class, 'deletecontent']);


           
           Route::get('addagent', [App\Http\Controllers\AdminController::class, 'addagent']);
            Route::post('save-agent', [App\Http\Controllers\AdminController::class, 'saveagent']);
           Route::get('showagent', [App\Http\Controllers\AdminController::class, 'showagent']);
           Route::get('editaddagent/{id}', [App\Http\Controllers\AdminController::class, 'editaddagent']);
           Route::post('updateagent/{id}', [App\Http\Controllers\AdminController::class, 'updateagent']);
           Route::get('deleteagent/{id}', [App\Http\Controllers\AdminController::class, 'deleteagent']);
   




   
    Route::get('upload-items', [App\Http\Controllers\AdminController::class, 'addItems']);
    Route::post('save-items', [App\Http\Controllers\AdminController::class, 'saveItems']);
    Route::get('show-upload-items', [App\Http\Controllers\AdminController::class, 'showItems']);
    Route::get('edit-upload-items/{id}', [App\Http\Controllers\AdminController::class, 'editItems']);
    Route::post('update-upload-items/{id}', [App\Http\Controllers\AdminController::class, 'updateItems']);
    Route::get('delete-upload-items/{id}', [App\Http\Controllers\AdminController::class, 'deleteItems']);
    Route::get('upload-journals', [App\Http\Controllers\AdminController::class, 'uploadJournals']);
    Route::get('multi-journals', [App\Http\Controllers\AdminController::class, 'multiJournals']);
    Route::post('save-multipicblog', [App\Http\Controllers\AdminController::class, 'saveJournalspics']);
  
    Route::post('save-journals', [App\Http\Controllers\AdminController::class, 'saveJournals']);
    Route::get('show-journals', [App\Http\Controllers\AdminController::class, 'showJournals']);
    Route::get('edit_journal/{id}', [App\Http\Controllers\AdminController::class, 'editJournals']);
    Route::post('update_journal/{id}', [App\Http\Controllers\AdminController::class, 'updateJournals']);
    Route::get('delete_journal/{id}', [App\Http\Controllers\AdminController::class, 'deleteJournals']);
    Route::get('show-request', [App\Http\Controllers\AdminController::class, 'showRequest']);

});

Route::get('sale', 'App\Http\Controllers\saleController@index');
Route::post('sale/save-request-from-user', 'App\Http\Controllers\saleController@saveRequest');
Route::get('details/{id}', 'App\Http\Controllers\luxhabitateIndexController@datadetail');


Route::get('Journal', 'App\Http\Controllers\journalController@index');
Route::get('Journal/{id}', 'App\Http\Controllers\journalController@detail');
Route::get('Journal/{name}/{id}', 'App\Http\Controllers\journalController@filterbycategory');



Route::get('filters', 'App\Http\Controllers\buyController@filterviatype');
Route::get('agentdetails/{id}', 'App\Http\Controllers\luxhabitateIndexController@agentdetails');
Route::get('/', 'App\Http\Controllers\luxhabitateIndexController@index');
Route::get('{name}/{id}/{type?}', 'App\Http\Controllers\luxhabitateIndexController@pagedata');
Route::get('agents', 'App\Http\Controllers\luxhabitateIndexController@agents');

Route::get('agent', 'App\Http\Controllers\luxhabitateIndexController@agent');







