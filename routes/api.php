<?php

use App\Http\Controllers\API\Authentication\LoginController;
use App\Http\Controllers\API\Authentication\PasswordResetController;
use App\Http\Controllers\API\Authentication\RegisterController;
use App\Http\Controllers\API\Authentication\RequestPasswordResetController;
use App\Http\Controllers\API\Bookmarks\ListBookmarksController;
use App\Http\Controllers\API\Donations\GetSingleDonationController;
use App\Http\Controllers\API\Donations\ListDonationsController;
use App\Http\Controllers\API\People\GetSinglePersonController;
use App\Http\Controllers\API\People\ListPeopleController;
use App\Http\Controllers\API\People\SearchPeopleController;
use App\Http\Controllers\API\Petitions\GetSinglePetitionController;
use App\Http\Controllers\API\Petitions\ListPetitionsController;
use Illuminate\Support\Facades\Route;

Route::post('register', RegisterController::class);
Route::post('login', LoginController::class);
Route::post('request/password/reset', [RequestPasswordResetController::class, 'sendResetLinkEmail'])->middleware('throttle:5,30');
Route::post('password/reset', [PasswordResetController::class, 'reset']);

Route::middleware('api')->group(function () {
    Route::get('people', ListPeopleController::class);
    Route::get('people/{person}', GetSinglePersonController::class);
    Route::get('people/search/{person}', SearchPeopleController::class);

    Route::get('donations', ListDonationsController::class);
    Route::get('donations/{donation}', GetSingleDonationController::class);

    Route::get('petitions', ListPetitionsController::class);
    Route::get('petitions/{petition}', GetSinglePetitionController::class);

    Route::get('/bookmarks', ListBookmarksController::class);
});
