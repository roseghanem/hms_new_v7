<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DepartmentsController;
use App\Http\Controllers\ClinicsController;
use App\Http\Controllers\PatientsController;
use App\Http\Controllers\CarsController;
use App\Http\Controllers\PatientDepartmentIntrancesController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\InventoryTypesController;
use App\Http\Controllers\InventoryLocationsController;
use App\Http\Controllers\CarTypesController;
use App\Http\Controllers\CarTaskTypesController;
use App\Http\Controllers\DriversController;
use App\Http\Controllers\CarTasksController;
use App\Http\Controllers\CarFixsController;
use App\Http\Controllers\CarAccidentsController;
use App\Http\Controllers\CarDelliveriesController;
use App\Http\Controllers\ParkShiftsController;
use App\Http\Controllers\EmployeeTypesController;
use App\Http\Controllers\CarDelliveryTypesController;
use App\Http\Controllers\ComiteeTypesController;
use App\Http\Controllers\ComiteesController;
use App\Http\Controllers\CarInsurancesController;
use App\Http\Controllers\CarFixTypesController;
use App\Http\Controllers\OilChangesController;
use App\Http\Controllers\DivisionsController;
use App\Http\Controllers\AcceptanceTypesController;
use App\Http\Controllers\DoctorsController;
use App\Http\Controllers\InternalIntrancesController;
use App\Http\Controllers\DiseasesController;
use App\Http\Controllers\BedsController;
use App\Http\Controllers\RoomsController;
use App\Http\Controllers\MedicineCommercialFormsController;
use App\Http\Controllers\PharmacyNotificationsController;
use App\Http\Controllers\ParmacyCompaniesController;
use App\Http\Controllers\MedicineSourcesController;
use App\Http\Controllers\MedicinesController;
use App\Http\Controllers\MedicineLotsController;
use App\Http\Controllers\MedicineStoragesController;
use App\Http\Controllers\MedicineOutDestinationsController;
use App\Http\Controllers\MedicineOutTypesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [UserController::class,'register']);
Route::post('/login', [UserController::class,'login']);
//Beds:
Route::post('/bed/show/{id}',[BedsController::class, 'show']);
Route::post('/bed/index', [BedsController::class,'index']);
Route::post('/bed/create', [BedsController::class,'store']);
Route::delete('/bed/delete/{id}', [BedsController::class,'destroy']);
Route::put('/bed/update/{id}', [BedsController::class,'update']);
//Rooms:
Route::post('/room/show/{id}',[RoomsController::class, 'show']);
Route::post('/room/index', [RoomsController::class,'index']);
Route::post('/room/create', [RoomsController::class,'store']);
Route::delete('/room/delete/{id}', [RoomsController::class,'destroy']);
Route::put('/room/update/{id}', [RoomsController::class,'update']);




//Department:
Route::post('/department', [DepartmentsController::class,'store']);
Route::post('/department/show/{id}', [DepartmentsController::class,'show']);
//Patients:
Route::post('/patient/show/{id}',[PatientsController::class, 'show']);
Route::post('/patient/index', [PatientsController::class,'index']);
Route::post('/patient/create', [PatientsController::class,'store']);
Route::delete('/patient/delete/{id}', [PatientsController::class,'destroy']);
Route::put('/patient/update/{id}', [PatientsController::class,'update']);
Route::post('/patient/searchByNationalNumber', [PatientsController::class,'searchByNationalNumber']);
Route::post('/patient/searchByName', [PatientsController::class,'searchByName']);
Route::post('/patient/searchByHospitalNumber', [PatientsController::class,'searchByHospitalNumber']);
//InternalIntrances:
Route::post('/internal-intrance/show/{id}',[InternalIntrancesController::class, 'show']);
Route::post('/internal-intrance/index', [InternalIntrancesController::class,'index']);
Route::post('/internal-intrance/create', [InternalIntrancesController::class,'store']);
Route::delete('/internal-intrance/delete/{id}', [InternalIntrancesController::class,'destroy']);
Route::put('/internal-intrance/update/{id}', [InternalIntrancesController::class,'update']);
//Doctors :
Route::post('/doctor/show/{id}',[DoctorsController::class, 'show']);
Route::post('/doctor/index', [DoctorsController::class,'index']);
Route::post('/doctor/create', [DoctorsController::class,'store']);
Route::delete('/doctor/delete/{id}', [DoctorsController::class,'destroy']);
Route::put('/doctor/update/{id}', [DoctorsController::class,'update']);

//Departments:
Route::post('/department/show/{id}',[DepartmentsController::class, 'show']);
Route::post('/department/index', [DepartmentsController::class,'index']);
Route::post('/department/create', [DepartmentsController::class,'store']);
Route::delete('/department/delete/{id}', [DepartmentsController::class,'destroy']);
Route::put('/department/update/{id}', [DepartmentsController::class,'update']);

//Clinincs:

Route::post('/clinic/show/{id}',[ClinicsController::class, 'show']);
Route::post('/clinic/index', [ClinicsController::class,'index']);
Route::post('/clinic/create', [ClinicsController::class,'store']);
Route::delete('/clinic/delete/{id}', [ClinicsController::class,'destroy']);
Route::put('/clinic/update/{id}', [ClinicsController::class,'update']);


//Users:
Route::post('/user/show/{id}',[UserController::class, 'show']);
Route::post('/user/index', [UserController::class,'index']);
Route::post('/user/create', [UserController::class,'store']);
Route::delete('/user/delete/{id}', [UserController::class,'destroy']);
Route::put('/user/update/{id}', [UserController::class,'update']);


//PatientDepartmentIntrances:
Route::post('/pdi/show/{id}',[PatientDepartmentIntrancesController::class, 'show']);
Route::post('/pdi/index', [PatientDepartmentIntrancesController::class,'index']);
Route::post('/pdi/create', [PatientDepartmentIntrancesController::class,'store']);
Route::delete('/pdi/delete/{id}', [PatientDepartmentIntrancesController::class,'destroy']);
Route::put('/pdi/update/{id}', [PatientDepartmentIntrancesController::class,'update']);

Route::post('/pdi/searchByNumber', [PatientDepartmentIntrancesController::class,'searchByNumber']);
Route::post('/pdi/searchByName', [PatientDepartmentIntrancesController::class,'searchByName']);
Route::post('/pdi/searchByDate', [PatientDepartmentIntrancesController::class,'searchByDate']);

//Division:
Route::post('/division/show/{id}',[DivisionsController::class, 'show']);
Route::post('/division/index', [DivisionsController::class,'index']);
Route::post('/division/create', [DivisionsController::class,'store']);
Route::delete('/division/delete/{id}', [DivisionsController::class,'destroy']);
Route::put('/division/update/{id}', [DivisionsController::class,'update']);

//Diseases:
Route::post('/disease/show/{id}',[DiseasesController::class, 'show']);
Route::post('/disease/index', [DiseasesController::class,'index']);
Route::post('/disease/create', [DiseasesController::class,'store']);
Route::delete('/disease/delete/{id}', [DiseasesController::class,'destroy']);
Route::put('/disease/update/{id}', [DiseasesController::class,'update']);




//Users:
Route::post('/role/show/{id}',[RolesController::class, 'show']);
Route::post('/role/index', [RolesController::class,'index']);
Route::post('/role/create', [RolesController::class,'store']);
Route::delete('/role/delete/{id}', [RolesController::class,'destroy']);
Route::put('/role/update/{id}', [RolesController::class,'update']);

//Indexes:

//InventoryLocations
Route::post('/inv-loc/show/{id}',[InventoryLocationsController::class, 'show']);
Route::post('/inv-loc/index', [InventoryLocationsController::class,'index']);

//InventoryTypes
Route::post('/inv-type/show/{id}',[InventoryTypesController::class, 'show']);
Route::post('/inv-type/index', [InventoryTypesController::class,'index']);
//AcceptanceTypes
Route::post('/acc-type/show/{id}',[AcceptanceTypesController::class, 'show']);
Route::post('/acc-type/index', [AcceptanceTypesController::class,'index']);


//////////////////////المرآب//////////////////////
//Cars:
Route::post('/cars/create', [CarsController::class,'store']);
Route::post('/cars/index', [CarsController::class,'index']);
Route::post('/cars/show/{id}', [CarsController::class,'show']);
Route::delete('/cars/delete/{id}', [CarsController::class,'destroy']);
Route::post('/cars/update/{id}', [CarsController::class,'update']);
//CarTypes
Route::post('/car_type/index', [CarTypesController::class,'index']);
Route::post('/car_type/show/{id}', [CarTypesController::class,'show']);
//CarTaskTypes
Route::post('/car_task_type/index', [CarTaskTypesController::class,'index']);
Route::post('/car_task_type/show/{id}', [CarTaskTypesController::class,'show']);
//Driver

Route::post('/driver/create', [DriversController::class,'store']);
Route::post('/driver/index', [DriversController::class,'index']);
Route::post('/driver/show/{id}', [DriversController::class,'show']);
Route::delete('/driver/delete/{id}', [DriversController::class,'destroy']);
Route::post('/driver/update/{id}', [DriversController::class,'update']);

//Car Tasks:

Route::post('/car_task/create', [CarTasksController::class,'store']);
Route::post('/car_task/index', [CarTasksController::class,'index']);
Route::post('/car_task/show/{id}', [CarTasksController::class,'show']);
Route::delete('/car_task/delete/{id}', [CarTasksController::class,'destroy']);
Route::post('/car_task/update/{id}', [CarTasksController::class,'update']);



//Car Fix:

Route::post('/car_fix/create', [CarFixsController::class,'store']);
Route::post('/car_fix/index', [CarFixsController::class,'index']);
Route::post('/car_fix/show/{id}', [CarFixsController::class,'show']);
Route::delete('/car_fix/delete/{id}', [CarFixsController::class,'destroy']);
Route::post('/car_fix/update/{id}', [CarFixsController::class,'update']);



//Car Accident:

Route::post('/car_accident/create', [CarAccidentsController::class,'store']);
Route::post('/car_accident/index', [CarAccidentsController::class,'index']);
Route::post('/car_accident/show/{id}', [CarAccidentsController::class,'show']);
Route::delete('/car_accident/delete/{id}', [CarAccidentsController::class,'destroy']);
Route::post('/car_accident/update/{id}', [CarAccidentsController::class,'update']);

//Car Accident:

Route::post('/car_dellivery/create', [CarDelliveriesController::class,'store']);
Route::post('/car_dellivery/index', [CarDelliveriesController::class,'index']);
Route::post('/car_dellivery/show/{id}', [CarDelliveriesController::class,'show']);
Route::delete('/car_dellivery/delete/{id}', [CarDelliveriesController::class,'destroy']);
Route::post('/car_dellivery/update/{id}', [CarDelliveriesController::class,'update']);

//Park Shifts:

Route::post('/ParkShifts/index', [ParkShiftsController::class,'index']);
Route::post('/ParkShifts/show/{id}', [ParkShiftsController::class,'show']);


//Park Shifts:

Route::post('/car_fix_type/index', [CarFixTypesController::class,'index']);
Route::post('/car_fix_type/show/{id}', [CarFixTypesController::class,'show']);


//Employee Type:
Route::post('/emp-type/index', [EmployeeTypesController::class,'index']);
Route::post('/emp-type/show/{id}', [EmployeeTypesController::class,'show']);
//Car Dellivery Type:
Route::post('/car-dev-type/index', [CarDelliveryTypesController::class,'index']);
Route::post('/car-dev-type/show/{id}', [CarDelliveryTypesController::class,'show']);
//Comittee Type:
Route::post('/comitee-type/index', [ComiteeTypesController::class,'index']);
Route::post('/comitee-type/show/{id}', [ComiteeTypesController::class,'show']);
//Comitee:

Route::post('/comitee/create', [ComiteesController::class,'store']);
Route::post('/comitee/index', [ComiteesController::class,'index']);
Route::post('/comitee/show/{id}', [ComiteesController::class,'show']);
Route::delete('/comitee/delete/{id}', [ComiteesController::class,'destroy']);
Route::put('/comitee/update/{id}', [ComiteesController::class,'update']);

//Comitee:

Route::post('/car_insurance/create', [CarInsurancesController::class,'store']);
Route::post('/car_insurance/index', [CarInsurancesController::class,'index']);
Route::post('/car_insurance/show/{id}', [CarInsurancesController::class,'show']);
Route::delete('/car_insurance/delete/{id}', [CarInsurancesController::class,'destroy']);
Route::put('/car_insurance/update/{id}', [CarInsurancesController::class,'update']);


//Oil  Change
Route::post('/oil_change/show/{id}',[OilChangesController::class, 'show']);
Route::post('/oil_change/index', [OilChangesController::class,'index']);
Route::post('/oil_change/create', [OilChangesController::class,'store']);
Route::delete('/oil_change/delete/{id}', [OilChangesController::class,'destroy']);
Route::post('/oil_change/update/{id}', [OilChangesController::class,'update']);




//Pharmacy All APIs:
//Medicine Commercial Forms
Route::post('/medicine_commercial_form/show/{id}',[MedicineCommercialFormsController::class, 'show']);
Route::post('/medicine_commercial_form/index', [MedicineCommercialFormsController::class,'index']);
Route::post('/medicine_commercial_form/create', [MedicineCommercialFormsController::class,'store']);
Route::delete('/medicine_commercial_form/delete/{id}', [MedicineCommercialFormsController::class,'destroy']);
Route::post('/medicine_commercial_form/update/{id}', [MedicineCommercialFormsController::class,'update']);

//Medicine Commercial Forms
Route::post('/pharmacy_notification/show/{id}',[PharmacyNotificationsController::class, 'show']);
Route::post('/pharmacy_notification/index', [PharmacyNotificationsController::class,'index']);
Route::delete('/pharmacy_notification/delete/{id}', [PharmacyNotificationsController::class,'destroy']);


//Parmacy Companies
Route::post('/pharmacy_company/show/{id}',[ParmacyCompaniesController::class, 'show']);
Route::post('/pharmacy_company/index', [ParmacyCompaniesController::class,'index']);
Route::post('/pharmacy_company/create', [ParmacyCompaniesController::class,'store']);
Route::delete('/pharmacy_company/delete/{id}', [ParmacyCompaniesController::class,'destroy']);
Route::post('/pharmacy_company/update/{id}', [ParmacyCompaniesController::class,'update']);

/*
//BloodGroup
Route::post('/blood_groups/create', [BloodGroupController::class,'store']);
Route::post('/blood_groups/index', [BloodGroupController::class,'index']);
Route::post('/blood_groups/show/{id}', [BloodGroupController::class,'show']);
Route::delete('/blood_groups/delete/{id}', [BloodGroupController::class,'destroy']);
Route::post('/blood_groups/update/{id}', [BloodGroupController::class,'update']);

//OutPatient:
Route::post('/outPatient/show/{id}',[OutPatientsController::class, 'show']);
Route::post('/outPatient/index', [OutPatientsController::class,'index']);
Route::post('/outPatientc/create', [OutPatientsController::class,'store']);
Route::delete('/outPatient/delete/{id}', [OutPatientsController::class,'destroy']);
Route::put('/outPatient/update/{id}', [OutPatientsController::class,'update']);


//Visit
Route::post('/visit/create', [VisitController::class,'store']);
Route::post('/visit/index', [VisitController::class,'index']);
Route::post('/visit/show/{id}', [VisitController::class,'show']);
Route::delete('/visit/delete/{id}', [VisitController::class,'destroy']);
Route::post('/visit/update/{id}', [VisitController::class,'update']);

//PartOfBody
//Route::post('/art_of/create', [PartOfBodyController::class,'store']);
//Route::post('/blood_groups/index', [PartOfBodyController::class,'index']);
//Route::post('/blood_groups/show/{id}', [PartOfBodyController::class,'show']);
//Route::delete('/blood_groups/delete/{id}', [PartOfBodyController::class,'destroy']);
//Route::post('/blood_groups/update/{id}', [PartOfBodyController::class,'update']);*/


//MedicineSources
Route::post('/medicine_source/show/{id}',[MedicineSourcesController::class, 'show']);
Route::post('/medicine_source/index', [MedicineSourcesController::class,'index']);
Route::post('/medicine_source/create', [MedicineSourcesController::class,'store']);
Route::delete('/medicine_source/delete/{id}', [MedicineSourcesController::class,'destroy']);
Route::post('/medicine_source/update/{id}', [MedicineSourcesController::class,'update']);


//Medicines
Route::post('/medicine/show/{id}',[MedicinesController::class, 'show']);
Route::post('/medicine/index', [MedicinesController::class,'index']);
Route::post('/medicine/create', [MedicinesController::class,'store']);
Route::delete('/medicine/delete/{id}', [MedicinesController::class,'destroy']);
Route::post('/medicine/update/{id}', [MedicinesController::class,'update']);

Route::post('/medicine/searchByArabicName', [MedicinesController::class,'searchByArabicName']);
Route::post('/medicine/searchByScientificName', [MedicinesController::class,'searchByScientificName']);


//Medicine Lots :
Route::post('/medicine_lot/show/{id}',[MedicineLotsController::class, 'show']);
Route::post('/medicine_lot/index', [MedicineLotsController::class,'index']);
Route::post('/medicine_lot/create', [MedicineLotsController::class,'store']);
Route::delete('/medicine_lot/delete/{id}', [MedicineLotsController::class,'destroy']);
Route::post('/medicine_lot/update/{id}', [MedicineLotsController::class,'update']);



//Medicine Storages
Route::post('/medicine_storage/show/{id}',[MedicineStoragesController::class, 'show']);
Route::post('/medicine_storage/index', [MedicineStoragesController::class,'index']);
Route::post('/medicine_storage/create', [MedicineStoragesController::class,'store']);
Route::delete('/medicine_storage/delete/{id}', [MedicineStoragesController::class,'destroy']);
Route::post('/medicine_storage/update/{id}', [MedicineStoragesController::class,'update']);


//Medicine Out Destinations
Route::post('/medicine_out_destination/show/{id}',[MedicineOutDestinationsController::class, 'show']);
Route::post('/medicine_out_destination/index', [MedicineOutDestinationsController::class,'index']);
Route::post('/medicine_out_destination/create', [MedicineOutDestinationsController::class,'store']);
Route::delete('/medicine_out_destination/delete/{id}', [MedicineOutDestinationsController::class,'destroy']);
Route::post('/medicine_out_destination/update/{id}', [MedicineOutDestinationsController::class,'update']);


//Medicine Out Types
Route::post('/medicine_out_type/show/{id}',[MedicineOutTypesController::class, 'show']);
Route::post('/medicine_out_type/index', [MedicineOutTypesController::class,'index']);



