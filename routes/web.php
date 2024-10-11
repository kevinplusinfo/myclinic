<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\MedicineController;
use App\Http\Controllers\Admin\ImgController;
use App\Http\Controllers\Admin\PatientsController;
use App\Http\Controllers\Admin\AuthentiCationController;
use App\Http\Controllers\Admin\ExportController;




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
Route::middleware('guest')->group(function () {
	Route::view('/', 'admin.auth.login')->name('login-view');
	Route::post('login', [AuthentiCationController::class, 'authenticate'])->name('login');
});

Route::middleware('auth')->group(function(){
	Route::prefix('admin')->group(function () {
		
		Route::get('/logout', [AuthentiCationController::class, 'logout'])->name('logout');

		Route::prefix('medicine')->group(function(){
			Route::get('/', [MedicineController::class, 'medicine'])->name('medicine');
			Route::get('/form', [MedicineController::class, 'form'])->name('medicine.form');
			Route::get('/add', [MedicineController::class, 'add'])->name('medicine.add');
			Route::get('/add/{id?}', [MedicineController::class, 'add'])->name('medicine.add');
			Route::get('/update/{id}', [MedicineController::class, 'update'])->name('medicine.update');
			Route::get('/delete/{id}', [MedicineController::class, 'delete'])->name('medicine.delete');
			Route::get('/trash', [MedicineController::class, 'trash'])->name('medicine.trash');
			Route::post('/restore/{id}', [MedicineController::class, 'restore'])->name('medicine.restore');

		});
		Route::prefix('patients')->group(function(){
			Route::get('/', [PatientsController::class, 'patients'])->name('patients');
			Route::post('/add', [PatientsController::class, 'add'])->name('patients.add');
			Route::get('/delete/{id}', [PatientsController::class, 'delete'])->name('patients.delete');
			Route::post('/username', [PatientsController::class, 'checkusername'])->name('patients.name');

			Route::get('/{id}', [PatientsController::class, 'patient_medicine'])->name('patients.patient_medicine');
			Route::get('/{patient_id}/form', [PatientsController::class, 'patients_medicine_form'])->name('patients.patients_medicine_form');
			Route::post('/{patient_id}/add', [PatientsController::class, 'add_patients_medicine'])->name('patients.add_patients_medicine');
			Route::get('/delete_patients_visit_medicine/{patient_visit_id}/{patient_id}', [PatientsController::class, 'delete_patients_visit_medicine'])->name('patients.delete_patients_visit_medicine');
			Route::get('/{patient_id}/{patient_visit_id}/update_form', [PatientsController::class, 'update_medicine_form'])->name('patients.update_medicine_form');

			Route::get('/{id}/export-csv', [ExportController::class, 'exportCsv'])->name('patients.exportCsv');
		});
		Route::prefix('img')->group(function(){
			Route::get('/', [ImgController::class, 'img'])->name('img');
			Route::get('/imageuplodeform', [ImgController::class, 'imageuplodeform'])->name('img.imageuplodeform');
			Route::post('/imageuplode', [ImgController::class, 'imageuplode'])->name('img.imageuplode');

		});

	});
});


