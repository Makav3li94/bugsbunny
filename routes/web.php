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
Route::group(['prefix' => 'admin', 'namespace' => 'Auth'], function () {
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
    Route::resource('ticket', 'TicketController', ['names' => 'admin.ticket'])->only(['index', 'show','create','store', 'destroy']);
    //Faqs Manipulation
    Route::resource('faq', 'FaqController', ['names' => 'admin.faq'])->only(['update']);
    Route::get('download/faq', 'FaqController@downloadFile')->name('faq.download');
    //Sliders Manipulation
    Route::resource('slider', 'SliderController', ['names' => 'admin.slider'])->except(['show']);
    //challenges  Manipulation
    Route::resource('challenge', 'SectionController', ['names' => 'admin.challenge']);
    Route::resource('question', 'QuestionController', ['names' => 'admin.question'])->except(['create','show']);
    Route::resource('answer', 'AnswerController', ['names' => 'admin.answer'])->except(['create','edit','show']);
    //========================== AJAX ROUTES START =====================================================================
    //Search Ajax
    Route::get('search', 'AdminController@search');
    //Chart Ajax Route
    Route::get('getMonthlyRecord', 'AdminController@chart');


    //File Manipulation
    Route::get('download/{file}/{user}', 'FileController@FileDownloader')->name('admin.file.download');
    Route::post('file/{user}', 'FileController@store')->name('admin.file.store');
    Route::delete('file/{file}', 'FileController@destroy')->name('admin.file.destroy');

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
    Route::get('/labels', 'LabelController@index')->name('admin.label.index');

    Route::resource('user/company', 'UserCompanyController', ['names' => 'admin.user.company'])->except(['show']);

    //========================== AJAX ROUTES END =======================================================================
    //Settings Manipulation
    Route::get('/settings', 'SettingController@edit')->name('admin.settings.edit');
    Route::post('/settings', 'SettingController@updateOrCreate')->name('admin.settings.updateOrCreate');

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
Route::post('password/reset', 'User\AuthController@reset')->name('password.reset')->middleware('checkRandom');

//Resend Sms
Route::post('resend', 'User\AuthController@resendSms');

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
        Route::get('/', 'UserController@dashboard')->name('user.dashboard');
        //Primary Users Manipulation
        Route::patch('user/{user}', 'PrimaryUserController@update')->name('user.primary.update');
        Route::resource('user', 'PrimaryUserController', ['names' => 'user.primary'])->only(['edit']);
        Route::get('files', 'PrimaryUserController@files')->name('user.files');


    });


});
//==================================== User Ajax Routes ================================================================

Route::group(['namespace' => 'User', 'middleware' => 'auth', 'prefix' => 'dashboard'], function () {
    //File Manipulation
    Route::get('download/{file}/{user}', 'FileController@FileDownloader')->name('user.file.download');
    Route::post('file/{user}', 'FileController@store')->name('user.file.store');
    Route::delete('file/{file}', 'FileController@destroy')->name('user.file.destroy');
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


});

Route::get('/', 'Front\HomeController@index')->name('home');
Route::get('/forum', 'Front\HomeController@forum')->name('forum');
Route::get('forum/{slug}', 'Front\HomeController@section')->name('section');
Route::post('quiz/{section}', 'Front\HomeController@quiz')->name('quiz');
Route::get('/markAsRead', function(){auth()->user()->unreadNotifications->markAsRead();return redirect()->back();});
Route::resource('reply', 'User\ReplyController', ['names' => 'reply'])->middleware('auth');
//Search

// Front Pages !
Route::get('page/{slug}', 'Front\HomeController@show')->name('page');
