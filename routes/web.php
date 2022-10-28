<?php

use App\Http\Controllers\ListingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Listing;

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



// All listings from Model directly
Route::get('/', [ListingController::class, 'index'])->name('listings.index');

Route::get('/listings/create', [ListingController::class, 'create']);

//* Laravel pass an object to show method, automatically 
Route::get('/listings/{listing}', [ListingController::class, 'show'])->name('listings.show');

// Store Listing Data
Route::post('/listings', [ListingController::class, 'store'])->name('listings.store');

// Show Edit form
Route::get('listings/{listing}/edit', [ListingController::class, 'edit'])->name('listings.edit');

//Update the form
Route::put('listings/{listing}', [ListingController::class, 'update'])->name('listings.update');

Route::delete('listings/{listing}', [ListingController::class, 'destroy'])->name('listings.destroy');

//* Route Model Binding with closure
// Route::get('/listings/{listing}', function(Listing $listing){
//     // dd(Listing::find($id));
//     return view('listing', ['listing' => $listing]);
// });

//*See on Network
// Route::get('/hello', function(){
//     return response('<h1>Hello world</h1>')
//     ->header('Content-Type', 'text/plain')
//     ->header('custom', 'header');
// });

//*Constraints on parameter [$id, 'regular expression']
// Route::get('/post/{id}', function($id){
//     dd($id);
//     return response('Post ' . $id);
// })->where('id', '[0-9]+');//the id must be a number between 0 - 9

//* Get query parameters ?name=value&city=Oaxaca
// Route::get('/search', function(Request $request){
//     dd($request->name . ' ' . $request->city);
// });