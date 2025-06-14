<?php

use App\Http\Controllers\Admin\StorageController;
use App\Http\Controllers\Customer\ProfileController;
use App\Http\Controllers\SendMailController;
use Illuminate\Support\Facades\Route;

// Route::get('/spss/customer/visitor', function () {
//     return view('spss/customer/visitor');
// })->name('spss.customer.visitor');

Route::get('/spss/customer/visitor', [ProfileController::class, 'index'])->name('spss.customer.visitor');
Route::get('/', [ProfileController::class, 'index'])->name('home');


Route::post('/visitors/store', [ProfileController::class, 'store'])->name('visitor.store');
// Route::get('/spss/customer/confirmation', function () {
//     return view('/spss/customer/confirmation');
// })->name('spss.customer.confirmation');

Route::get('/spss/customer/confirmation/{profile}', [ProfileController::class, 'confirmation'])->name('spss.customer.confirmation');
Route::get('/spss/admin', [StorageController::class, 'index'])->name('spss.admin');

// Backend Routes
Route::get('/spss/admin/list', [StorageController::class, 'list'])->name('spss.admin.list');
Route::post('/spss/admin/visitor/store', [StorageController::class, 'store'])->name('spss.admin.visitor.store');
Route::post('/spss/admin/item/store', [StorageController::class, 'ItemStore'])->name('spss.admin.item.store');
Route::get('/spss/admin/item/mv/edit/{id}', [StorageController::class, 'getItemDescriptionView'])->name('spss.admin.item.mv.edit');
Route::get('/spss/admin/visitor/mv/get/{id}', [StorageController::class, 'getVisitorResultView'])->name('spss.admin.visitor.mv.get');
Route::get('/spss/admin/find', [StorageController::class, 'find'])->name('spss.admin.find');
Route::post('/spss/admin/find', [StorageController::class, 'get'])->name('spss.admin.get');
Route::delete('/spss/admin/visitor/delete/{id}',  [StorageController::class, 'deleteVisitor'])->name('spss.admin.visitor.delete');



// test email
Route::get('/send-mail', [SendMailController::class, 'index']);
