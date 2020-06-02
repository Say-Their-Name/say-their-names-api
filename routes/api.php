<?php

use App\Http\Controllers\API\Donations\GetSingleDonationController;
use App\Http\Controllers\API\Donations\ListDonationsController;
use App\Http\Controllers\API\People\GetSinglePersonController;
use App\Http\Controllers\API\People\ListPeopleByCityController;
use App\Http\Controllers\API\People\ListPeopleByCountryController;
use App\Http\Controllers\API\People\ListPeopleController;
use App\Http\Controllers\API\Petitions\GetSinglePetitionController;
use App\Http\Controllers\API\Petitions\ListPetitionsController;
use Illuminate\Support\Facades\Route;

Route::middleware('api')->group(function () {
    Route::get('people', ListPeopleController::class);
    Route::get('people/{person}', GetSinglePersonController::class);
    Route::get('find-by-city/people/{city}', ListPeopleByCityController::class);
    Route::get('find-by-county/people/{country}', ListPeopleByCountryController::class);

    Route::get('donations', ListDonationsController::class);
    Route::get('donations/{donation}', GetSingleDonationController::class);
    Route::get('find-by-city/donations/{city}', ListPeopleByCityController::class);
    Route::get('find-by-county/donations/{country}', ListPeopleByCountryController::class);

    Route::get('petitions', ListPetitionsController::class);
    Route::get('petitions/{petition}', GetSinglePetitionController::class);
    Route::get('find-by-city/petitions/{city}', ListPeopleByCityController::class);
    Route::get('find-by-county/petitions/{country}', ListPeopleByCountryController::class);
});
