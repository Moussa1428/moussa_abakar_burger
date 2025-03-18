<?php

use App\Http\Controllers\Admincontroller;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\Clientcontroller;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\Usercontroller;
use Illuminate\Support\Facades\Route;


Route::get('/dashboard',[Admincontroller::class,'index'])->name('admin.index');
Route::get('/commandes', [Admincontroller::class, 'commandes'])->name('admin.commandes');
Route::get('/produits', [Admincontroller::class, 'produits'])->name('admin.produits');
Route::get('/stocks', [Admincontroller::class,'stocks'])->name('admin.stocks');
Route::get('/paiements', [Admincontroller::class, 'paiements'])->name('admin.paiements');
Route::get('/utilisateurs', [Admincontroller::class, 'utilisateurs'])->name('admin.utilisateurs');
Route::get('/parametres', [Admincontroller::class, 'parametres'])->name('admin.parametres');
Route::get('/utilisateurs/employees', [Admincontroller::class, 'employees'])->name('admin.gestionnaires');


Route::get('/', [Usercontroller::class, 'loginForm'])->name('login.form');
Route::get('/logout', [Usercontroller::class, 'logout'])->name('logout');
Route::post('/login', [Usercontroller::class, 'login'])->name('login');
Route::get('/register', [Usercontroller::class, 'register'])->name('register.form');
Route::post('/register/store', [Usercontroller::class, 'store'])->name('register.store');
Route::get('/profile', [Usercontroller::class, 'profile'])->name('profile');
Route::post('/profile/update', [Usercontroller::class, 'updateProfile'])->name('updateProfile');

Route::get('/index', [Clientcontroller::class, 'index'])->name('client.index');


Route::post('/admin/utilisateurs', [UserController::class, 'storeuser'])->name('adminstore.store');
Route::put('/admin/utilisateurs/{id}', [UserController::class, 'update'])->name('adminstore.update');
Route::delete('/admin/utilisateurs/{id}', [UserController::class, 'destroy'])->name('adminstore.destroy');



Route::get('/products/create', [ProductController::class, 'create'])->name('produits.create');
Route::post('/products/store', [ProductController::class, 'store'])->name('produits.store');
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('produits.destroy');
Route::get('/produits/filtres', [ProductController::class, 'filtered'])->name('produits.filtered');
Route::get('/products/{id}', [ProductController::class,'show'])->name('produits.show');
Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('produits.edit');
Route::put('/products/{id}', [ProductController::class, 'update'])->name('produits.update');


Route::get('/stocks/dynamic/{id}', [StockController::class,'index'])->name('stocks.index');
Route::post('/products/storestock', [ProductController::class, 'storestock'])->name('produits.storestock');
Route::get('/products/stocks/{id}/edit', [ProductController::class, 'editstock'])->name('produits.editstock');
Route::put('/products/stocks/{id}', [ProductController::class, 'updatestock'])->name('produits.updatestock');
Route::get('/products/stocks/{id}/view', [ProductController::class, 'viewstock'])->name('produits.viewstock');


Route::post('/categorie/store', [CategorieController::class, 'storecategorie'])->name('categorie.store');
Route::put('/categorie/{id}', [CategorieController::class, 'updatecategorie'])->name('categorie.update');
Route::delete('/categorie/{id}', [CategorieController::class, 'destroycategorie'])->name('categorie.destroy');
Route::get('/categorie/edit/{id}', [CategorieController::class, 'editcategorie'])->name('categorie.edit');


Route::post('/commandes', [CommandeController::class, 'store'])->name('commandes.store');
Route::get('/commandes/{commande}', [CommandeController::class, 'show'])->name('commandes.show');
Route::get('/commandes/client/{id}', [CommandeController::class, 'getByClient']);
Route::get('/commandes/details/{id}', [CommandeController::class, 'getDetails']);
Route::put('/commandes/{commande}', [CommandeController::class, 'update'])->name('commandes.update');




