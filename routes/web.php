<?php

use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SessionController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Auth;
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

//ADMIN ROUTES-------------------------------------------------------------------------------------------------------------------------------------------------
Route::get('/admin/login', function () {
    return view('admin.auth.login');
})->name('admin.login')->middleware('guest');
Route::namespace('App\Http\Controllers\Admin')->prefix('/admin')->middleware('admin')->group(function () {
    //Dashboard
    Route::get('/dashboard', 'AdminController@dashboard')->name('dashboard');

    //service
    Route::get('service', 'ServiceController@index')->name('service');
    Route::match(['get', 'post'], '/add-service', 'ServiceController@addService')->name('admin.add-service');
    Route::match(['get', 'post'], '/service-edit/{id}', 'ServiceController@edit')->name('admin.edit-service');
//    Route::get('/service-view/{id}', 'ServiceController@show')->name('service-view');
    Route::delete('service/destroy/{id}', 'ServiceController@destroy');


    //Session
    Route::get('session', 'SessionController@index')->name('session');
    Route::match(['get', 'post'], '/add-session', 'SessionController@addSessions')->name('admin.add-session');
    Route::match(['get', 'post'], '/session-edit/{id}', 'SessionController@edit')->name('admin.edit-session');
    Route::delete('session/destroy/{id}', 'SessionController@destroy');
    Route::post('session/deactivate-status/{id}', 'SessionController@deactivateStatus');
    Route::post('session/activate-status/{id}', 'SessionController@activateStatus');
    Route::post('session/view', 'SessionController@sessionView')->name('sessionView');

    Route::get('delete-session-timing', 'SessionController@deleteSessionTiming')->name('deleteSessionTiming');
    Route::get('update-session-timing', 'SessionController@updateSessionTime')->name('updateSessionTime');

    Route::get( '/booked-session', 'SessionController@bookedSession')->name('book-sessions');
    Route::get( '/booked-sessions', 'SessionController@bookedSessionDatatables')->name('book-sessions-datatables');
    Route::delete('booked-session/destroy/{id}', 'SessionController@bookSessionDestroy');
    Route::get( '/view-booked-sessions/{id}', 'SessionController@viewBookedSession')->name('viewBookedSession');




//    //category
//    Route::get('category', 'CategoryController@index')->name('category');
//    Route::match(['get', 'post'], '/add-category', 'CategoryController@addCategory')->name('admin.add-category');
//    Route::match(['get', 'post'], '/category-edit/{id}', 'CategoryController@edit')->name('admin.edit-category');
//    Route::get('/category-view/{id}', 'CategoryController@show')->name('category-view');
//    Route::delete('category/destroy/{id}', 'CategoryController@destroy');
//
//    //product
//    Route::get('product', 'ProductController@index')->name('product');
//    Route::match(['get', 'post'], '/add-product', 'ProductController@addCategory')->name('admin.add-product');
//    Route::match(['get', 'post'], '/product-edit/{id}', 'ProductController@edit')->name('admin.edit-product');
//    Route::get('/product-view/{id}', 'ProductController@show')->name('product-view');
//    Route::delete('product/destroy/{id}', 'ProductController@destroy');
//    Route::get('/product-approve/{id}', 'ProductController@approve')->name('product-approve');
//    Route::get('/product-reject/{id}', 'ProductController@reject')->name('product-reject');
//
//    //product_category
//    Route::get('product_category', 'ProductCategoryController@index')->name('product_category');
//    Route::match(['get', 'post'], '/add-product_category', 'ProductCategoryController@addCategory')->name('admin.add-product_category');
//    Route::match(['get', 'post'], '/product_category-edit/{id}', 'ProductCategoryController@edit')->name('admin.edit-product_category');
//    Route::get('/product_category-view/{id}', 'ProductCategoryController@show')->name('product_category-view');
//    Route::delete('product_category/destroy/{id}', 'ProductCategoryController@destroy');
//
//    //business_listing
//    Route::get('business_listing', 'BusinessListingController@index')->name('business_listing');
//    Route::match(['get', 'post'], '/add-business_listing', 'BusinessListingController@addBusinessListing')->name('admin.add-business_listing');
//    Route::match(['get', 'post'], '/business_listing-edit/{id}', 'BusinessListingController@edit')->name('admin.edit-business_listing');
//    Route::get('/business_listing-view/{id}', 'BusinessListingController@show')->name('business_listing-view');
//    Route::get('/business_listing-approve/{id}', 'BusinessListingController@approve')->name('business_listing-approve');
//    Route::get('/business_listing-reject/{id}', 'BusinessListingController@reject')->name('business_listing-reject');
//    Route::delete('business_listing/destroy/{id}', 'BusinessListingController@destroy');
//    Route::get('get-cities-by-state/{state_id}', 'BusinessListingController@getCityByStates')->name('admin.getCityByStates');
//    Route::get('get-counties-by-state/{state_id}', 'BusinessListingController@getCountyByStates')->name('admin.getCountyByStates');
//    Route::get('get-cities-by-counties/{county_id}', 'BusinessListingController@getCityByCounties')->name('admin.getCityByCounties');
//
//    //forum-category
//    Route::get('forum-category', 'ForumCategoryController@index')->name('forum-category');
//    Route::match(['get', 'post'], '/add-forum-category', 'ForumCategoryController@addForumCategory')->name('admin.add-forum-category');
//    Route::match(['get', 'post'], '/forum-category-edit/{id}', 'ForumCategoryController@edit')->name('admin.edit-forum-category');
//    Route::get('/forum-category-view/{id}', 'ForumCategoryController@show')->name('forum-category-view');
//    Route::delete('forum-category/destroy/{id}', 'ForumCategoryController@destroy');
//
//    //forum-topic
//    Route::get('forum-topic', 'ForumTopicController@index')->name('forum-topic');
//    Route::get('/forum-topic-view/{id}', 'ForumTopicController@show')->name('forum-topic-view');
//    Route::delete('forum-topic/destroy/{id}', 'ForumTopicController@destroy');
//
//    //customer
    Route::get('customer', 'CustomerController@index')->name('customer');
////    Route::match(['get', 'post'], '/add-customer', 'CustomerController@addCustomer')->name('admin.add-customer');
//    Route::match(['get', 'post'], '/customer-edit/{id}', 'CustomerController@edit')->name('admin.edit-customer');
    Route::post('/customer/activate/{id}', 'CustomerController@activate')->name('customer-activate');
    Route::get('/customer-view/{id}', 'CustomerController@show')->name('customer-view');
    Route::get('/session-view/{id}', 'SessionController@sessionView')->name('session-view');
    Route::delete('customer/destroy/{id}', 'CustomerController@destroy');
//
//    //site-event
//    Route::get('site-event', 'SiteEventController@index')->name('site-event');
//    Route::get('/site-event-view/{id}', 'SiteEventController@show')->name('site-event-view');
//    Route::delete('site-event/destroy/{id}', 'SiteEventController@destroy');
//    Route::get('/site-event-approve/{id}', 'SiteEventController@approve')->name('site-event-approve');
//    Route::get('/site-event-reject/{id}', 'SiteEventController@reject')->name('site-event-reject');
//
//    //memoriam
//    Route::get('memoriam', 'MemoriamController@index')->name('memoriam');
//    Route::match(['get', 'post'], '/add-memoriam', 'MemoriamController@addMemoriam')->name('admin.add-memoriam');
//    Route::match(['get', 'post'], '/memoriam-edit/{id}', 'MemoriamController@edit')->name('admin.edit-memoriam');
//    //Route::get('/memoriam-view/{id}', 'MemoriamController@show')->name('memoriam-view');
//    Route::delete('memoriam/destroy/{id}', 'MemoriamController@destroy');

    //setting
    Route::match(['get', 'post'], '/settings', 'SettingController@index')->name('settings');
    route::get('/changePassword', [SettingController::class, 'changePassword']);
    route::post('/updateAdminPassword', [SettingController::class, 'updateAdminPassword']);

    //CMS
    route::get('/Faq', [\App\Http\Controllers\Admin\CmsController::class, 'Faq'])->name('faq');
    Route::get('/all-faqs', 'CmsController@index')->name('faqs.datatables');
    Route::get('/create-faq', 'CmsController@createFaq')->name('admin.create-faq');
    Route::post('/add-faq', 'CmsController@addFaq')->name('admin.add.faq');
    Route::get('/edit-faq/{id}', 'CmsController@editFaq')->name('edit.faq');
    Route::post('/admin-edit-faq/{id}', 'CmsController@adminEditFaq')->name('admin.edit.faq');
    Route::post('/admin-delete-faq/{id}', 'CmsController@adminDeleteFaq')->name('admin.delete.faq');

    route::get('/testimonials', [\App\Http\Controllers\Admin\CmsController::class, 'testimonials'])->name('testimonials');
    Route::get('/all-testimonials', 'CmsController@testimonialsDatatables')->name('testimonials.datatables');
    Route::get('/create-testimonials', 'CmsController@createTestimonial')->name('admin.create-testimonials');
    Route::post('/add-testimonials', 'CmsController@addTestimonials')->name('admin.add.testimonials');
    Route::get('/edisessiont-testimonial/{id}', 'CmsController@editTestimonial')->name('edit.testimonial');
    Route::post('/admin-edit-testimonial/{id}', 'CmsController@adminEditTestimonial')->name('admin.edit.testimonial');
    Route::post('/admin-delete-testimonial/{id}', 'CmsController@adminDeleteTestimonial')->name('admin.delete.testimonial');

//    //CMS
//    Route::get('/cms', 'CmsController@index')->name('admin.cms.index');
//    Route::get('/cms/edit/{id}', 'CmsController@editSection')->name('admin.cms.edit');
//    Route::post('/cms/update/{slug}', 'CmsController@updateSection')->name('admin.cms.update');
});

//USER ROUTES-------------------------------------------------------------------------------------------------------------------------------------------------
Route::get('/front-login', function () {
    return view('front.login');
})->name('front.login')->middleware('guest');
Route::prefix('/user')->middleware('user')->group(function () {
    //Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/notifications', [UserController::class, 'notifications'])->name('user.notifications');
    Route::get('/get-notifications', [UserController::class, 'authNotifications'])->name('authNotifications');
    Route::get('/dismiss-notifications', [UserController::class, 'dismissNotifications'])->name('dismiss.notifications');

    Route::match(['get', 'post'], '/edit-profile', [UserController::class, 'editProfile'])->name('user.editProfile');
    Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');

    Route::get('/edit/password', [UserController::class, 'editPassword'])->name('user.editPassword');
    Route::post('/edit-password', [ForgotPasswordController::class, 'editUserPassword'])->name('userEditPassword');

    Route::get('/sessions', [UserController::class, 'sessions'])->name('user.sessions');
    Route::get('/book/sessions', [UserController::class, 'bookSession'])->name('user.bookSession');
    Route::get('/booking', [UserController::class, 'booking'])->name('user.booking')->withoutMiddleware('user');

    Route::post('/book/sessions', [UserController::class, 'sessionBooking'])->name('user.sessionBooking');
    Route::get('stripe-redirect/{session_booked_id}/{status}', [UserController::class, 'stripeRedirect'])->name('stripe.redirect');

    Route::get('booking/get-sessions-by-service/', [SessionController::class,'getSessionsByService'])->name('getSessionsByService');
    Route::get('booking/get-sessions-timing-by-session/', [SessionController::class,'getSessionsTimingBySession'])->name('getSessionsTimingBySession');




    Route::post('/selected-date-session', [SessionController::class,'fetchDateSessions'])->name('fetchDateSessions')->withoutMiddleware('user');

    Route::get('dashboard-sessions', [DashboardController::class,'datatables'])->name('session.datatables')->withoutMiddleware('user');


    Route::post('contact-via-mail', [UserController::class,'contactViaMail'])->name('contact-via-mail')->withoutMiddleware('user');


    Route::get('send/notification', [UserController::class,'sendNotification'])->name('sendNotification');

//    //category
//    Route::get('category', 'CategoryController@index')->name('category');
//    Route::match(['get', 'post'], '/add-category', 'CategoryController@addCategory')->name('admin.add-category');
//    Route::match(['get', 'post'], '/category-edit/{id}', 'CategoryController@edit')->name('admin.edit-category');
//    Route::get('/category-view/{id}', 'CategoryController@show')->name('category-view');
//    Route::delete('category/destroy/{id}', 'CategoryController@destroy');
//
//    //product
//    Route::get('product', 'ProductController@index')->name('product');
//    Route::match(['get', 'post'], '/add-product', 'ProductController@addCategory')->name('admin.add-product');
//    Route::match(['get', 'post'], '/product-edit/{id}', 'ProductController@edit')->name('admin.edit-product');
//    Route::get('/product-view/{id}', 'ProductController@show')->name('product-view');
//    Route::delete('product/destroy/{id}', 'ProductController@destroy');
//    Route::get('/product-approve/{id}', 'ProductController@approve')->name('product-approve');
//    Route::get('/product-reject/{id}', 'ProductController@reject')->name('product-reject');
//
//    //product_category
//    Route::get('product_category', 'ProductCategoryController@index')->name('product_category');
//    Route::match(['get', 'post'], '/add-product_category', 'ProductCategoryController@addCategory')->name('admin.add-product_category');
//    Route::match(['get', 'post'], '/product_category-edit/{id}', 'ProductCategoryController@edit')->name('admin.edit-product_category');
//    Route::get('/product_category-view/{id}', 'ProductCategoryController@show')->name('product_category-view');
//    Route::delete('product_category/destroy/{id}', 'ProductCategoryController@destroy');
//
//    //business_listing
//    Route::get('business_listing', 'BusinessListingController@index')->name('business_listing');
//    Route::match(['get', 'post'], '/add-business_listing', 'BusinessListingController@addBusinessListing')->name('admin.add-business_listing');
//    Route::match(['get', 'post'], '/business_listing-edit/{id}', 'BusinessListingController@edit')->name('admin.edit-business_listing');
//    Route::get('/business_listing-view/{id}', 'BusinessListingController@show')->name('business_listing-view');
//    Route::get('/business_listing-approve/{id}', 'BusinessListingController@approve')->name('business_listing-approve');
//    Route::get('/business_listing-reject/{id}', 'BusinessListingController@reject')->name('business_listing-reject');
//    Route::delete('business_listing/destroy/{id}', 'BusinessListingController@destroy');
//    Route::get('get-cities-by-state/{state_id}', 'BusinessListingController@getCityByStates')->name('admin.getCityByStates');
//    Route::get('get-counties-by-state/{state_id}', 'BusinessListingController@getCountyByStates')->name('admin.getCountyByStates');
//    Route::get('get-cities-by-counties/{county_id}', 'BusinessListingController@getCityByCounties')->name('admin.getCityByCounties');
//
//    //forum-category
//    Route::get('forum-category', 'ForumCategoryController@index')->name('forum-category');
//    Route::match(['get', 'post'], '/add-forum-category', 'ForumCategoryController@addForumCategory')->name('admin.add-forum-category');
//    Route::match(['get', 'post'], '/forum-category-edit/{id}', 'ForumCategoryController@edit')->name('admin.edit-forum-category');
//    Route::get('/forum-category-view/{id}', 'ForumCategoryController@show')->name('forum-category-view');
//    Route::delete('forum-category/destroy/{id}', 'ForumCategoryController@destroy');
//
//    //forum-topic
//    Route::get('forum-topic', 'ForumTopicController@index')->name('forum-topic');
//    Route::get('/forum-topic-view/{id}', 'ForumTopicController@show')->name('forum-topic-view');
//    Route::delete('forum-topic/destroy/{id}', 'ForumTopicController@destroy');
//
//    //customer
//    Route::get('customer', 'CustomerController@index')->name('customer');
////    Route::match(['get', 'post'], '/add-customer', 'CustomerController@addCustomer')->name('admin.add-customer');
//    Route::match(['get', 'post'], '/customer-edit/{id}', 'CustomerController@edit')->name('admin.edit-customer');
//    Route::post('/customer/activate/{id}', 'CustomerController@activate')->name('customer-activate');
//    Route::get('/customer-view/{id}', 'CustomerController@show')->name('customer-view');
//    Route::delete('customer/destroy/{id}', 'CustomerController@destroy');
//
//    //site-event
//    Route::get('site-event', 'SiteEventController@index')->name('site-event');
//    Route::get('/site-event-view/{id}', 'SiteEventController@show')->name('site-event-view');
//    Route::delete('site-event/destroy/{id}', 'SiteEventController@destroy');
//    Route::get('/site-event-approve/{id}', 'SiteEventController@approve')->name('site-event-approve');
//    Route::get('/site-event-reject/{id}', 'SiteEventController@reject')->name('site-event-reject');
//
//    //memoriam
//    Route::get('memoriam', 'MemoriamController@index')->name('memoriam');
//    Route::match(['get', 'post'], '/add-memoriam', 'MemoriamController@addMemoriam')->name('admin.add-memoriam');
//    Route::match(['get', 'post'], '/memoriam-edit/{id}', 'MemoriamController@edit')->name('admin.edit-memoriam');
//    //Route::get('/memoriam-view/{id}', 'MemoriamController@show')->name('memoriam-view');
//    Route::delete('memoriam/destroy/{id}', 'MemoriamController@destroy');
//
//    //setting
//    Route::match(['get', 'post'], '/settings', 'SettingController@index')->name('settings');
//    route::get('/changePassword', [SettingController::class, 'changePassword']);
//    route::post('/updateAdminPassword', [SettingController::class, 'updateAdminPassword']);
//
//    //CMS
//    Route::get('/cms', 'CmsController@index')->name('admin.cms.index');
//    Route::get('/cms/edit/{id}', 'CmsController@editSection')->name('admin.cms.edit');
//    Route::post('/cms/update/{slug}', 'CmsController@updateSection')->name('admin.cms.update');
});

Auth::routes();
Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/stream', [App\Http\Controllers\HomeController::class, 'sessionStream'])->name('sessionStream');

//FRONT ROUTES-------------------------------------------------------------------------------------------------------------------------------------------------
Route::get('/', [FrontController::class, 'home'])->name('front.home');
Route::get('/services', [FrontController::class, 'services'])->name('front.services');
Route::get('/user/service-detail/{id}', [FrontController::class, 'serviceDetail'])->name('front.serviceDetail');

Route::get('/user/service/detail/{id}', [FrontController::class, 'frontServiceDetail'])->name('serviceDetail');

Route::get('/signup', function () {
    return view('front.signup');
})->name('front.signup');

Route::get('/about', function () {
    return view('front.about');
})->name('front.about');

Route::get('/contact', function () {
    return view('front.contact');
})->name('front.contact');

Route::get('/health', function () {
    return view('front.health');
})->name('front.health');

Route::get('/education', function () {
    return view('front.education');
})->name('front.education');

Route::get('/wellness', function () {
    return view('front.wellness');
})->name('front.wellness');

Route::get('/payment-checkout', function () {
    return view('dashboard.payment');
})->name('dashboard.payment');

Route::get('/faq', [FrontController::class, 'frontFaqs'])->name('front.faq');


Route::get('/gift-card', function () {
    return view('front.gift-card');
})->name('front.gift-card');

Route::get('/membership', function () {
    return view('front.membership');
})->name('front.membership');
