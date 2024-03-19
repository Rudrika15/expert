<?php

use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\VisitorController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/', function(){
//     return view('layouts.master');
// });
// Route::get('/', function () {
//     return view('loginDesign');
// });
// Route::get('/',[VisitorController::class, 'home'])->name('home');

// admin side
Route::get('/',[LoginController::class, 'login'])->name('admin.login');
Route::post('/userStored',[LoginController::class, 'userStore'])->name('login.store');
Route::get('/testUpload',[VisitorController::class, 'uploadTest'])->name('uploadTest');
Route::post('/testUploaded',[VisitorController::class, 'saveTest'])->name('saveTest');
Route::get('/viewTest', [VisitorController::class, 'viewTest'])->name('viewTest');
Route::get('/viewQuestions', [VisitorController::class, 'viewExamQuestionnaire'])->name('viewExamQuestionnaire');
Route::get('/selectYourTest', [VisitorController::class, 'selectTest'])->name('selectTest');
Route::post('/storeSelectedData', [VisitorController::class, 'storeSelectedData'])->name('storeSelectedData');
Route::get('/results', [VisitorController::class, 'results'])->name('admin.results');
Route::patch('/result-data/{resultData}/edit', [VisitorController::class, 'resultsUpdate'])->name('admin.resultsUpadte');
Route::get('/printData/{id}', [VisitorController::class, 'printData'])->name('admin.printData');
// visitor side
Route::get('/studentLogin', [VisitorController::class, 'studentLogin'])->name('studentLogin');
Route::post('/studentLoginStored', [VisitorController::class, 'studentLoginStored'])->name('studentLoginStored');
Route::get('/SelectSubject', [VisitorController::class, 'selectSubject'])->name('selectSubject');
Route::get('/exam', [VisitorController::class, 'examPaper'])->name('examPaper');
Route::post('/resultStore', [VisitorController::class, 'resultStore'])->name('resultStore');
Route::get('/result',[VisitorController::class, 'viewResults'])->name('viewResults');
