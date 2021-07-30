<?php


use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\ColorsController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\TaxController;
use App\Http\Controllers\Admin\CustomersController;
use App\Http\Controllers\Admin\HomeBannerController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductReviewController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Front\SellerController;
use App\Http\Controllers\LangController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
// 	return view('admin/login');
// });
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    // return what you want
});
//FRONT ROUTE SECTION START 
// Route::redirect('/','/en');
/*Route::group(['prefix' => '{locale}'], function(){
	Route::group(['middleware'=>'setLocale'], function(){
		Route::get('/', function ($locale) {
		    App::setLocale($localeLangController		});
		Route::get('/', [FrontController::class,'index']);
	});
});*/
// Route::get('lang/home', 'LangController@index');
// Route::get('lang/change', '@change')->name('changeLang');


Route::get('lang/change',[LangController::class,'change'])->name('change');

Route::get('/', [FrontController::class,'index']);
	Route::get('category/{id}', [FrontController::class,'category']);
	Route::get('product/{id}', [FrontController::class,'product']);
	Route::post('add_to_cart', [FrontController::class,'add_to_cart']);
	Route::get('carts', [FrontController::class,'carts']);
	Route::get('search/{str}',[FrontController::class,'search']);
	//Seller 
	Route::get('selleraccount',[SellerController::class,'index']);
	Route::post('selleraccount_process',[SellerController::class,'selleraccount_process'])->name('selleraccount.selleraccount_process');
	Route::get('/seller/verification/{id}',[SellerController::class,'email_verification']);
	//Seller 


	Route::get('registration',[FrontController::class,'registration']);
	Route::post('registration_process',[FrontController::class,'registration_process'])->name('registration.registration_process');
	Route::post('login_process',[FrontController::class,'login_process'])->name('login.login_process');

	Route::get('logout', function () {
		session()->forget('FRONT_USER_LOGIN');
		session()->forget('FRONT_USER_ID');
		session()->forget('FRONT_USER_NAME');
		session()->forget('FRONT_USER_EMAIL');
		session()->forget('FRONT_USER_MOBILE');
		session()->forget('USER_TEMP_ID');
		return redirect('/');
	});
	Route::get('/verification/{id}',[FrontController::class,'email_verification']);
	Route::post('forgot_password',[FrontController::class,'forgot_password']);
	Route::get('/forgot_password_change/{id}',[FrontController::class,'forgot_password_change']);
	
	Route::post('forgot_password_change_process',[FrontController::class,'forgot_password_change_process']);
	Route::get('Checkout', [FrontController::class,'Checkout']);
	Route::post('apply_coupon_code', [FrontController::class,'apply_coupon_code']);
	Route::post('remove_coupon_code', [FrontController::class,'remove_coupon_code']);
	Route::post('place_order', [FrontController::class,'place_order']);
	Route::get('/order_placed', [FrontController::class,'order_placed']);
	Route::get('instamojo_payment_redirect', [FrontController::class,'instamojo_payment_redirect']);
	Route::get('/order_fail',[FrontController::class,'order_fail']);
	Route::post('/product_review_process/',[FrontController::class,'product_review_process']);

	Route::group(['middleware'=>'user_auth'], function(){
		Route::get('/order',[FrontController::class,'order']);
		Route::get('/order_detail/{id}',[FrontController::class,'order_detail']);
		Route::get('/cancelorder/{id}',[FrontController::class,'cancelorder']);
		
	});

//FRONT ROUTE SECTION END


Route::get('admin', [AdminController::class,'index']);
Route::get('admin/updatepassword', [AdminController::class,'updatepassword']);
Route::post('admin/auth', [AdminController::class,'authentication'])->name('admin.auth');
Route::group(['middleware'=>'admin_auth'], function(){
Route::get('admin/dashboard', [AdminController::class,'dashboard']);
Route::get('admin/dashboard', [AdminController::class,'dashboard']);

//SELLER ACCOUNT VERIFY
Route::get('admin/verifyselleraccount', [AdminController::class,'verifyselleraccount']);
Route::get('admin/sellers/changeselleraccount/{id}/{data}', [AdminController::class,'changeselleraccount']);
Route::get('admin/selleraccount/delete/{id}', [AdminController::class,'delete']);
//SELLER ACCOUNT VERIFY

Route::get('admin/Orders', [OrderController::class,'index']);
Route::get('admin/order_detail/{id}', [OrderController::class,'order_detail']);
Route::get('admin/update_payment_status/{id}/{status}', [OrderController::class,'update_payment_status']);
Route::get('admin/update_order_status/{id}/{status}', [OrderController::class,'update_order_status']);
Route::post('admin/order_detail/{id}', [OrderController::class,'update_track_detail']);

Route::get('admin/Searchorder/', [OrderController::class,'Searchorder']);
//Category Route
Route::get('admin/category', [CategoryController::class,'index']);
Route::get('admin/category/managecategories', [CategoryController::class,'manage_category']);
Route::get('admin/category/managecategories/{id}', [CategoryController::class,'manage_category']);

Route::post('admin/category/managecategoryprocess', [CategoryController::class,'managecategoryprocess'])->name('category.managecategoryprocess');
Route::get('admin/category/delete/{id}', [CategoryController::class,'delete']);

//Coupon Route
Route::get('admin/coupon', [CouponController::class,'index']);
Route::get('admin/coupon/managecoupons', [CouponController::class,'manage_coupon']);
Route::get('admin/coupon/managecoupons/{id}', [CouponController::class,'manage_coupon']);
Route::get('admin/coupon/changecouponstatus/{id}/{data}', [CouponController::class,'changecouponstatus']);

Route::post('admin/coupon/managecouponprocess', [CouponController::class,'managecouponprocess'])->name('coupon.managecouponprocess');
Route::get('admin/coupon/delete/{id}', [CouponController::class,'delete']);




//Size Route


Route::get('admin/size', [SizeController::class,'index']);
Route::get('admin/size/manage_size', [SizeController::class,'manage_size']);
Route::get('admin/size/manage_size/{id}', [SizeController::class,'manage_size']);
Route::get('admin/size/changesizestatus/{id}/{data}', [SizeController::class,'changesizestatus']);
Route::post('admin/size/managesizeprocess', [SizeController::class,'managesizeprocess'])->name('size.managesizeprocess');
Route::get('admin/size/delete/{id}', [SizeController::class,'delete']);

//Colors Route

Route::get('admin/colors', [ColorsController::class,'index']);
Route::get('admin/colors/manage_colors', [ColorsController::class,'manage_colors']);
Route::get('admin/colors/manage_colors/{id}', [ColorsController::class,'manage_colors']);
Route::get('admin/colors/changecolorsstatus/{id}/{data}', [ColorsController::class,'changecolorsstatus']);
Route::post('admin/colors/managecolorsprocess', [ColorsController::class,'managecolorsprocess'])->name('colors.managecolorsprocess');
Route::get('admin/colors/delete/{id}', [ColorsController::class,'delete']);
//Colors Route\

//Tax Route
Route::get('admin/tax', [TaxController::class,'index']);
Route::get('admin/tax/manage_tax', [TaxController::class,'manage_tax']);
Route::get('admin/tax/manage_tax/{id}', [TaxController::class,'manage_tax']);
Route::get('admin/tax/changetaxstatus/{id}/{data}', [TaxController::class,'changetaxstatus']);
Route::post('admin/tax/managetaxprocess', [TaxController::class,'managetaxprocess'])->name('tax.managetaxprocess');
Route::get('admin/tax/delete/{id}', [TaxController::class,'delete']);
//Tax Route



//Brand Route 
Route::get('admin/brand', [BrandController::class,'index']);
Route::get('admin/brand/manage_brand', [BrandController::class,'manage_brand']);
Route::get('admin/brand/manage_brand/{id}', [BrandController::class,'manage_brand']);
Route::get('admin/brand/changebrandstatus/{id}/{data}', [BrandController::class,'changebrandstatus']);
Route::post('admin/brand/managebrandprocess', [BrandController::class,'managebrandprocess'])->name('brand.managebrandprocess');
Route::get('admin/brand/changebrandsstatus/{id}/{data}', [BrandController::class,'changebrandsstatus']);

//Brand Route 


//Products Route
Route::get('admin/products', [ProductsController::class,'index']);
Route::get('admin/products/manage_products', [ProductsController::class,'manage_products']);
Route::get('admin/products/manage_products/{id}', [ProductsController::class,'manage_products']);
Route::get('admin/products/changeproductsstatus/{id}/{data}', [ProductsController::class,'changeproductsstatus']);
Route::post('admin/products/manageproductsprocess', [ProductsController::class,'manageproductsprocess'])->name('products.manageproductsprocess');
Route::get('admin/products/delete/{id}', [ProductsController::class,'delete']);
Route::get('admin/products/products_attr_delete/{paid}/{pid}', [ProductsController::class,'products_attr_delete']);
Route::get('admin/products/products_images_delete/{paid}/{pid}', [ProductsController::class,'products_images_delete']);
//Products Route

//Customers Route 
Route::get('admin/customers', [CustomersController::class,'index']);

Route::get('admin/customers/show/{id}', [CustomersController::class,'show']);
Route::get('admin/customers/changecustomersstatus/{id}/{data}', [CustomersController::class,'changecustomersstatus']);
Route::get('admin/customers/delete/{id}', [CustomersController::class,'delete']);
//Customers Route 

//Home Banner Route
Route::get('admin/home_banner', [HomeBannerController::class,'index']);
Route::get('admin/home_banner/manage_home_banner', [HomeBannerController::class,'manage_home_banner']);
Route::get('admin/home_banner/manage_home_banner/{id}', [HomeBannerController::class,'manage_home_banner']);
Route::get('admin/home_banner/changehome_bannerstatus/{id}/{data}', [HomeBannerController::class,'changehome_bannerstatus']);
Route::post('admin/home_banner/managehome_bannerprocess', [HomeBannerController::class,'managehome_bannerprocess'])->name('home_banner.managehome_bannerprocess');
Route::get('admin/home_banner/delete/{id}', [HomeBannerController::class,'delete']);
//Home Banner Route




Route::get('admin/product_review',[ProductReviewController::class,'index']);
 Route::get('admin/update_product_review_status/{status}/{id}',[ProductReviewController::class,'update_product_review_status']);
Route::get('admin/logout', function () {
	session()->forget('ADMIN_ID');
	session()->forget('ADMIN_ROLE');
	session()->forget('ADMIN_LOGIN');
	session()->flash('error', 'Logout Successfully');
    return redirect('admin');
});

});

