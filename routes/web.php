<?php

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

use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;


//=============================================== Admin Routes =========================================================
//======================================================================================================================
//======================================================================================================================
// Admin Password Reset Route
Route::post('admin/password/reset',
    'Admin\AuthController@reset')->name('admin.password.reset')->middleware('checkRandom');
// Admin Logout Route
Route::post('admin/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
Route::group(['prefix' => 'bugbuggy', 'namespace' => 'Auth'], function () {
//Authentication Routes
    Route::get('/login', 'AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'AdminLoginController@login')->name('admin.login.submit')->middleware('checkRandom');
});
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['auth:admin']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
//Dashboard Routes
Route::group(['prefix' => 'admin/dashboard', 'namespace' => 'Admin', 'middleware' => 'auth:admin'], function () {
    //Shows Dashboard View For Admins
    Route::get('/', 'AdminController@dashboard')->name('admin.dashboard');
    //Profile Manipulation
    Route::get('/profile/{admin}/edit', 'ProfileController@edit')->name('admin.profile.edit');
    Route::patch('/profile/{admin}/update', 'ProfileController@update')->name('admin.profile.update');
    //Admins Manipulation
    Route::resource('admins', 'AdminController', ['names' => 'admin.admins']);
    //Role Controller
    Route::resource('roles', 'RoleController', ['names' => 'admin.roles']);
    //Primary Users Manipulation
    Route::patch('user/{user}', 'PrimaryUserController@update')->name('admin.user.primary.update');
    Route::resource('user', 'PrimaryUserController', ['names' => 'admin.user.primary'])->except(['update', 'show']);
//    Route::get('user_history', 'PrimaryUserController', ['names' => 'admin.user_history.primary'])->except(['update', 'show']);
    Route::resource('category', 'CategoryController', ['names' => 'admin.category'])->except(['show']);
    //Tasks Manipulation
    Route::resource('task', 'TaskController', ['names' => 'admin.task'])->except(['show']);
    //SMS Manipulation
    Route::get('sms/create', 'SmsController@create')->name('admin.sms.create');
    Route::post('sms/batch', 'SmsController@storeBatch')->name('admin.sms.store.batch');
    Route::post('sms/single', 'SmsController@storeSingle')->name('admin.sms.store.single');
    Route::get('sms', 'SmsController@index')->name('admin.sms.index');
    Route::post('sms/resend/{mobile}/{message}/{type}', 'SmsController@resend')->middleware('CheckSmsResend');//Ajax
    //SMS Communications
    Route::get('sms/communication', 'SmsController@comIndex')->name('admin.com.index');
    Route::get('sms/communication/create', 'SmsController@comCreate')->name('admin.com.create');
    Route::post('sms/communication', 'SmsController@comStore')->name('admin.com.store');
    Route::get('sms/communication/{com}/edit', 'SmsController@comEdit')->name('admin.com.edit');
    Route::patch('sms/communication/{com}/update', 'SmsController@comUpdate')->name('admin.com.update');
    Route::delete('sms/communication/{com}', 'SmsController@comDestroy')->name('admin.com.destroy');
    //SMS Drafts
    Route::get('sms/draft', 'SmsController@draftIndex')->name('admin.draft.index');
    Route::get('sms/draft/create', 'SmsController@draftCreate')->name('admin.draft.create');
    Route::post('sms/draft', 'SmsController@draftStore')->name('admin.draft.store');
    Route::get('sms/draft/{draft}/edit', 'SmsController@draftEdit')->name('admin.draft.edit');
    Route::patch('sms/draft/{draft}/update', 'SmsController@draftUpdate')->name('admin.draft.update');
    Route::delete('sms/draft/{draft}', 'SmsController@draftDestroy')->name('admin.draft.destroy');
    //SMS Settings
    Route::get('sms/setting/show', 'SmsController@showSettings')->name('admin.sms.setting.show');
    Route::post('sms/setting/updateOrCreate',
        'SmsController@updateOrCreateCredentials')->name('admin.sms.setting.updateOrCreate');
    Route::get('sms/setting/getCredentials', 'SmsController@getCredentials');//Ajax
    //SMS Delivery Reports
    Route::get('sms/delivery', 'SmsController@showDeliveries')->name('admin.sms.setting.index');
    //Tickets Manipulation
    Route::patch('ticket/status/{ticket}', 'TicketController@status')->name('admin.ticket.toggle');
    Route::resource('ticket', 'TicketController', ['names' => 'admin.ticket'])->only(['index', 'show', 'create', 'store', 'destroy']);
    //Faqs Manipulation
    Route::resource('faq', 'FaqController', ['names' => 'admin.faq'])->only(['update']);
    Route::get('download/faq', 'FaqController@downloadFile')->name('faq.download');
    //Sliders Manipulation
    Route::resource('slider', 'SliderController', ['names' => 'admin.slider'])->except(['show']);
    //challenges  Manipulation
    Route::resource('challenge', 'SectionController', ['names' => 'admin.challenge']);
    Route::resource('reply', 'ReplyController', ['names' => 'admin.reply'])->only(['index', 'update', 'destroy', 'edit']);
    Route::resource('question', 'QuestionController', ['names' => 'admin.question'])->except(['create', 'show']);
    Route::resource('score', 'TotalScoreController', ['names' => 'admin.score'])->except(['create', 'edit', 'show','store']);
    Route::post('score/{user}', 'TotalScoreController@store')->name('admin.score.store');
    //========================== AJAX ROUTES START =====================================================================
    //Search Ajax
    Route::get('search', 'AdminController@search');
    //Chart Ajax Route
    Route::get('getMonthlyRecord', 'AdminController@chart');




    //Note Manipulation
    Route::post('note/{user}', 'NoteController@store')->name('admin.note.store');
    Route::resource('note', 'NoteController', ['names' => 'admin.note'])->except(['create', 'show', 'store', 'index']);


    //Toggles Task Status
    Route::post('task/status/{task}', 'TaskController@status');
    //Toggles User Auth Status
    Route::post('user/status/{user}', 'PrimaryUserController@authStatus');
    //Primary User Filter Manipulation
    Route::get('filter/PUser', 'PrimaryUserController@filter');
    //Todos Filter Manipulation
    Route::get('filter/todos', 'TodosController@filter');
    //Task Filter Manipulation
    Route::get('filter/task', 'TaskController@filter');
    //Label Manipulation


    //========================== AJAX ROUTES END =======================================================================
    //Settings Manipulation
    Route::get('/settings', 'SettingController@edit')->name('admin.settings.edit');
    Route::post('/settings', 'SettingController@updateOrCreate')->name('admin.settings.updateOrCreate');

    Route::get('/settings/front', 'SettingController@editFront')->name('admin.settings_front.edit');
    Route::post('/settings/front', 'SettingController@updateFront')->name('admin.settings_front.update');


    Route::get('/contacts', 'AdminController@contacts')->name('admin.contact.index');
    //========================== Front ROUTES  =======================================================================
    Route::get('/front/menus', 'FrontController@editMenu')->name('admin.front_menu.edit');
    Route::post('/front/menus', 'FrontController@storeMenu')->name('admin.front_menu.store');
    Route::patch('/front/menus/{frontMenu}', 'FrontController@updateMenu')->name('admin.front_menu.update');
    Route::delete('/front/menus/{frontMenu}', 'FrontController@deleteMenu')->name('admin.front_menu.delete');
    Route::get('/front/menus/{frontMenu}', 'FrontController@editMenuInfo')->name('admin.front_menu.ajax');

    Route::get('/front/hero', 'FrontController@editHero')->name('admin.front_hero.edit');
    Route::patch('/front/hero/{frontHero}', 'FrontController@updateHero')->name('admin.front_hero.update');

    Route::get('/front/features', 'FrontController@editFeature')->name('admin.front_feature.edit');
    Route::post('/front/features', 'FrontController@storeFeature')->name('admin.front_feature.store');
    Route::patch('/front/features/{frontFeature}', 'FrontController@updateFeature')->name('admin.front_feature.update');
    Route::delete('/front/features/{frontFeature}', 'FrontController@deleteFeature')->name('admin.front_feature.delete');
    Route::get('/front/features/{frontFeature}', 'FrontController@editFeatureInfo')->name('admin.front_feature.ajax');

    Route::get('/front/way', 'FrontController@editWay')->name('admin.front_way.edit');
    Route::post('/front/way', 'FrontController@storeWay')->name('admin.front_way.store');
    Route::patch('/front/way/{frontWay}', 'FrontController@updateWay')->name('admin.front_way.update');
    Route::delete('/front/way/{frontWay}', 'FrontController@deleteWay')->name('admin.front_way.delete');
    Route::get('/front/way/{frontWay}', 'FrontController@editWayInfo')->name('admin.front_way.ajax');


    Route::get('/front/overlay', 'FrontController@editOverlay')->name('admin.front_overlay.edit');
    Route::patch('/front/overlay/{frontOverlay}', 'FrontController@updateOverlay')->name('admin.front_overlay.update');

    Route::get('/front/call', 'FrontController@editCall')->name('admin.front_call.edit');
    Route::patch('/front/call/{id}', 'FrontController@updateCall')->name('admin.front_call.update');


    Route::get('/front/social', 'FrontController@editSocial')->name('admin.front_social.edit');
    Route::post('/front/social', 'FrontController@storeSocial')->name('admin.front_social.store');
    Route::patch('/front/social/{frontSocail}', 'FrontController@updateSocial')->name('admin.front_social.update');
    Route::delete('/front/social/{frontSocail}', 'FrontController@deleteSocial')->name('admin.front_social.delete');
    Route::get('/front/social/{frontSocail}', 'FrontController@editSocialInfo')->name('admin.front_social.ajax');


    Route::get('/front/faq', 'FrontController@editFaq')->name('admin.front_faq.edit');
    Route::post('/front/faq', 'FrontController@storeFaq')->name('admin.front_faq.store');
    Route::patch('/front/faq/{frontFaq}', 'FrontController@updateFaq')->name('admin.front_faq.update');
    Route::delete('/front/faq/{frontFaq}', 'FrontController@deleteFaq')->name('admin.front_faq.delete');
    Route::get('/front/faq/{frontFaq}', 'FrontController@editFaqInfo')->name('admin.front_faq.ajax');

    //========================== TODOS MANIPULATION ====================================================================
    Route::get('todos', 'TodosController@index')->name('admin.todos.index');


    //========================== Blogs ==========================================================================
    Route::resource('blog', 'BlogController', ['names' => 'admin.blog']);
    //========================== cats ==========================================================================
});

//=============================================== User Routes ==========================================================
//======================================================================================================================
//======================================================================================================================
// User Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->middleware('checkRandom');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// User Registration Routes...
Route::post('register', 'Auth\RegisterController@register')->name('post.register');
// User Password Reset Routes...
Route::post('password/reset', 'User\AuthController@reset')->name('mpassword.reset')->middleware('checkRandom');
Route::get('password/reset', 'User\AuthController@resetPassForm');
Route::get('pass/resetForm', 'User\AuthController@resetForm')->name('password.reset');
Route::post('pass/update', 'User\AuthController@resetPassword')->name('password.update');

//Resend Sms
Route::post('resend', 'User\AuthController@resendSms');

Route::group(['middleware' => ['auth']], function () {

    Route::get('/email/verify', 'User\VerificationController@show')->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', 'User\VerificationController@verify')->name('verification.verify')->middleware(['signed']);
    Route::post('/email/resend', 'User\VerificationController@resend')->name('verification.resend');

});
//Home Page Is Register View Page
Route::group(['namespace' => 'User'], function () {
    Route::get('/register', 'AuthController@showRegistrationForm')->name('register');

    //Entering Mobile Number To Send Validation Code To It
    Route::post('toRegister', 'AuthController@toRegister');
    //Checks Incoming Mobile Validation Code IN Registeration Process
    Route::post('toCheckCode', 'AuthController@toCheckCode');
    //TODO::Here We Should Put A Middleware To Prevent User To Loop Ids
    Route::get('essentials/create/{user}', 'AuthController@showEssentailsForm')->name('essentials.create');
    Route::patch('essentials/{user}', 'AuthController@storeEssentials')->name('essentials.store');
    Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function () {
        Route::group(['middleware' => ['verified']], function () {
        Route::get('/', 'UserController@dashboard')->name('user.dashboard');
        Route::patch('/{user}', 'UserController@update')->name('user.update');
        //Primary Users Manipulation
        Route::patch('user/{user}', 'PrimaryUserController@update')->name('user.primary.update');
        Route::resource('user', 'PrimaryUserController', ['names' => 'user.primary'])->only(['edit']);
        Route::get('files', 'PrimaryUserController@files')->name('user.files');


    });
    });


});
//==================================== User Ajax Routes ================================================================

Route::group(['namespace' => 'User', 'middleware' => 'auth', 'prefix' => 'dashboard'], function () {
    Route::group(['middleware' => ['verified']], function () {
        //File Manipulation

        //Primary User Filter Manipulation
        Route::get('filter/PUser', 'PrimaryUserController@filter');
        //Tickets Manipulation (Not Ajax)
        Route::patch('ticket/status/{ticket}', 'TicketController@status')->name('user.ticket.toggle');
        Route::resource('ticket', 'TicketController', ['names' => 'user.ticket'])->only([
            'index',
            'edit',
            'destroy',
            'create',
            'store'
        ]);
        //Faqs Manipulation (Not Ajax)
        Route::post('faq/{ticket}', 'FaqController@store')->name('user.faq.store');
        Route::get('download/faq', 'FaqController@downloadFile')->name('user.faq.download');
        Route::resource('challenge', 'SectionController', ['names' => 'user.challenge']);
        Route::resource('question', 'QuestionController', ['names' => 'user.question'])->except(['create', 'show']);

    });
});


Route::get('/', 'Front\HomeController@index')->name('home');
Route::get('user/{username}', 'Front\HomeController@user')->name('user');
Route::get('/chaleshKade', 'Front\HomeController@chaleshKade')->name('chalesh_kade');
Route::get('/contact-us', 'Front\HomeController@contactUs')->name('contact_us');
Route::post('/contact-store', 'Front\HomeController@contactUsStore')->name('contact_us_store')->middleware('checkRandom');;
Route::get('chaleshKade/{slug}', 'Front\HomeController@section')->name('section');
Route::get('category/{slug}', 'Front\HomeController@category')->name('category');
Route::post('quiz/{section}', 'Front\HomeController@quiz')->name('quiz');
Route::get('/markAsRead', function () {
    auth()->user()->unreadNotifications->markAsRead();
    return redirect()->back();
});
Route::resource('reply', 'User\ReplyController', ['names' => 'reply'])->middleware('auth');
Route::post('/like-reply/{reply}', 'Front\LikeController@like')->name('likeReply');
Route::post('/unlike-reply/{reply}', 'Front\LikeController@unlike')->name('unlikeReply');
Route::post('/dislike-reply/{reply}', 'Front\LikeController@dislike')->name('dislikeReply');
//Search
Route::get('search', 'Front\HomeController@search');
Route::get('archive', 'Front\HomeController@archive')->name('archive');
// Front Pages !
Route::get('page/{slug}', 'Front\HomeController@show')->name('page');


Route::get('test', function (){

});
