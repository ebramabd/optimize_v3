<?php

use App\Http\Controllers\Companies\AuthController;
use App\Http\Controllers\Companies\CarFormController;
use App\Http\Controllers\Companies\IndexController;
use App\Http\Controllers\Companies\ServiceController;
use App\Http\Controllers\Companies\TermsController;
use App\Http\Controllers\Companies\WorkStagesController;
use App\Http\Controllers\Companies\ProfileController;
use App\Http\Controllers\Companies\CompanyBranchesController;
use App\Http\Controllers\Companies\SystemAdministratorController;
use App\Http\Controllers\Companies\SubscriptionController;
use App\Http\Controllers\Companies\ItemControllerforCompany;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ScreenController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------f
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [IndexController::class, 'welcome'])->name('welcome');

Route::get('test-send-car-ready', [TestController::class, 'sendCarReady']);
Route::get('test-service-agreement', [TestController::class, 'sendServiceAgreement']);
Route::get('test-delivery-note', [TestController::class, 'sendDeliveryNote']);

Route::prefix('companies')->group(function (){
    Route::get('/recover-password', [IndexController::class, 'recoverPassword'])->name('recover.password');
    Route::post('/recover-password', [IndexController::class, 'recoverPasswordPost'])->name('recover.password.post');
    Route::get('/transition', [IndexController::class, 'transition'])->name('transition');
    Route::get('/verification-code', [IndexController::class, 'verificationCode'])->name('verification.code');
    Route::get('/update-password/{id}', [IndexController::class, 'updatePasswordView'])->name('update.password.view');
    Route::post('/update-password', [IndexController::class, 'updatePassword'])->name('update.password');

    Route::post('/login', [AuthController::class, 'login_post'])->name('companies.login.post');
    Route::get('/authentication', [AuthController::class, 'authentication'])->name('companies.auth');
    Route::post('/register', [AuthController::class, 'register'])->name('companies.register');

    Route::group(['middleware' =>  ['auth.company']], function (){
        Route::post('/logout', [AuthController::class, 'logout'])->name('companies.logout');

        Route::prefix('subscriptions')->group(function(){
            Route::get('/', [SubscriptionController::class, 'index'])->name('companies.setting.subscriptions');
            Route::post('/subscription-post', [SubscriptionController::class, 'subscription_post'])->name('companies.setting.subscription_post');
        });

        // car form
        Route::group(['middleware' =>  ['subscription.company']], function (){
            Route::prefix('reports')->group(function (){// name route is prefix and name function
                Route::get('/products', [ItemControllerforCompany::class, 'index'])->name('companies.reports.products');
                Route::get('/get-items-by-brand', [ItemControllerforCompany::class, 'get_items_by_brand'])->name('companies.get-items-by-brand');
                Route::get('/get-brands-by-service', [ItemControllerforCompany::class, 'get_brands_by_service'])->name('companies.get-brands-by-service');
            });
            Route::get('/home', [IndexController::class, 'home'])->name('companies.home');

            Route::prefix('car-form')->group(function (){
                Route::get('/', [CarFormController::class, 'get_form'])->name('companies.car-form');
                Route::get('/get-administrators', [CarFormController::class, 'get_administrators'])->name('companies.get-administrators');
                Route::post('/save-process', [CarFormController::class, 'save_order'])->name('save.process');
            });

            //setting
            Route::group(['prefix' => 'setting'], function () {
                Route::get('/', [IndexController::class, 'setting'])->name('companies.setting');

                Route::prefix('terms')->group(function (){
                    Route::get('/', [TermsController::class, 'get_default_terms'])->name('companies.setting.terms');
                    Route::get('/add', [TermsController::class, 'add_condition'])->name('companies.setting.add_condition');
                    Route::post('/add-post', [TermsController::class, 'add_condition_post'])->name('companies.setting.add_condition_post');
                    Route::get('/edit/{id}', [TermsController::class, 'edit_terms'])->name('companies.setting.edit_terms');
                    Route::post('/edit-post/{id}', [TermsController::class, 'edit_post_terms'])->name('companies.setting.edit_post_terms');
                });

                Route::prefix('service')->group(function (){
                    Route::get('/', [ServiceController::class, 'get_default_service'])->name('companies.setting.service');
                    Route::get('/add', [ServiceController::class, 'addService'])->name('companies.setting.service.add');
                    Route::post('/add/{id?}', [ServiceController::class, 'add_post'])->name('companies.setting.service.add.post');
                    Route::get('/edit/{id}', [ServiceController::class, 'edit'])->name('companies.setting.service.edit');
                    Route::post('/delete-items', [ServiceController::class, 'delete_items'])->name('companies.setting.service.delete_items');
                    Route::post('/delete-brands', [ServiceController::class, 'delete_brands'])->name('companies.setting.service.delete_brands');
                    Route::get('/delete-service/{id}', [ServiceController::class, 'delete_service'])->name('companies.setting.service.delete_service');
                });

                Route::prefix('work-stages')->group(function (){
                    Route::get('/', [WorkStagesController::class, 'index'])->name('companies.work_stages');
                    Route::get('/completed', [WorkStagesController::class, 'showCompleted'])->name('companies.work_stages.completed');
                    Route::get('/print-completed/{id}', [WorkStagesController::class, 'showPrintCompleted'])->name('companies.work_stages.print_completed');
                    Route::get('/under-process/{id}', [WorkStagesController::class, 'showUnderProcess'])->name('companies.work_stages.under_process');
                    Route::get('/waiting-delivery/{id}', [WorkStagesController::class, 'showWaitingDelivery'])->name('companies.work_stages.waiting_delivery');
                    Route::post('/edit-order/{id}', [WorkStagesController::class, 'edit_order'])->name('companies.work_stages.edit_order');
                    Route::get('/delete-image/{id}', [WorkStagesController::class, 'delete_image'])->name('companies.work_stages.delete_image');
                    Route::get('/convert-to-delivery/{id}', [WorkStagesController::class, 'convert_to_delivery'])->name('companies.work_stages.convert_to_delivery');
                    Route::post('/convert-to-completed/{id}', [WorkStagesController::class, 'convert_to_completed'])->name('companies.work_stages.convert_to_completed');
                    Route::get('/get-brands', [WorkStagesController::class, 'get_brands'])->name('companies.work_stages.get_brands');
                    Route::get('/download-agreement/{id}', [WorkStagesController::class, 'downloadAgreement'])->name('download.agreement');
                    Route::get('/send-service-agreement/{id}', [WorkStagesController::class, 'send_service_agreement'])->name('send.service.agreement');
                });

                Route::prefix('profile')->group(function (){
                    Route::get('/', [ProfileController::class, 'index'])->name('companies.setting.profile');
                    Route::post('/profile-edit/{id}', [ProfileController::class, 'profile_edit'])->name('companies.setting.profile_edit');
                    Route::post('/update-profile-picture', [ProfileController::class, 'update_profile_picture'])->name('companies.setting.update_profile_picture');
                    Route::post('/update-password/{id}', [ProfileController::class, 'update_password'])->name('companies.setting.update_password');
                });

                Route::prefix('company-branches')->group(function (){
                    Route::get('/', [CompanyBranchesController::class, 'index'])->name('companies.setting.company_branches');
                    Route::get('/add', [CompanyBranchesController::class, 'addNewBranch'])->name('companies.setting.company.add.branch');
                    Route::post('/save', [CompanyBranchesController::class, 'save_branch'])->name('companies.setting.company.save.branch');
                    Route::get('/edit/{id}', [CompanyBranchesController::class, 'edit_branch'])->name('companies.setting.company.edit.branch');
                    Route::post('/update/{id}', [CompanyBranchesController::class, 'update'])->name('companies.setting.company.update.branch');
                    Route::get('/delete/{id}', [CompanyBranchesController::class, 'delete_branch'])->name('companies.setting.company.delete.branch');
                });

                Route::prefix('system-administrator')->group(function(){
                    Route::get('/', [SystemAdministratorController::class, 'index'])->name('companies.setting.administrator');
                    Route::get('/add', [SystemAdministratorController::class, 'addNewAdministrator'])->name('companies.setting.administrator.add');
                    Route::post('/save', [SystemAdministratorController::class, 'save_administrator'])->name('companies.setting.company.save.administrator');
                    Route::get('/edit/{id}', [SystemAdministratorController::class, 'edit_administrator'])->name('companies.setting.company.edit.administrator');
                    Route::post('/update/{id}', [SystemAdministratorController::class, 'update'])->name('companies.setting.company.update.administrator');
                    Route::get('/delete/{id}', [SystemAdministratorController::class, 'delete_administrator'])->name('companies.setting.company.delete.branch');

                });

                Route::get('/download-pdf/file-patternauto', function () {
                    $path = public_path().'/patternauto622.exe';
                    return response()->download($path);
                })->name('download.pdf.patternauto');
            });
        });
    });

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/lang/{locale}', function ($locale) {
    session(['locale' => $locale]);
    app()->setLocale($locale);
    return redirect()->back();
})->name('lang.switch');




Route::get('send-phone-code-auth-verification', [MessageController::class, 'sendPhoneCodeAuthVerification'])->name('phone-code-verification');
Route::post('verify-phone-code', [MessageController::class, 'verifyPhoneCode'])->name('verify-phone-code');

Route::post('send-phone-code-auth-verification-password', [MessageController::class, 'sendPhoneCodeAuthVerificationRecoverPassword'])->name('phone-code-verification-recover-password');
Route::post('verify-phone-code-password', [MessageController::class, 'verifyPhoneCodeRecoverPassword'])->name('verify-phone-code-recover-password');




