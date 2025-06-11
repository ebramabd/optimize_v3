<?php

use App\Http\Controllers\Admin_panel\BankAccountController;
use App\Http\Controllers\Admin_panel\BrandController;
use App\Http\Controllers\Admin_panel\CompanyController;
use App\Http\Controllers\Admin_panel\ItemController;
use App\Http\Controllers\Admin_panel\ProcessServiceController;
use App\Http\Controllers\Admin_panel\ServiceController;
use App\Http\Controllers\Admin_panel\SubscriptionController;
use App\Http\Controllers\Admin_panel\TermsController;
use App\Http\Controllers\Admin_panel\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin-panel')->middleware(['auth', 'role:admin_panel'])->group(function (){
    Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

    Route::get('home' , function () {
        return  view('/admin_panel.index');
    })->name('admin_panel.home');

    Route::prefix('users')->group(function (){// name route is prefix and name function
        Route::get('/', [UserController::class, 'index'])->name('admin-panel.users.index');
        Route::get('/save/{id?}', [UserController::class, 'save'])->name('admin-panel.users.save');
        Route::post('/save/{id?}', [UserController::class, 'save_post'])->name('admin-panel.users.save_post');
        Route::get('/delete/{id?}', [UserController::class, 'delete'])->name('admin-panel.users.delete');
        Route::get('/details/{id?}', [UserController::class, 'details'])->name('admin-panel.users.details');
    });

    Route::prefix('companies')->group(function (){// name route is prefix and name function
        Route::get('/', [CompanyController::class, 'index'])->name('admin-panel.companies.index');
        Route::get('/save/{id?}', [CompanyController::class, 'save'])->name('admin-panel.companies.save');
        Route::post('/save/{id?}', [CompanyController::class, 'save_post'])->name('admin-panel.companies.save_post');
        Route::get('/delete/{id?}', [CompanyController::class, 'delete'])->name('admin-panel.companies.delete');
        Route::get('/details/{id?}', [CompanyController::class, 'details'])->name('admin-panel.companies.details');
        Route::post('/add-subscription', [CompanyController::class, 'add_subscription'])->name('admin-panel.companies.add_subscription');
    });

    Route::prefix('brands')->group(function (){// name route is prefix and name function
        Route::get('/', [BrandController::class, 'index'])->name('admin-panel.brands.index');
        Route::get('/save/{id?}', [BrandController::class, 'save'])->name('admin-panel.brands.save');
        Route::post('/save/{id?}', [BrandController::class, 'save_post'])->name('admin-panel.brands.save_post');
        Route::get('/delete/{id?}', [BrandController::class, 'delete'])->name('admin-panel.brands.delete');
        Route::get('/details/{id?}', [BrandController::class, 'details'])->name('admin-panel.brands.details');
    });

    Route::prefix('products')->group(function (){// name route is prefix and name function
        Route::get('/', [ItemController::class, 'index'])->name('admin-panel.items.index');
        Route::get('/save/{id?}', [ItemController::class, 'save'])->name('admin-panel.items.save');
        Route::post('/save/{id?}', [ItemController::class, 'save_post'])->name('admin-panel.items.save_post');
        Route::get('/delete/{id?}', [ItemController::class, 'delete'])->name('admin-panel.items.delete');
        Route::get('/details/{id?}', [ItemController::class, 'details'])->name('admin-panel.items.details');
    });

    Route::prefix('services')->group(function (){// name route is prefix and name function
        Route::get('/', [ServiceController::class, 'index'])->name('admin-panel.services.index');
        Route::get('/save/{id?}', [ServiceController::class, 'save'])->name('admin-panel.services.save');
        Route::post('/save/{id?}', [ServiceController::class, 'save_post'])->name('admin-panel.services.save_post');
        Route::get('/delete/{id?}', [ServiceController::class, 'delete'])->name('admin-panel.services.delete');
        Route::get('/details/{id?}', [ServiceController::class, 'details'])->name('admin-panel.services.details');
    });

    Route::prefix('subscriptions')->group(function (){// name route is prefix and name function
        Route::get('/', [SubscriptionController::class, 'index'])->name('admin-panel.subscriptions.index');
        Route::get('/save/{id?}', [SubscriptionController::class, 'save'])->name('admin-panel.subscriptions.save');
        Route::post('/save/{id?}', [SubscriptionController::class, 'save_post'])->name('admin-panel.subscriptions.save_post');
        Route::get('/delete/{id?}', [SubscriptionController::class, 'delete'])->name('admin-panel.subscriptions.delete');
        Route::get('/details/{id?}', [SubscriptionController::class, 'details'])->name('admin-panel.subscriptions.details');
        Route::get('/sub-companies', [SubscriptionController::class, 'get_subscriptions_companies'])->name('admin-panel.subscriptions.companies');
        Route::get('/sub-details/{id?}', [SubscriptionController::class, 'get_subscriptions_companies_details'])->name('admin-panel.subscriptions.companies.details');
        Route::post('/accept', [SubscriptionController::class, 'accept_request'])->name('admin-panel.subscriptions.accept_request');

    });

    Route::prefix('process-service')->group(function (){// name route is prefix and name function
        Route::get('/', [ProcessServiceController::class, 'index'])->name('admin-panel.process-service.index');
        Route::get('/save/{id?}', [ProcessServiceController::class, 'save'])->name('admin-panel.process-service.save');
        Route::post('/save/{id?}', [ProcessServiceController::class, 'save_post'])->name('admin-panel.process-service.save_post');
        Route::get('/get-administrators', [ProcessServiceController::class, 'get_administrators'])->name('get-administrators');
        Route::get('/delete/{id?}', [ProcessServiceController::class, 'delete'])->name('admin-panel.process-service.delete');
        Route::get('/details/{id?}', [ProcessServiceController::class, 'details'])->name('admin-panel.process-service.details');
        Route::get('/get-brands', [ProcessServiceController::class, 'get_brands'])->name('admin-panel.process-service.get_brands');

    });

    Route::prefix('terms')->group(function (){// name route is prefix and name function
        Route::get('/', [TermsController::class, 'index'])->name('admin-panel.terms.index');
        Route::get('/save/{id?}', [TermsController::class, 'save'])->name('admin-panel.terms.save');
        Route::post('/save/{id?}', [TermsController::class, 'save_post'])->name('admin-panel.terms.save_post');
        Route::get('/delete/{id?}', [TermsController::class, 'delete'])->name('admin-panel.terms.delete');
        Route::get('/details/{id?}', [TermsController::class, 'details'])->name('admin-panel.terms.details');
    });

    Route::prefix('bank-account')->group(function (){// name route is prefix and name function
        Route::get('/', [BankAccountController::class, 'index'])->name('admin-panel.bank.index');
        Route::post('/edit', [BankAccountController::class, 'edit'])->name('admin-panel.bank.edit');
    });

});
