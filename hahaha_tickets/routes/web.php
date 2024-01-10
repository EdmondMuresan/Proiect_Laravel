<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ArtistController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [EventController::class, 'show_event'] )->name('show_event');
Route::get('despre', function () {
    return view('despre');
})->name('despre');
Route::post('save_event', [EventController::class, 'save_event'])->name('save_event');
Route::delete('events/{id}', [EventController::class,'delete'])->name('events.delete');
Route::get('/events/{id}/edit', [EventController::class,'edit'])->name('events.edit');
Route::put('/events/{id}', [EventController::class,'update'])->name('events.update');
Route::get('new_event',  [EventController::class, 'createEventForm'])->name('new_event');
Route::get('artist', [ArtistController::class, 'showArtists'])->name('artist');
Route::post('new_artist', [ArtistController::class, 'new_artist'])->name('new_artist');
Route::get('add_artist', [ArtistController::class, 'add_artist'])->name('add_artist');
Route::delete('artist/{id}', [ArtistController::class,'delete'])->name('artist.delete');
Route::get('/artist/{id}/edit', [ArtistController::class,'edit'])->name('artist.edit');
Route::put('/artist/{id}', [ArtistController::class,'update'])->name('artist.update');
Auth::routes();

Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('show-tickets', [App\Http\Controllers\TicketController::class, 'showTickets'])->name('show-tickets');
Route::post('add-ticket/{eventId}', [App\Http\Controllers\TicketController::class, 'addTicket'])->name('add-ticket');
Route::delete('deleteTicket/{id}', [App\Http\Controllers\TicketController::class, 'deleteTicket'])->name('deleteTicket');
