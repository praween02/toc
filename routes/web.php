<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{DashboardController, InstituteController, VendorController, UserController, RoleController, InstituteUserController, EquipmentSupplierController, VendorInstituteController, EquipmentController, CourseController, PocBsnlController, ProjectTimelineController, TicketController, AskExpertDetailController, EquipmentSpecificationController, PocBsnlUserController, ExpertUserControllerr, SixGUserController, ForgotController, TelecomController, TeamController, PaymentController, ParichayController, WorkshopController,SystemManualController};
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

//Route::get('/', function () {
//echo '<center>Bharat 5G Labs</center>';
//  return redirect()->route('login');
//});

Route::get('/uu/{id}', function ($id) {
    Auth::loginUsingId($id);
    return redirect()->route('dashboard');
});

Route::get('/', [ParichayController::class, 'handshake'])->name('parichay.handshake');
Route::post('logout', [ParichayController::class, 'logout'])->name('logout');

Route::get('forgot-pwd', [ForgotController::class, 'index'])->name('forgot.index');
Route::post('forgot-pwd', [ForgotController::class, 'store'])->name('password.forgot.mobile');


Route::get('/workshop', [WorkshopController::class, 'workshop'])->name('workshop');
Route::post('/workshop', [WorkshopController::class, 'workshopJoin'])->name('workshop.join');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'validate.parichay',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/workshops', [DashboardController::class, 'workshops'])->name('admin.workshop');

    Route::get('telecom-project-dashboard', [TelecomController::class, 'dashboard'])->name('telecom.dashboard');

    Route::get('/enable-edit/{id}', [SixGUserController::class, 'enableEdit'])->name('sixg.enable_edit');

    Route::get('/future-tech-experts', [DashboardController::class, 'futureTechExperts'])->name('future-tech-experts');
    Route::get('/future-tech-experts/{id}', [DashboardController::class, 'futureTechExpertsSummary'])->name('future-tech-expert-summary');



    Route::get('/6g-research-proposals', [DashboardController::class, 'sixGResearchProposals'])->name('6g-research-proposals');
    Route::get('/6g-research-proposal-summary/{id}', [DashboardController::class, 'sixGResearchProposalSummary'])->name('6g-research-proposal-summary');


    Route::get('/experts/status/{id}', [SixGUserController::class, 'experts_status'])->name('experts.status');


    Route::resources([
        'institutes' => InstituteController::class,
        'vendors' => VendorController::class,
        'users' => UserController::class,
        'roles' => RoleController::class,
        'institute_users' => InstituteUserController::class,
        'equipment_suppliers' => EquipmentSupplierController::class,
        'vendor_institutes' => VendorInstituteController::class,
        'equipments' => EquipmentController::class,
        'courses' => CourseController::class,
        'tickets' => TicketController::class,
        'ask_expert' => AskExpertDetailController::class,
        'telecom' => TelecomController::class,
        'teams' => TeamController::class,
        'payments' => PaymentController::class,
    ]);

    Route::get('/vendor-institutes', [VendorInstituteController::class, 'vendorInstitutes'])->name('vendor.institutes');
    Route::get('/user/permission/{encryptedId}', [UserController::class, 'permission'])->name('user.permission');
    Route::put('/user/permission/{encryptedId}', [UserController::class, 'updatePermission'])->name('user.update_permission');
    Route::get('/lab_status', [DashboardController::class, 'lab_status'])->name('lab_status');
    Route::get('/assignment', [DashboardController::class, 'assignment'])->name('assignment');
    Route::post('/assignment', [DashboardController::class, 'assignment_store'])->name('assignment.store');

    Route::get('/projects-timeline', [ProjectTimelineController::class, 'projects_timeline'])->name('admin.projects_timeline');

    Route::get('/project-timeline', [ProjectTimelineController::class, 'create'])->name('project_timeline');
    Route::post('/project-timeline', [ProjectTimelineController::class, 'store'])->name('project_timeline.store');

    Route::get('/inst-project-timeline', [ProjectTimelineController::class, 'inst_create'])->name('inst_project_timeline');
    Route::post('/inst-project-timeline', [ProjectTimelineController::class, 'inst_store'])->name('inst_project_timeline.store');

    Route::get('/list-poc-bsnl', [PocBsnlController::class, 'index'])->name('poc_bsnl.index');
    Route::get('/view-detail-poc-bsnl', [PocBsnlController::class, 'show'])->name('poc_bsnl.show');

    Route::get('/application-form-poc-bsnl', [PocBsnlController::class, 'create'])->name('poc_bsnl')->middleware('validate.bsnl');
    Route::post('/application-form-poc-bsnl', [PocBsnlController::class, 'store'])->name('poc_bsnl.store')->middleware('validate.bsnl');



    /* POC BSNL USER */
    Route::get('/list-poc-bsnl-user', [PocBsnlUserController::class, 'index'])->name('poc_bsnl_user.index');
    Route::get('/view-detail-poc-bsnl-user', [PocBsnlUserController::class, 'show'])->name('poc_bsnl_user.show');

    Route::get('/application-form-poc-bsnl-user', [PocBsnlUserController::class, 'create'])->name('poc_bsnl_user');
    /*Route::post('/application-form-poc-bsnl-user', [PocBsnlUserController::class, 'store'])->name('poc_bsnl_user.store');*/
    /* POC BSNL USER */

    /* EXPERT USER */
    Route::get('/list-expert-user', [ExpertUserControllerr::class, 'index'])->name('expert_user.index');
    Route::get('/view-detail-expert-user', [ExpertUserControllerr::class, 'show'])->name('expert_user.show');
    Route::get('/application-form-expert-user', [ExpertUserControllerr::class, 'create'])->name('expert_user')->middleware('validate.expert');
    Route::post('/application-form-expert-user', [ExpertUserControllerr::class, 'store'])->name('expert_user.store')->middleware('validate.expert');

    Route::get('/nda', [ExpertUserControllerr::class, 'nda'])->name('expert.nda')->middleware('validate.nda');
    Route::post('/nda', [ExpertUserControllerr::class, 'nda_submit'])->name('expert.nda.submit')->middleware('validate.nda');
    Route::get('/nda-listing', [ExpertUserControllerr::class, 'nda_admin'])->name('expert.nda.admin');


    /* EXPERT USER */

    /* SIX G USER */


    Route::get('/assigned/experts', [SixGUserController::class, 'assigned_experts'])->name('assigned.experts');
    Route::get('/sixg-category', [SixGUserController::class, 'changeCategory'])->name('sixg.category');
    Route::get('/get_evaluation_reports', [SixGUserController::class, 'get_evaluation_reports'])->name('get_evaluation_reports');
    Route::post('/expert-based-on-activity', [SixGUserController::class, 'expert_based_on_activity'])->name('expert_based_on_activity');
    Route::get('/get-app-evaluation-criteria', [SixGUserController::class, 'application_evaluation_criteria'])->name('application_evaluation_criteria');
    Route::post('/app-evaluation-marks-criteria', [SixGUserController::class, 'application_evaluation_marks_criteria'])->name('application_evaluation_marks_criteria');
    Route::post('/assigned-application-expert', [SixGUserController::class, 'assigned_application_expert'])->name('assigned_application_expert');
    Route::get('/expert-assigned-application', [ExpertUserControllerr::class, 'expert_user_assigned'])->name('expert_user_assigned');
    Route::get('/get-app-evaluation-criteria', [SixGUserController::class, 'application_evaluation_criteria'])->name('application_evaluation_criteria');
    Route::post('/app-evaluation-marks-criteria', [SixGUserController::class, 'application_evaluation_marks_criteria'])->name('application_evaluation_marks_criteria');
    Route::get('/get_evaluation_reports', [SixGUserController::class, 'get_evaluation_reports'])->name('get_evaluation_reports');


    Route::post('/application-form-expert-user-organization', [SixGUserController::class, 'organization'])->name('expert_user.organization');
    Route::post('/application-form-expert-user-collaborator', [SixGUserController::class, 'collaborator'])->name('expert_user.collaborator');
    Route::post('/application-form-expert-user-project-details', [SixGUserController::class, 'project_details'])->name('expert_user.project_details');
    Route::post('/application-form-expert-user-product-desc', [SixGUserController::class, 'product_desc'])->name('expert_user.product_desc');
    Route::post('/application-form-expert-user-project-plan', [SixGUserController::class, 'project_plan'])->name('expert_user.project_plan');
    Route::post('/application-form-expert-user-funding', [SixGUserController::class, 'funding'])->name('expert_user.funding');
    Route::post('/application-form-expert-user-regulatory', [SixGUserController::class, 'regulatory'])->name('expert_user.regulatory');

    Route::get('/applied-6g-application', [SixGUserController::class, 'index'])->name('six_g_user.index');
    Route::get('/view-applied-6g-application/{id}', [SixGUserController::class, 'show'])->name('six_g_user.show');

    Route::get('/application-form-6g-user', [SixGUserController::class, 'create'])->name('six_g_user')->middleware('validate.sixg');
    Route::post('/application-form-6g-user', [SixGUserController::class, 'store'])->name('six_g_user.store');

    Route::get('/states/{country_id}', [SixGUserController::class, 'states'])->name('six_g_user.states');
    Route::get('/cities/{state_id}', [SixGUserController::class, 'cities'])->name('six_g_user.cities');

    /* SIX G USER */





    Route::get('/get-equipment-filled-data', [ProjectTimelineController::class, 'get_prefilled_equipment_data'])->name('prefilled_equipment_data'); //not in use



    Route::post('/equipment_data', [ProjectTimelineController::class, 'equipment_data'])->name('equipment_data');
    Route::post('/inst-equipment_data', [ProjectTimelineController::class, 'inst_equipment_data'])->name('inst_equipment_data');



    Route::get('/equipment-specification/{id}', [EquipmentController::class, 'specification'])->name('equipment.specification');
    Route::post('/equipment-specification/{id}', [EquipmentController::class, 'update_specification'])->name('equipment.update_specification');

    Route::get('/institute/summary/{id}', [InstituteController::class, 'summary'])->name('institute.summary');

    Route::post('/check-equipments-project-timeline', [ProjectTimelineController::class, 'checkEquipmentsProjectTimeline'])->name('check-equipments-project-timeline');
    Route::post('/check-inst-equipments-project-timeline', [ProjectTimelineController::class, 'checkInstEquipmentsProjectTimeline'])->name('check-inst-equipments-project-timeline');


    Route::post('/update-equipment-specification/{equipment_id}', [EquipmentSpecificationController::class, 'update_specification'])->name('vendor-update-specification');


    Route::get('/get-scheduled-equipments', [ProjectTimelineController::class, 'getScheduledEquipments'])->name('get-scheduled-equipments');

    Route::post('/inst-update-scheduled-equipments', [ProjectTimelineController::class, 'updateSchedultEquipments'])->name('update-scheduled-equipment');


    Route::post('/update-dispatch-info', [ProjectTimelineController::class, 'updateDispatchInfo'])->name('update-dispatch-info');
    Route::post('/update-scheduled-equipment-action', [ProjectTimelineController::class, 'updateScheduledEquipmentAction'])->name('update-scheduled-equipment-action');
    Route::post('/update-scheduled-equipment-upload', [ProjectTimelineController::class, 'updateScheduledEquipmentUpload'])->name('update-scheduled-equipment-upload');
    /** Start System Manual */
    Route::get('/system-manual', [SystemManualController::class, 'index'])->name('system_manual.index');

    Route::get('/creare-system-manual', [SystemManualController::class, 'create'])->name('system_manual.create');
    Route::post('/creare-system-store', [SystemManualController::class, 'store'])->name('system_manual.store');
});
