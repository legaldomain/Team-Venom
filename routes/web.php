<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Backend\PropertyTypeController;
use App\Http\Controllers\Backend\PropertyController;



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

//Homepage frontend 
Route::get('/', [UserController::class, 'Index']);




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/user/profile', [UserController::class, 'UserProfile'])->name('user.profile');

    Route::post('/user/profile/store', [UserController::class, 'UserProfileStore'])->name('user.profile.store');

    Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');
    

});

require __DIR__.'/auth.php';


//admin group middleware start (protected)

Route::middleware(['auth','role:admin'])->group(function(){

 Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');

 Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');

 Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');


 Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');


}); //end grp adming middleware


//agent  group middleware start (protected)

Route::middleware(['auth','role:agent'])->group(function(){

Route::get('/agent/dashboard', [AgentController::class, 'AgentDashboard'])->name('agent.dashboard');

}); //end agent adming middleware



Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');




//admin group middleware start (protected)
//admin group middleware extend to property all

Route::middleware(['auth','role:admin'])->group(function(){

    
   
    Route::controller (PropertyTypeController::class) -> group(function(){


        Route::get('/all/type', 'AllType' )->name('all.type');
        Route::get('/add/type', 'AddType' )->name('add.type');
        Route::post('/store/type', 'StoreType' )->name('store.type');
        Route::get('/edit/type/{id}', 'EditType' )->name('edit.type');
        Route::post('/update/type', 'UpdateType' )->name('update.type');
        Route::get('/delete/type/{id}', 'DeleteType' )->name('delete.type');


        
        

    });

    //amenitie type router

    Route::controller (PropertyTypeController::class) -> group(function(){


        Route::get('/all/amenitie', 'AllAmenitie' )->name('all.amenitie');
        Route::get('/add/amenities', 'AddAmenitie' )->name('add.amenitie');
        Route::post('/store/type', 'StoreType' )->name('store.type');
        Route::get('/edit/type/{id}', 'EditType' )->name('edit.type');
        Route::post('/update/type', 'UpdateType' )->name('update.type');
        Route::get('/delete/type/{id}', 'DeleteType' )->name('delete.type');
   
   }); 


//prop all route 
   Route::controller (PropertyController::class) -> group(function(){


    Route::get('/all/property', 'AllProperty' )->name('all.property');
    Route::get('/add/property', 'AddProperty' )->name('add.property');
    Route::post('/store/property', 'StoreProperty' )->name('store.property');
   

}); 


   


});//end grp adming middleware