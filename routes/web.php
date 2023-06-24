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

Route::get('/', function () {
    return view('dashboard.layouts.index');
});

Route::get('/datatab', function () {
    return view('datatab');
});

//Division
Route::group([
    'prefix' => 'divisions',
    'namespace'=>'App\Http\Controllers',
] , function (){

    Route::get('/select', 'DivisionsController@select');
});

//PATIENTS
Route::group([
    'prefix' => 'patients',
    'namespace'=>'App\Http\Controllers',
] , function (){

    Route::get('/select', 'PatientsController@select');
    Route::get('/get_patients', [\App\Http\Controllers\PatientsController::class,'index'])->name('get_patients');
    Route::get('/get_patients_data', [\App\Http\Controllers\PatientsController::class,'getData'])->name('get_patients.data');
    Route::get('/get_appointments/{id}', [\App\Http\Controllers\PatientsController::class,'getAppointments'])->name('get_appointments');
    Route::get('/set_appointment/{patient_id}/{appointment_id}', [\App\Http\Controllers\PatientsController::class,'setAppointment'])->name('set_appointment');
    Route::get('/get_temporary_appointments', [\App\Http\Controllers\PatientsController::class,'getTemporaryAppointments'])->name('get_temporary_appointments');
    Route::get('/paid/{appointment_id}', [\App\Http\Controllers\PatientsController::class,'paid'])->name('paid');
    Route::get("/today_appointments", [\App\Http\Controllers\PatientsController::class,'today_appointments'])->name('today_appointments');
    Route::get("/today_appointments", [\App\Http\Controllers\PatientsController::class,'today_appointments'])->name('today_appointments');

});

//Blood Group

Route::group([
    'prefix' => 'blood_groups',
    'namespace'=>'App\Http\Controllers',
] , function (){
    Route::get('/', 'BloodGroupsController@index');
    Route::get('/data', 'BloodGroupsController@getData')->name('bload.groups.data');
    Route::get('/select', 'BloodGroupsController@select');

    Route::get('/edit/{id}', 'BloodGroupsController@edit');
    Route::get('/create', 'BloodGroupsController@create');
    Route::post('/', 'BloodGroupsController@store');
    Route::get('/{id}', 'BloodGroupsController@getOne');
    Route::put('/update/{id}', 'BloodGroupsController@update');
    Route::get('/delete/{id}', 'BloodGroupsController@delete');
});
//out_patient
Route::group([
    'prefix' => 'out_patients',
    'namespace'=>'App\Http\Controllers',
] , function (){
    Route::get('/', 'OutPatientsController@index');
    Route::get('/data', 'OutPatientsController@getData')->name('out_patient.data');
    Route::get('/select', 'OutPatientsController@select');

    Route::get('/edit/{id}', 'OutPatientsController@edit')->name('out_patients.edit');
    Route::get('/create/{is_exist}', 'OutPatientsController@create')->name('out_patients.create');
    Route::post('/', [\App\Http\Controllers\OutPatientsController::class, 'store'])->name('outpatient.store');
    Route::post('/store_exist', [\App\Http\Controllers\OutPatientsController::class, 'store_exist'])->name('outpatient.store_exist');
    Route::get('/{id}', 'OutPatientsController@getOne');
    Route::put('/update/{id}', 'OutPatientsController@update')->name('out_patients.update');
    Route::get('/delete/{id}', 'OutPatientsController@destroy')->name('out_patients.delete');
    Route::get('post/delete',[\App\Http\Controllers\OutPatientsController::class,'deleteAll'])->name('outpatient.delete.all');
});
// visits
Route::group([
    'prefix' => 'visits',
    'namespace'=>'App\Http\Controllers',
] , function (){
    Route::get('/', 'VisitController@index');
    Route::get('/data', 'VisitController@getData')->name('visit.data');
    Route::get('/select', 'VisitController@select');

    Route::get('/edit/{id}', 'VisitController@edit');
    Route::get('/create', 'VisitController@create');
    Route::post('/', 'VisitController@store');
    Route::get('/{id}', 'VisitController@getOne');
    Route::put('/update/{id}', 'VisitController@update');
    Route::get('/delete/{id}', 'VisitController@delete');
});
//doctors
Route::group([
    'prefix' => 'doctors',
    'namespace'=>'App\Http\Controllers',
] , function (){
    Route::get('/select', 'DoctorsController@getData')->name('doctor.data');
});

Route::group([
    'prefix' => 'doctors',
    'namespace'=>'App\Http\Controllers',
] , function (){
    Route::get('/select', 'DoctorsController@select')->name('doctor.data');
});

Route::group([
    'prefix' => 'clinics',
    'namespace'=>'App\Http\Controllers',
] , function (){
    Route::get('/select', 'ClinicsController@select')->name('clinics.data');
});
//diseases
Route::group([
    'prefix' => 'diseases',
    'namespace'=>'App\Http\Controllers',
] , function (){
    Route::get('/select', 'DiseasesController@select')->name('diseases.data');
});

//Scan Units
Route::group([
    'prefix' => 'scan_units',
    'namespace'=>'App\Http\Controllers',
] , function (){
    Route::get('/', 'ScanUnitsController@index');
    Route::get('/data', 'ScanUnitsController@getData')->name('scan.unit.data');
    Route::get('/select', 'ScanUnitsController@select');
    Route::get('/edit/{id}', 'ScanUnitsController@edit');
    Route::get('/create', 'ScanUnitsController@create');
    Route::post('/', 'ScanUnitsController@store');
    Route::get('/{id}', 'ScanUnitsController@getOne');
    Route::put('/update/{id}', 'ScanUnitsController@update');
    Route::get('/delete/{id}', 'ScanUnitsController@delete');
});





//body_parts
Route::group([
    'prefix' => 'body_parts',
    'namespace'=>'App\Http\Controllers',
] , function (){
    Route::get('/', 'BodyPartController@index');
    Route::get('/data', 'BodyPartController@getData')->name('body.part.data');
    Route::get('/select', 'BodyPartController@select');
    Route::get('/edit/{id}', 'BodyPartController@edit');
    Route::get('/create', 'BodyPartController@create');
    Route::post('/', 'BodyPartController@store');
    Route::get('/{id}', 'BodyPartController@getOne');
    Route::put('/update/{id}', 'BodyPartController@update');
    Route::get('/delete/{id}', 'BodyPartController@delete');
});


//scan_requests

Route::group([
    'prefix' => 'scan_requests',
    'namespace'=>'App\Http\Controllers',
] , function (){
    Route::get('/', 'ScanRequestsController@index');
    Route::get('/data', 'ScanRequestsController@getData')->name('scan.request.data');

    Route::get('/edit/{id}', 'ScanRequestsController@edit');
    Route::get('/create', 'ScanRequestsController@create');
    Route::post('/', 'ScanRequestsController@store');
    Route::get('/{id}', 'ScanRequestsController@getOne');
    Route::put('/update/{id}', 'ScanRequestsController@update');
    Route::get('/delete/{id}', 'ScanRequestsController@delete');
});


//Drug Forms
Route::group([
    'prefix' => 'drug_forms',
    'namespace'=>'App\Http\Controllers',
] , function (){
    Route::get('/', 'DrugFormsController@index');
    Route::get('/data', 'DrugFormsController@getData')->name('drug_form.data');
    Route::get('/edit/{id}', 'DrugFormsController@edit');
    Route::get('/select', 'DrugFormsController@select');
    Route::get('/create', 'DrugFormsController@create');
    Route::post('/', 'DrugFormsController@store');
    Route::get('/{id}', 'DrugFormsController@getOne');
    Route::put('/update/{id}', 'DrugFormsController@update');
    Route::get('/delete/{id}', 'DrugFormsController@delete');
});

//prescuiption Request

Route::group([
    'prefix' => 'prescuiption_reqs',
    'namespace'=>'App\Http\Controllers',
] , function (){
    Route::get('/','PrescuiptionReqsController@index');
    Route::get('/data', 'PrescuiptionReqsController@getData')->name('pre_req.data');
    Route::get('/edit/{id}','PrescuiptionReqsController@edit');
    Route::get('/create','PrescuiptionReqsController@create');
    Route::post('/','PrescuiptionReqsController@store');
    Route::get('/{id}','PrescuiptionReqsController@getOne');
    Route::put('/update/{id}','PrescuiptionReqsController@update');
    Route::get('/delete/{id}','PrescuiptionReqsController@delete');
});

//Addmission Note
Route::group([
    'prefix' => 'addmission_notes',
    'namespace'=>'App\Http\Controllers',
] , function (){
    Route::get('/','AddmissionNotesController@index');
    Route::get('/data', 'AddmissionNotesController@getData')->name('addmission_note.data');
    Route::get('/edit/{id}','AddmissionNotesController@edit');
    Route::get('/create','AddmissionNotesController@create');
    Route::post('/','AddmissionNotesController@store');
    Route::get('/{id}','AddmissionNotesController@getOne');
    Route::put('/update/{id}','AddmissionNotesController@update');
    Route::get('/delete/{id}','AddmissionNotesController@delete');
});


//Analaysis Categories
Route::group([
    'prefix' => 'analaysis_categories',
    'namespace'=>'App\Http\Controllers',
] , function (){
    Route::get('/', 'AnalaysisCategoriesController@index');
    Route::get('/data', 'AnalaysisCategoriesController@getData')->name('analysis.category.data');
    Route::get('/select', 'AnalaysisCategoriesController@select');
    Route::get('/edit/{id}', 'AnalaysisCategoriesController@edit');
    Route::get('/create', 'AnalaysisCategoriesController@create');
    Route::post('/', 'AnalaysisCategoriesController@store');
    Route::get('/{id}', 'AnalaysisCategoriesController@getOne');
    Route::put('/update/{id}', 'AnalaysisCategoriesController@update');
    Route::get('/delete/{id}', 'AnalaysisCategoriesController@delete');
});


//Analaysis Reqs
Route::group([
    'prefix' => 'analaysis_reqs',
    'namespace'=>'App\Http\Controllers',
] , function (){
    Route::get('/', 'AnalaysisReqsController@index');
    Route::get('/data', 'AnalaysisReqsController@getData')->name('analaysis.req.data');
    Route::get('/select', 'AnalaysisReqsController@select');
    Route::get('/edit/{id}', 'AnalaysisReqsController@edit');
    Route::get('/create', 'AnalaysisReqsController@create');
    Route::post('/', 'AnalaysisReqsController@store');
    Route::get('/{id}', 'AnalaysisReqsController@getOne');
    Route::put('/update/{id}', 'AnalaysisReqsController@update');
    Route::get('/delete/{id}', 'AnalaysisReqsController@delete');
});

Route::group([
    'prefix' => 'frameworks',
    'namespace'=>'App\Http\Controllers',
] , function (){

Route::get('frameworks','FrameworkController@index');
Route::post('frameworks','FrameworkController@store')->name('frameworks.store');
});





//scan_requests

Route::group([
    'prefix' => 'scan_requests',
    'namespace'=>'App\Http\Controllers',
] , function (){
    Route::get('/', 'ScanRequestsController@index');
    Route::get('/data', 'ScanRequestsController@getData')->name('scan.request.data');

    Route::get('/edit/{id}', 'ScanRequestsController@edit');
    Route::get('/create', 'ScanRequestsController@create');
    Route::post('/', 'ScanRequestsController@store');
    Route::get('/{id}', 'ScanRequestsController@getOne');
    Route::put('/update/{id}', 'ScanRequestsController@update');
    Route::get('/delete/{id}', 'ScanRequestsController@delete');
});




// switch_to_clinics
Route::group([
    'prefix' => 'switch_to_clinics',
    'namespace'=>'App\Http\Controllers',
] , function (){
    Route::get('/', 'SwitchToClinicsController@index');
    Route::get('/data', 'SwitchToClinicsController@getData')->name('switch.data');
    Route::get('/select', 'SwitchToClinicsController@select');

    Route::get('/edit/{id}', 'SwitchToClinicsController@edit');
    Route::get('/create', 'SwitchToClinicsController@create');
    Route::post('/', 'SwitchToClinicsController@store');
    Route::get('/{id}', 'SwitchToClinicsController@getOne');
    Route::put('/update/{id}', 'SwitchToClinicsController@update');
    Route::get('/delete/{id}', 'SwitchToClinicsController@destroy');
});


