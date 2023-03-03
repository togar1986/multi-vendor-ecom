<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController; 
use App\Http\Controllers\VendorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\ShippingAreaController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\VendorOrderController;
use App\Http\Controllers\Backend\ReturnController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\ActiveUserController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Middleware\RedirectIfAuthenticated;

  
use App\Http\Controllers\Backend\VendorProductController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\SiteSettingController;
use App\Http\Controllers\Backend\RoleController;

use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\ShopController;

use App\Http\Controllers\User\WishlistController; 
use App\Http\Controllers\User\CompareController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\StripeController;
use App\Http\Controllers\User\AllUserController;

use App\Http\Controllers\User\ReviewController;
 
/*
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
    return view('frontend.index');
});



Route::middleware(['auth'])->group(function() {

    //User Dashboard

Route::get('/dashboard', [UserController::class, 'UserDashboard'])->name('dashboard');

Route::post('/user/profile/store', [UserController::class, 'UserProfileStore'])->name('user.profile.store');

Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');

Route::post('/user/update/password', [UserController::class, 'UserUpdatePassword'])->name('user.update.password');


}); // Gorup Milldeware End





// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');



// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';





Route::middleware(['auth', 'role:admin'])->group(function () {


Route::controller(AdminController::class)->group(function(){

  

    //Admin Dashboard

    Route::get('/admin/dashboard', 'AdminDashboard')->name('admin.dashboard');

    Route::get('/admin/logout',  'AdminDestroy')->name('admin.logout');

    Route::get('/admin/profile',  'AdminProfile')->name('admin.profile');

    Route::post('/admin/profile/store',  'AdminProfileStore')->name('admin.profile.store');

    Route::get('/admin/change/password',  'AdminChangePassword')->name('admin.change.password');

    Route::post('/admin/update/password',  'AdminUpdatePassword')->name('update.password');



}); // Admin Controller End

});// Admin Milldeware End



// Admin Login Route

Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->middleware(RedirectIfAuthenticated::class);




Route::middleware(['auth', 'role:vendor'])->group(function () {

Route::controller(VendorController::class)->group(function(){

    //Vendor Dashboard

  Route::get('/vendor/dashboard',  'VendorDashboard')->name('vendor.dashobard');

   Route::get('/vendor/logout',  'VendorDestroy')->name('vendor.logout');

   Route::get('/vendor/profile',  'VendorProfile')->name('vendor.profile');

    Route::post('/vendor/profile/store',  'VendorProfileStore')->name('vendor.profile.store');

    Route::get('/vendor/change/password',  'VendorChangePassword')->name('vendor.change.password');

    Route::post('/vendor/update/password',  'VendorUpdatePassword')->name('vendor.update.password');



    Route::get('/become/vendor',  'BecomeVendor')->name('become.vendor');

Route::post('/vendor/register','VendorRegister')->name('vendor.register');



    }); // Vendor  Controller End





     // Vendor  Product All Route 
Route::controller(VendorProductController::class)->group(function(){
    Route::get('/vendor/all/product' , 'VendorAllProduct')->name('vendor.all.product');

    Route::get('/vendor/add/product' , 'VendorAddProduct')->name('vendor.add.product');

    Route::post('/vendor/store/product' , 'VendorStoreProduct')->name('vendor.store.product');
      Route::get('/vendor/edit/product/{id}' , 'VendorEditproduct')->name('vendor.edit.product');

      Route::post('/vendor/update/product' , 'VendorUpdateproduct')->name('vendor.update.product');

    Route::get('/vendor/delete/product/{id}' , 'VendorDeleteproduct')->name('vendor.delete.product');

    Route::get('/vendor/subcategory/ajax/{category_id}' , 'VendorGetSubCategory');

});  //Vendor Product Controller End


});//  Vendor Milldeware End





// Vendor Login Route

Route::get('/vendor/login', [VendorController::class, 'VendorLogin'])->name('vendor.login')->middleware(RedirectIfAuthenticated::class);




// Vendor Active and Inactive All Route 
Route::controller(AdminController::class)->group(function(){
Route::get('/inactive/vendor' , 'InactiveVendor')->name('inactive.vendor');
Route::get('/active/vendor' , 'ActiveVendor')->name('active.vendor');
Route::get('/inactive/vendor/details/{id}' , 'InactiveVendorDetails')->name('inactive.vendor.details');
Route::post('/active/vendor/approve' , 'ActiveVendorApprove')->name('active.vendor.approve');
Route::get('/active/vendor/details/{id}' , 'ActiveVendorDetails')->name('active.vendor.details');
Route::post('/inactive/vendor/approve' , 'InActiveVendorApprove')->name('inactive.vendor.approve');


}); // End Admin Controller




Route::middleware(['auth','role:admin'])->group(function() {

 // Brand All Route 
Route::controller(BrandController::class)->group(function(){
    Route::get('/all/brand' , 'AllBrand')->name('all.brand');
     Route::get('/add/brand' , 'AddBrand')->name('add.brand');
     Route::post('/store/brand' , 'StoreBrand')->name('store.brand');
      Route::get('/edit/brand/{id}' , 'EditBrand')->name('edit.brand');
      Route::post('/update/brand' , 'UpdateBrand')->name('update.brand');
       Route::get('/delete/brand/{id}' , 'DeleteBrand')->name('delete.brand');

}); // End Brand Controller



// Category All Route 
Route::controller(CategoryController::class)->group(function(){
    Route::get('/all/category' , 'AllCategory')->name('all.category');
    Route::get('/add/category' , 'AddCategory')->name('add.category');
    Route::post('/store/category' , 'StoreCategory')->name('store.category');
    Route::get('/edit/category/{id}' , 'EditCategory')->name('edit.category');
    Route::post('/update/category' , 'UpdateCategory')->name('update.category');
    Route::get('/delete/category/{id}' , 'DeleteCategory')->name('delete.category');

}); // End Category Controller



 // Sub Category All Route 
Route::controller(SubCategoryController::class)->group(function(){
    Route::get('/all/subcategory' , 'AllSubCategory')->name('all.subcategory');
   Route::get('/add/subcategory' , 'AddSubCategory')->name('add.subcategory');
    Route::post('/store/subcategory' , 'StoreSubCategory')->name('store.subcategory');
    Route::get('/edit/subcategory/{id}' , 'EditSubCategory')->name('edit.subcategory');
    Route::post('/update/subcategory' , 'UpdateSubCategory')->name('update.subcategory');
    Route::get('/delete/subcategory/{id}' , 'DeleteSubCategory')->name('delete.subcategory');

});// End SubCategory Controller



 // Product All Route 
Route::controller(ProductController::class)->group(function(){
    Route::get('/all/product' , 'AllProduct')->name('all.product');
    Route::get('/add/product' , 'AddProduct')->name('add.product');
    Route::post('/store/product' , 'StoreProduct')->name('store.product');
     Route::get('/edit/product/{id}' , 'EditProduct')->name('edit.product');
Route::post('/update/product' , 'UpdateProduct')->name('update.product');
Route::post('/update/product/thambnail' , 'UpdateProductThambnail')->name('update.product.thambnail');
 Route::post('/update/product/multiimage' , 'UpdateProductMultiimage')->name('update.product.multiimage');

 Route::get('/product/inactive/{id}' , 'ProductInactive')->name('product.inactive');
Route::get('/product/active/{id}' , 'ProductActive')->name('product.active');
 Route::get('/delete/product/{id}' , 'ProductDelete')->name('delete.product');

Route::get('/product/multiimg/delete/{id}' , 'MulitImageDelelte')->name('product.multiimg.delete');

Route::get('/subcategory/ajax/{category_id}' , 'GetSubCategory');

     

}); // End Product Controller



}); // End Admin Middleware 


