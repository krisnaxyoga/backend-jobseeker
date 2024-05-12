<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// candidate
Route::get('/candidate', [\App\Http\Controllers\Api\CandidateController::class, 'index'])->name('candidate.index');
Route::post('/candidate/store', [\App\Http\Controllers\Api\CandidateController::class, 'store'])->name('candidate.store');
Route::get('/candidate/{id}', [\App\Http\Controllers\Api\CandidateController::class, 'show'])->name('candidate.show');
Route::put('/candidate/{id}', [\App\Http\Controllers\Api\CandidateController::class, 'update'])->name('candidate.update');
Route::delete('/candidate/{id}', [\App\Http\Controllers\Api\CandidateController::class, 'destroy'])->name('candidate.delete');

// vacancy
Route::get('/vacancy', [\App\Http\Controllers\Api\VacancyController::class, 'index'])->name('vacancy.index');
Route::post('/vacancy/store', [\App\Http\Controllers\Api\VacancyController::class, 'store'])->name('vacancy.store');
Route::get('/vacancy/{id}', [\App\Http\Controllers\Api\VacancyController::class, 'show'])->name('vacancy.show');
Route::put('/vacancy/{id}', [\App\Http\Controllers\Api\VacancyController::class, 'update'])->name('vacancy.update');
Route::delete('/vacancy/{id}', [\App\Http\Controllers\Api\VacancyController::class, 'destroy'])->name('vacancy.delete');

// applicant
Route::get('/applicant', [\App\Http\Controllers\Api\ApplicantController::class, 'index'])->name('applicant.index');
Route::post('/applicant/store', [\App\Http\Controllers\Api\ApplicantController::class, 'store'])->name('applicant.store');
Route::get('/applicant/{id}', [\App\Http\Controllers\Api\ApplicantController::class, 'show'])->name('applicant.show');
Route::put('/applicant/{id}', [\App\Http\Controllers\Api\ApplicantController::class, 'update'])->name('applicant.update');
Route::delete('/applicant/{id}', [\App\Http\Controllers\Api\ApplicantController::class, 'destroy'])->name('applicant.delete');

