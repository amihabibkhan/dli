<?php

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
//
//
//Route::get('/config-clear', function() {
//    $status = Artisan::call('config:clear');
//    return '<h1>Configurations cleared</h1>';
//});
//
//Route::get('/cache-clear', function() {
//    $status = Artisan::call('cache:clear');
//    return '<h1>Cache cleared</h1>';
//});
//
//Route::get('/config-cache', 'ConfigController@config');
//
//Route::get('/storage-link', function() {
//    $status = Artisan::call('storage:link');
//    return '<h1>Storage Linked</h1>';
//});


/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/
Route::get('/', 'Frontend\AllviewController@index')->name('index');
Route::get('/about-us', 'Frontend\AllviewController@aboutUs')->name('aboutUs');
Route::get('/contact-us', 'Frontend\AllviewController@contactUs')->name('contactUs');
Route::get('/list/faq', 'Frontend\AllviewController@faq')->name('faq_page');
Route::get('/list/terms', 'Frontend\AllviewController@terms')->name('terms_page');
Route::get('/about/instructor/{slug}', 'Frontend\AllviewController@singleInstructor')->name('singleInstructor');
Route::get('all/course', 'Frontend\AllviewController@allCourse')->name('allCourse');
Route::get('all/instructor', 'Frontend\AllviewController@allInstructor')->name('allInstructor');
Route::get('/details/course/{slug}', 'Frontend\AllviewController@course_details')->name('course_details');
// cart
Route::get('add/to/cart/{id}', 'CartController@addToCart')->name('addToCart');
Route::get('cart', 'CartController@viewCart')->name('viewCart');
Route::get('remove/from/cart/{id}', 'CartController@removeFromCart')->name('removeFromCart');
// coupon
Route::post('apply/coupon', 'CartController@applyCoupon')->name('applyCoupon');
Route::get('remove/coupon', 'CartController@removeCoupon')->name('removeCoupon');
// check out
Route::get('check/out', 'CheckoutController@checkOut')->name('checkOut');
Route::post('check/out', 'CheckoutController@checkOutFormSubmit')->name('checkOutFormSubmit');
Route::get('thanks/{tid}', 'CheckoutController@thanks')->name('thanks');
// message
Route::resource('messages', 'MessageController');
// subscriber
Route::resource('subscriber', 'Frontend\SubscriberController');
// search
Route::get('search', 'Frontend\AllviewController@search')->name('search');


/*
|--------------------------------------------------------------------------
| User and Admin Routes (Auth)
|--------------------------------------------------------------------------
*/





/*
|--------------------------------------------------------------------------
| Only User Routes
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => 'user'], function (){
   Route::get('/user/dashboard', 'User\UserController@dashboard')->name('userDashboard');
   Route::get('/user/account/settings', 'User\UserController@accountSettings')->name('accountSettings');
   Route::post('/user/account/update', 'User\UserController@updateAccount')->name('updateAccount');
   Route::get('/user/shopping/history', 'User\UserController@shoppingHistory')->name('shoppingHistory');
   Route::get('/user/course/list', 'User\UserController@userCourseList')->name('userCourseList');
   Route::get('user/course/video/{slug}/{video_id?}', 'User\UserController@courseVideos')->name('courseVideos');
   Route::resource('review', 'User\ReviewController');
});


/*
|--------------------------------------------------------------------------
| Only Admin Routes
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => 'admin'], function(){
    Route::resource('faq', 'Admin\FaqController');
    Route::resource('terms', 'Admin\TermController');
    Route::resource('coupons', 'Admin\CouponController');
    Route::resource('courses', 'Admin\CourseController');
    Route::resource('instructors', 'Admin\InstructorController');
    Route::resource('options', 'Admin\OptionController');

    // enrolled user list of a course
    Route::get('course/enrolled/{course_id}', 'Admin\CourseuserController@userList')->name('courseUserList');
    Route::get('course/removeUserFromCourse/{course_id}/{user_id}', 'Admin\CourseuserController@removeUserFromCourse')->name('removeUserFromCourse');
    Route::post('course/user/sendMessage', 'Admin\CourseuserController@sendMessageToAll')->name('sendMessageToAll');

    Route::get('course_instructor/{id}', 'Admin\InstructorController@course_instructor')->name('course_instructor');
    Route::post('course_instructor', 'Admin\InstructorController@add_course_instructor')->name('add_course_instructor');
    Route::post('course_instructor_remove', 'Admin\InstructorController@remove_course_instructor')->name('remove_course_instructor');
    Route::resource('transaction', 'Admin\TransactionController'); // show method for pending list view
    Route::get('accept/transaction/{id}', 'Admin\TransactionController@acceptTransaction')->name('acceptTransaction');
    Route::resource('modules', 'Admin\ModuleController'); // show method for all module of a course - id will be used for course id
    Route::resource('videos', 'Admin\VideoController');
});




Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
