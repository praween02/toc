<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{DashboardController,InstituteController,VendorController,UserController,RoleController,InstituteUserController,EquipmentSupplierController,VendorInstituteController,EquipmentController,LabStatusController,ApplyFormController,PocBsnlController,ProjectTimelineController,TicketController,EquipmentSpecificationController};
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

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
	
	Route::get('/future-tech-experts', [DashboardController::class, 'futureTechExperts'])->name('future-tech-experts');
    Route::get('/future-tech-experts/{id}', [DashboardController::class, 'futureTechExpertsSummary'])->name('future-tech-expert-summary');
	
	
	Route::get('/6g-research-proposals', [DashboardController::class, 'sixGResearchProposals'])->name('6g-research-proposals');
    Route::get('/6g-research-proposal-summary/{id}', [DashboardController::class, 'sixGResearchProposalSummary'])->name('6g-research-proposal-summary');

    Route::resources([
                        'institutes' => InstituteController::class,
                        'vendors' => VendorController::class,
                        'users' => UserController::class,
                        'roles' => RoleController::class,
                        'institute_users' => InstituteUserController::class,
                        'equipment_suppliers' => EquipmentSupplierController::class,
                        'vendor_institutes' => VendorInstituteController::class,
                        'equipments' => EquipmentController::class,
						'lab_status'=> LabStatusController::class,
						'tickets' => TicketController::class,
                    ]);
    Route::get('/vendor-institutes', [VendorInstituteController::class, 'vendorInstitutes'])->name('vendor.institutes');
    Route::get('/user/permission/{encryptedId}', [UserController::class, 'permission'])->name('user.permission');
    Route::put('/user/permission/{encryptedId}', [UserController::class, 'updatePermission'])->name('user.update_permission');
    Route::get('/lab_status', [DashboardController::class, 'lab_status'])->name('lab_status');
    //Route::get('/assignment', [DashboardController::class, 'assignment'])->name('assignment');
    //Route::post('/assignment', [DashboardController::class, 'assignment_store'])->name('assignment.store');
	
	Route::get('/assignment', [DashboardController::class, 'assignment'])->name('assignment');
    Route::post('/assignment', [DashboardController::class, 'assignment_store'])->name('assignment.store');
    
	//Route::post('/apply-form', [ApplyFormController::class, 'store']);
    //Route::get('/apply-form', [ApplyFormController::class, 'index']);
	
	/*Route::post('/apply-form', [ApplyFormController::class, 'store'])->name('apply-form.store');
    Route::get('/apply-formdata', [ApplyFormController::class, 'index'])->name('apply-form.index');
    Route::get('/project-timeline', [ProjectTimelineController::class, 'index'])->name('project-timeline.index');
    Route::get('/apply-form', [ApplyFormController::class, 'display'])->name('apply-form.display');
    Route::get('/modal-form/{id}', [ApplyFormController::class, 'getdata'])->name('modal-form.getdata');
	
	Route::get('/project-timeline', [ProjectTimelineController::class, 'create'])->name('project_timeline');
    Route::post('/project-timeline', [ProjectTimelineController::class, 'store'])->name('project_timeline.store');
	
	
    Route::get('/application-form-poc-bsnl', [DashboardController::class, 'poc_bsnl'])->name('poc_bsnl');*/
	
	
	Route::get('/projects-timeline', [ProjectTimelineController::class, 'projects_timeline'])->name('admin.projects_timeline');

    Route::get('/project-timeline', [ProjectTimelineController::class, 'create'])->name('project_timeline');
    Route::post('/project-timeline', [ProjectTimelineController::class, 'store'])->name('project_timeline.store');

    Route::get('/inst-project-timeline', [ProjectTimelineController::class, 'inst_create'])->name('inst_project_timeline');
    Route::post('/inst-project-timeline', [ProjectTimelineController::class, 'inst_store'])->name('inst_project_timeline.store');

    Route::get('/list-poc-bsnl', [PocBsnlController::class, 'index'])->name('poc_bsnl.index');
    Route::get('/view-detail-poc-bsnl', [PocBsnlController::class, 'show'])->name('poc_bsnl.show');

    Route::get('/application-form-poc-bsnl', [PocBsnlController::class, 'create'])->name('poc_bsnl');
    Route::post('/application-form-poc-bsnl', [PocBsnlController::class, 'store'])->name('poc_bsnl.store');
	
	Route::get('/get-equipment-filled-data', [ProjectTimelineController::class, 'get_prefilled_equipment_data'])->name('prefilled_equipment_data');

    Route::get('/equipment-specification/{id}', [EquipmentController::class, 'specification'])->name('equipment.specification');
	
    Route::post('/equipment-specification/{id}', [EquipmentController::class, 'update_specification'])->name('equipment.update_specification');

    Route::get('/institute/summary/{id}', [InstituteController::class, 'summary'])->name('institute.summary');
	
	Route::post('/check-equipments-project-timeline', [ProjectTimelineController::class, 'checkEquipmentsProjectTimeline'])->name('check-equipments-project-timeline');
	
    Route::post('/check-inst-equipments-project-timeline', [ProjectTimelineController::class, 'checkInstEquipmentsProjectTimeline'])->name('check-inst-equipments-project-timeline');
	
	Route::post('/equipment_data', [ProjectTimelineController::class, 'equipment_data'])->name('equipment_data');
    Route::post('/inst-equipment_data', [ProjectTimelineController::class, 'inst_equipment_data'])->name('inst_equipment_data');
	
	
});
