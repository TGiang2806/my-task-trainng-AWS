<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Admin\Users\LoginController;
use \App\Http\Controllers\Admin\MainController;
use \App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserCustomerController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\Users\LogoutController;


use Illuminate\Http\Client\Request;
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

Route::get('admin/users/login', [LoginController:: class, 'index'])->name('login');
Route::post('admin/users/login/store', [LoginController:: class, 'store']);
Route::post('admin/users/login', [LogoutController::class, 'logout'])->name('logout');
Route::middleware(['auth'])->group(function (){
    Route::prefix('admin')->group(function (){
        Route::get('/', [MainController:: class, 'index'])->name('admin');
        Route::get('main', [MainController:: class, 'index'])->name('admin');
        //menu
        Route::prefix('menus')->group(function (){
            Route::group(['middleware' => ['role:Admin|Editor']], function () {Route::get('add', [MenuController::class, 'create']);
                Route::post('add', [MenuController::class, 'store']);
                Route::get('edit/{menu}',[MenuController::class,'show']);
                Route::post('edit/{menu}',[MenuController::class,'update']);
                });
                Route::get('list', [MenuController::class, 'index']);
                Route::DELETE('destroy',[MenuController::class,'destroy']);
        });
        //product
        Route::prefix('products')->group(function (){
            Route::group(['middleware' => ['role:Admin|Editor']], function () {
                Route::get('add', [ProductController::class, 'create']);
                Route::post('add', [ProductController::class, 'store']);
                Route::get('edit/{product}', [ProductController::class, 'show']);
                Route::post('edit/{product}', [ProductController::class, 'update']);
                Route::delete('destroy', [ProductController::class, 'destroy']);
                Route::get('/file-import',[ProductController::class,'importView'])->name('import-view');
                Route::post('/import-products',[ProductController::class,'importProducts'])->name('import-protducts');
                Route::get('/export-protducts',[ProductController::class,'exportProducts'])->name('export-protducts');
                });
                Route::get('list', [ProductController::class, 'index']);

        });
        #Upload
        Route::post('upload/services', [\App\Http\Controllers\Admin\UploadController::class, 'store']);
        //product
        Route::prefix('usercustomers')->group(function (){
            Route::group(['middleware' => ['auth','role:Admin']], function (){
                Route::get('add', [UserCustomerController::class, 'create']);
                Route::post('add', [UserCustomerController::class, 'store']);
                Route::get('list', [UserCustomerController::class, 'index']);
                Route::get('edit/{usercustomer}', [UserCustomerController::class, 'show']);
                Route::post('edit/{usercustomer}', [UserCustomerController::class, 'update']);
                Route::delete('destroy', [UserCustomerController::class, 'destroy']);
                Route::get('/file-import',[UserCustomerController::class,'importView'])->name('import-view');
                Route::post('/import-cus',[UserCustomerController::class,'importCus'])->name('import-cus');
                Route::get('/export-cus',[UserCustomerController::class,'exportCus'])->name('export-cus');
                });
        });
        Route:: prefix('users')->group(function (){
            Route::group(['middleware' => ['auth','role:Admin']], function (){
                Route::get('add', [UserController::class, 'create']);
                Route::post('add', [UserController::class, 'store']);
                Route::get('edit/{user}', [UserController::class, 'show']);
//                Route::post('edit/{user}', [UserController::class, 'update']);
                Route::post('edit/{user}', [UserController::class, 'update'])->name('users.update');

                Route::get('list', [UserController::class, 'index']);
                Route::delete('destroy', [UserController::class, 'destroy']);
                Route::get('/file-import',[UserController::class,'importView'])->name('import-view');
                Route::post('/import-user',[UserController::class,'importUser'])->name('import-user');
                Route::get('/export-user',[UserController::class,'exportUser'])->name('export-user');
                Route::get('/phan-quyen/{id}',[UserController::class,'phanquyen']);
                Route::post('/insert_roles/{id}',[UserController::class,'insert_roles']);
            });
        });


//        Authentication roles
//Route::group(['middleware'=>['auth']],function (){
//    Route::resource('/products', ProductController::class);
//    Route::resource('/users', UserController::class);
//    Route::resource('/usercustomers', UserCustomerController::class);
//    Route::resource('/menus', MenuController::class);
//
//
//});

    });
});

